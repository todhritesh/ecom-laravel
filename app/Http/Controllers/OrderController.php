<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    function addToCart($pid=null,Request $req){
        $check_pro = Product::find($pid);
        if(!$check_pro){
            return ;
        }

        $user_id = 12;

        $checkOrderId = Order::where([['user_id',$user_id],['order_status',0]])->orderBy('id','desc')->first();

        if($checkOrderId){
            $oid = $checkOrderId->id;
            $checkProduct = OrderItem::where([['order_id',$oid],['product_id',$pid]])->first();
            if($checkProduct){
                $checkProduct->qty=$checkProduct->qty+1;
                $checkProduct->save();
                return ;
            }
        }else{
            $newOrder = new Order();
            $newOrder->user_id = $user_id;
            $newOrder->order_status = 0;
            $newOrder->save();
            $oid = $newOrder->id;
        }

        $data = new OrderItem();
        $data->order_id = $oid;
        $data->product_id = $pid;
        $data->qty = $req->qty;
        $data->save();

        return ;
    }

    function buyNow($pid=null,Request $req){
        $user_id = 12;
        $newOrder = new Order();
        $newOrder->user_id = $user_id;
        $newOrder->order_status = 0;
        $newOrder->save();
        $oid = $newOrder->id;

        $data = new OrderItem();
        $data->order_id = $oid;
        $data->product_id = $pid;
        $data->qty = $req->qty;
        $data->save();

        return redirect()->route('checkout', ["oid"=>$oid]);
    }

    function checkOut($oid=null){
        $user_id = 12;

        if($oid==null){
            // view ("checkout)
        }else{
            $check_oid = Order::where([['user_id',$user_id],['id',$oid],['order_status',0]])->first();
            if(!$check_oid){
                return ;
            }

            // view checkout
        }
    }

    function removeFromCart($pid=null){
        $check_pro = Product::find($pid);
        if(!$check_pro){
            return "nii";
        }

        $user_id = 12;

        $checkOrderId = Order::where([['user_id',$user_id],['order_status',0]])->orderBy('id','desc')->first();
        if(!$checkOrderId){
            return ;
        }
        $oid = $checkOrderId->id;
        $checkProduct = OrderItem::where([['order_id',$oid],['product_id',$pid]])->first();
        if(!$checkProduct){
            return ;
        }

        if($checkProduct->qty==1){
            $checkProduct->delete();
            return ;
        }else{
            $checkProduct->qty = $checkProduct->qty - 1;
            $checkProduct->save();
            return ;
        }


    }

}
