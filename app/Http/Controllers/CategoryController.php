<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()->withTrashed()->orderBy('id', 'asc')->get();

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();
        
        DB::beginTransaction();
        
        try {
            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('category_icons', 'public');
                $validated['icon'] = $iconPath;
            }
            $validated['slug'] = Str::slug($validated['name']);
            Category::create($validated);
            DB::commit();

            return redirect()->route('admin.categories.index')->with('message', 'new category successfully added');
        } catch (\Exception $e) {
            DB::rollback();
            $error = ValidationException::withMessages([
                'system_error' => 'System error: ' . $e->getMessage(),
            ]);

            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', [
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'icon' => 'nullable|image|mimes:png,jpg,svg|max:5012',
        ]);

        DB::beginTransaction();

        try {
            $validated['slug'] = Str::slug($validated['name']);

            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('category_icons', 'public');
                $validated['icon'] = $iconPath;

                // remove old icon if exists
                $oldIconPath = @$category?->icon ;
                !is_null($oldIconPath) && Storage::disk('public')->exists($oldIconPath);

                $category->update($validated);
                
            } else {
                $category->update([
                    'name' => $validated['name'],
                    'slug' => $validated['slug'],
                ]);
            }

            DB::commit();

            return redirect()->route('admin.categories.index')->with('message', 'category successfully updated.');

        } catch (\Exception $e) {
            DB::rollback();
            $error = ValidationException::withMessages([
                'system_error' => "System error: " . $e->getMessage(),
            ]);
            throw $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        DB::beginTransaction();

        try {
            $category->delete();
            
            DB::commit();
    
            return redirect()->route('admin.categories.index')->with('message', 'category was removed.');

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function restore($id)
    {
        DB::beginTransaction();

        try {
            $category = Category::query()->withTrashed()->find($id);
            if ($category) {
                $category->restore();
            }

            DB::commit();

            return redirect()->route('admin.categories.index')->with('message', 'category restored.');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function forceDelete($id)
    {
        DB::beginTransaction();
        try {
            $category = Category::query()->withTrashed()->find($id);
            if ($category) {
                $category->forceDelete();
                if (Storage::disk('public')->exists($category->icon)) {
                    Storage::disk('public')->delete($category->icon);
                }
            }

            DB::commit();

            return redirect()->route('admin.categories.index')->with('message', 'category permanently deleted.');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
