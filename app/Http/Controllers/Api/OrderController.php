<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderResource::collection(Order::all());
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->validated());
            foreach ($request->input('order_items') as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
            return new OrderResource($order->load('orderItems'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $orderResult = Order::with('orderItems')->findOrFail($order->id);
        return new OrderResource($orderResult);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateOrderRequest $request, Order $order)
    // {
        
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Order $order)
    // {
    //     //
    // }
}
