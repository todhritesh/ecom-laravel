<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $data = Category::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = new Category();
        $data->cat_title = $request->cat_title;
        $data->save();
    }

    public function show(Category $category)
    {
        $data =  $category;
    }

    public function edit(Category $category)
    {
        $data =  $category;
    }

    public function update(Request $request, Category $category)
    {
        $category->cat_title = $request->cat_title;
        $category->save();
    }

    public function destroy(Category $category)
    {
        $category->delete();
    }
}
