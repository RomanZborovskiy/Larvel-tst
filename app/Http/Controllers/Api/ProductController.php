<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            return ProductResource::collection(Product::paginate(4));
        }
    
        /**
         * Store a newly created resource in storage.
         */
        public function store(StoreProductRequest $request)
        {
            return new ProductResource(Product::create($request->all()));
        }
    
        /**
         * Display the specified resource.
         */
        public function show(Product $product)
        {
            return new ProductResource($product);
        }
    
        /**
         * Update the specified resource in storage.
         */
        public function update(UpdateProductRequest $request, Product $product)
        {
            $product->update($request->all());
            return new ProductResource($product);
        }
    
        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Product $product)
        {
           $product->delete();
           return response()->json([
            'message'=>'This product was delete'
           ]);
        }
}
