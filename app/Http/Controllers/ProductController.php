<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //for only sellers
        $this->authorize('create', Product::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'nullable|json', // New JSON field for features
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'thumbnail' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive,out_of_stock',
        ]);
        $store = auth()->user()->store;
           if (! $store) {
        return response()->json(['message' => 'You must create a store first.'], 400);
    }
        $product = $store->products()->create($request->all());

          $product->save();

        return response()->json(['message' => 'Product created successfully', 'store' =>  $product], 201);


    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        return response()->json($product);

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
    public function update(Request $request, Product $product)
    {
             //for only sellers
        $this->authorize('update', $product);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'nullable|json', // New JSON field for features
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'thumbnail' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive,out_of_stock',
        ]);
        $store = auth()->user()->store;
           if (! $store) {
        return response()->json(['message' => 'You must create a store first.'], 400);
    }
             //update the product not relationship itself
              $product->update($request->all());

        return response()->json(['message' => 'Product update successfully', 'store' =>  $product], 201);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
