<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryResource::collection(category::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = auth()->user()->categories()->create($request->validated());
        //return new CategoryResource(Category::create($request->validated()));
        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        return new CategoryResource($category);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, category $category)
    {
        $category->update($request->validated());
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        $category->delete();

        return response()->noContent();
    }
}