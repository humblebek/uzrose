<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Image;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $order = OrderResource::collection(Order::all());
        return $order;
    }



    public function store(StoreOrderRequest $request, Order $order)
    {
        $orderData = $request->all();
        $products = $request->input('Products');
        $productsJson = json_encode($products);
        $orderData['Products'] = $productsJson;

        // Create the order
        $newOrder = Order::create($orderData);

        foreach ($products as $productData) {
            $product = Product::find($productData['product_id']);


            if ($product->quantity < $productData['quantity']) {
                return response()->json("Product with ID {$productData['product_id']} does not have enough quantity available.");
            }

            if ($newOrder->status == 1 || $newOrder->status == 2) {
                $product->quantity -= $productData['quantity'];
            } elseif ($newOrder->status == 3) {
                $product->quantity += $productData['quantity'];
            }
            $product->save();


            OrderItem::create([
                'order_id' => $newOrder->id,
                'product_id' => $productData['product_id'],
                'quantity' => $productData['quantity'],
                'price' => $productData['price']
            ]);
        }

        return response()->json([
            'message' => 'Order created successfully',
            'order' => new OrderResource($newOrder)
        ], 201);
    }



    public function show(Order $order)
    {
        return new OrderResource($order);
    }


    public function update(UpdateOrderRequest $request, Order $order)
    {
        $status = $request->status;

        $order->update(['status' => $status]);

        return response()->json([
            'message' => 'Order updated successfully',
            'order' => new OrderResource($order)
        ]);

    }


    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully', 'product' => $order], 201);
    }

    public function myOrder()
    {
        $user = Auth::user();

        $myOrders = $user->orders;

        return $myOrders;
    }
}
