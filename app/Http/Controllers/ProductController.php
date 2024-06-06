<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\JsonResponse;



class ProductController extends Controller
{

    public function index()
    {
        return ProductResource::collection(Product::all());

    }


    public function store(Request $request): JsonResponse
    {
        $product = Product::create($request->except('filename'));

        if ($request->hasFile('filename')) {
            foreach ($request->files->parameters['filename'] as $file) {
                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->move('files/images', $fileName);
                Image::create([
                    'product_id' => $product->id,
                    'filename' => $fileName
                ]);
            }

            return (new ProductResource($product))
                ->response()
                ->setStatusCode(201);

        }
    }



    public function show(Product $product)
    {
        return new ProductResource($product);
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->except('filename'));

        if ($request->hasFile('filename')) {
            foreach ($request->file('filename') as $file) {
                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->move('files/images', $fileName);
                Image::create([
                    'product_id' => $product->id,
                    'filename' => $fileName
                ]);
            }
        }

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(200);
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully', 'product' => $product], 201);

    }


}
