<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index($id)
    {
        if(Auth::user()){
            $user_id = Auth::user()->id;
            $count_cart = OrderItem::where([['user_id',$user_id],['o_status',0]])->count();

        }
        else{
            $count_cart = 0;
        }


        $data = [
            'cate' => Category::find($id),
            'category' => Category::all(),
            'product' => Product::where('category_id',$id)->get(),
            'countProduct' => Product::where('category_id',$id)->count(),
            'cart_value' => $count_cart,
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
