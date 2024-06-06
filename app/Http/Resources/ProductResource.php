<?php

namespace App\Http\Resources;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;

class ProductResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $response = Http::get("https://cbu.uz/uz/arkhiv-kursov-valyut/json/");
        $data = $response->json();

        $currency = [
            "usd" => $data[0]["Rate"],
            "rub" => $data[2]["Rate"]
        ];

        $originalPrice = $this->price;

        $usdPrice = $originalPrice / $currency["usd"];
        $rubPrice = $originalPrice / $currency["rub"];



        return [
            'category' => $this->category_id,
            'name' => $this->name,
            'year' => $this->year,
            'Gardener' => $this->breeder,
            'color' => $this->color,
            'barg' => $this->petal,
            'smell' => $this->smell,
            'status' => $this->status,
            'quantity' => $this->quantity,
            'about' => $this->about,
            'price' => [
                'original' => $originalPrice,
                'USD' => round($usdPrice,2),
                'RUB' => round($rubPrice,2)
            ],
            'images' => ImageResource::collection($this->images),
        ];
    }

}
