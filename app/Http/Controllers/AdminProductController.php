<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;


class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::select(['id', 'name', 'is_available_for_purchase', 'price_in_cents'])
        ->where('is_available_for_purchase', false)
        ->orderBy('id', 'asc')
        ->withCount('orders')
        ->get();

        return view('admin.products', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // validate and store the product
        $validated = $request->validated();

        // Retrieve a portion of the validated input data...
        $validated = $request->safe()->only(['name', 'description', 'priceInCents', 'file', 'image']);
        // dd($validated);
        $product = Product::create([
            'name' => $validated['name'], 
            'description' => $validated['description'], 
            'price_in_cents' => $validated['priceInCents'], 
            'file_path' => $validated['file']->getClientOriginalName(), 
            'image_path' => $validated['image']->getClientOriginalName()
        ]);
        
        return redirect()->route('admin.products');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
