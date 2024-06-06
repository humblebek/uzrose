<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{

    public function toArray($request)
    {
        $totalPrice = $this->orderItems->sum(function ($item) {
            return $item->quantity * $item->product->price; // Calculate total price for each order item
        });


        return [
            'order_id' => $this->id,
            'user_name' => $this->user_name,
            'user_phone' => $this->user_phone,
            'status' => $this->status,
            'admin_show' => $this->admin_show,
            'Client_full_price' => $totalPrice, // Set the total price for all order items
            'products' => OrderItemResource::collection($this->orderItems),
        ];
    }




}
