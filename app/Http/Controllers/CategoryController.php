<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index($id)
    {
        // return $id;
        $data = [
            'cate' => Category::find($id),
            'category' => Category::all(),
            'product' => Product::where('category_id',$id)->get(),
            'countProduct' => Product::where('category_id',$id)->count()
        ];
        return view("categories",$data);
    }

    public function create($req)
    {
        $cat = new Category();

        $cat->cat_title = $req->title;
        $cat->save();

        return redirect("category.index");
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
