<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){

        $data = [
            'category' => Category::all(),
            'product' => Product::all()
        ];
        return view("index",$data);
    }


    public function cart(Request $req){
        $user_id = Auth::user()->id;
        $check_oid = Order::where([['user_id',$user_id],['order_status',0]])->orderBy('id','desc')->count();
        if(!$check_oid){
            return redirect()->back();
        }
         $oid_array = Order::where([['user_id',$user_id],['order_status',0]])->orderBy('id','desc')->get();;
        if($check_oid==2){
            $find_buy_now_order_item = OrderItem::where('order_id',$oid_array[0]['id'])->first();
            $find_buy_now_order_item->order_id = $oid_array[1]['id'];
            $find_buy_now_order_item->save();
            $previous_buy_new_oid = Order::find($oid_array[0]['id']);
            $previous_buy_new_oid->delete();
        }

       $check_oid = Order::where([['user_id',$user_id],['order_status',0]])->orderBy('id','desc')->first();


        $oid = $check_oid->id;

        $get_cart_product = OrderItem::with("productDetails")->where('order_id',$oid)->get();

        $product_details_array = [];
        foreach($get_cart_product as $pro_details){
            $p = $pro_details['productDetails'];
            $product_details_array[]=[
                'pid'=>$p->id,
                'title'=>$p->pro_title,
                'price'=>$p->pro_price,
                'qty'=>$pro_details->qty,
                'image'=>$p->pro_image,
                'total'=>$pro_details->qty * $p->pro_price
            ];
        }
        $product_details_array;

        $data = [
            'cart_products'=>$product_details_array,
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