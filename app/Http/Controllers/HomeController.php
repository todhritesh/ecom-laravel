<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $data = [
            'category' => Category::all(),
            'product' => Product::all()
        ];
        return view("index",$data);
    }


    public function cart(){
        $data = [
            'category' => Category::all(),
            'product' => Product::all()
        ];
        return view("cart",$data);
    }

    public function checkout(){
        $data = [
            'category' => Category::all(),
            'product' => Product::all()
        ];

        return view("checkout",$data);
    }

}
