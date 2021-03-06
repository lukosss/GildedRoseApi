<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ItemResource;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5',
        ]);

        return Category::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the resources from specified category.
     *
     * @param $categoryName
     * @return \Illuminate\Http\Response
     */
    public function showItemsFromCategoryByName($categoryName)
    {
        $categoryId = Category::where('name', $categoryName)->pluck('id');
        if (count($categoryId)) {
            return ItemResource::collection(Item::where('category', $categoryId)->get());
        }
        return 'Category ' . $categoryName . ' not found';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:5',
        ]);

        $existingCategory = Category::findOrFail($id);
        $existingCategory->update($request->all());

        return $existingCategory;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Category::find($id)) {
            Category::destroy($id);
            return 'Category successfully deleted';
        }

        return 'Category not found';
    }

    /**
     * Remove all the items of specified category from storage.
     *
     * @param $categoryName
     * @return \Illuminate\Http\Response
     */
    public function destroyAllItemsFromCategory($categoryName)
    {
        $categoryId = Category::where('name', $categoryName)->pluck('id');

        if (count($categoryId)) {
            $id = Item::where('category', $categoryId)->pluck('id');
            Item::destroy($id);
            return 'Category ' . $categoryName . ' items successfully deleted';
        }

        return 'Category not found';
    }

    /**
     * Remove all the items of specified category from storage.
     *
     * @param $categoryName
     * @return \Illuminate\Http\Response
     */
    public function destroyAllItemsFromCategoryId($categoryId)
    {
        if (Category::find($categoryId)) {
            $id = Item::where('category', $categoryId)->pluck('id');
            Item::destroy($id);
            return 'Category id ' . $categoryId . ' items successfully deleted';
        }

        return 'Category not found';
    }
}
