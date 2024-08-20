<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::query()->orderBy('id')->paginate(5);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::query()->latest()->get();
        
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $validated['slug'] = Str::slug($validated['name']);
            if ($request->hasFile('photo')) {
                $photo_path = $validated['photo']->store('products', 'public');
                $validated['photo'] = $photo_path;
            }
            Product::create($validated);
            DB::commit();

            return redirect()->route('admin.products.index')->with('message', 'new product successfully added');
        } catch (\Exception $e) {
            DB::rollback();
            $error = ValidationException::withMessages([
                'validation_error' => $e->getMessage(),
            ]);
            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        $categories = Category::all();
        return view('admin.products.show', compact('product', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'price' => 'required',
            'about' => 'max:255',
            'photo' => 'nullable|image|mimes:png,jpg,svg|max:5128',
            'category_id' => 'required',
        ]);

        DB::beginTransaction();
        try {
        
            if ($request->hasFile('photo')) {
                $oldPhotoPath = @$product?->photo;
                !is_null($oldPhotoPath) && Storage::disk('public')->exists($oldPhotoPath);

                $photo_path = $request->file('photo')->store('products', 'public');
                $validated['photo'] = $photo_path;
                
                $product->photo = $validated['photo'];
                $product->save();
            }

            $product->name = $validated['name'];
            $product->slug = Str::slug($validated['name']);
            $product->price = $validated['price'];
            $product->about = $validated['about'];
            $product->category_id = $validated['category_id'];
            $product->save();

            DB::commit();

            return redirect()->route('admin.products.index')->with('message', 'product successfully updated');
        } catch (Exception $e) {
            DB::rollback();
            $error = ValidationException::withMessages([
                'validation_error' => $e->getMessage(),
            ]);

            throw $error;
            return back()->withErrors($validated)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}