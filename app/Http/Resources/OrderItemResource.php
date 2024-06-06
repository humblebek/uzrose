<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{

    public function toArray($request)
    {
        $product = Product::find($this->product_id);
        $totalPrice = $this->quantity * $product->price;

        return [
            'order_id' => $this->order_id,
            'product_id' => $product->id, // Access the product's id
            'quantity' => $this->quantity,
            'price' => $product->price,
            'total_price' => $totalPrice,
        ];
    }

}
