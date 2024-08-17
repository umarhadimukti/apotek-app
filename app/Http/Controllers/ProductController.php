<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()->orderBy('id')->paginate(5);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->latest()->get();
        
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
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
    public function show(Product $product)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}