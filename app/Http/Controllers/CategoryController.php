<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        return CategoryResource::collection( Category::all());
    }


    public function store(StoreCategoryRequest $request)
    {

        $category = Category::create($request->all());

        return response()->json(['message' => 'Category created successfully', 'category' => $category], 201);
    }


    public function show(Category $category)
    {
        return new CategoryResource($category);
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return response()->json(['message' => 'Category updated successfully', 'category' => $category], 201);
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully'], 201);
    }

    public function byCategory(Category $category)
    {
        $products = ProductResource::collection( $category->products);
        return $products;
    }
}
