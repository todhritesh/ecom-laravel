<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    
    public function index()
    {
    //    $data = Product::with("category")->get();
        $data = ["product" => Product::all(),
        "category" => Category::all(),
    ];

       return view("product",$data);
    }

    public function singleView($id){
        $data = [
            "selected_pro" => Product::find($id),
            "category" => Category::all(),
            "product" => Product::all(),
        ];

        return view("singleView",$data);
    }

    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'pro_title' => 'required',
            'pro_description' => 'required',
            'pro_price' => 'required',
            'pro_qty' => 'required',
            'category_id' => 'required',
            'pro_image' => 'required',
        ]);

        $data = new Product();
        $data->pro_title = $request->pro_title;
        $data->pro_description = $request->pro_description;
        $data->pro_price = $request->pro_price;
        $data->pro_qty = $request->pro_qty;
        $data->category_id = $request->category_id;
        $img_name = date("HisdmY").'.'.$request->pro_image->getClientOriginalExtension();
        $data->pro_image = $img_name;
        $request->pro_image->storeAs("/public/producs",$img_name);
        $data->save();
        return 345;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $data = Product::with("category")->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data = $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request,[
            'pro_title' => 'required',
            'pro_description' => 'required',
            'pro_price' => 'required',
            'pro_qty' => 'required',
            'category_id' => 'required',
            'pro_image' => 'required',
        ]);

        $product->pro_title = $request->pro_title;
        $product->pro_description = $request->pro_description;
        $product->pro_price = $request->pro_price;
        $product->pro_qty = $request->pro_qty;
        $product->category_id = $request->category_id;
        $img_name = date("HisdmY").'.'.$request->pro_image->getClientOriginalExtension();
        $product->pro_image = $img_name;
        $request->pro_image->storeAs("/public/producs",$img_name);
        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}
