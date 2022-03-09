<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    function addToCart($pid=null){


        $check_pro = Product::find($pid);
        if(!$check_pro){
            return redirect()->back();
        }

        $user_id = Auth::user()->id;

        $checkOrderId = Order::where([['user_id',$user_id],['order_status',0],['is_buy_now',0]])->orderBy('id','desc')->first();

        //checking buy now
        $check_buy_now_OrderId = Order::where([['user_id',$user_id],['order_status',0],['is_buy_now',1]])->orderBy('id','desc')->first();
        if($check_buy_now_OrderId){
            $buy_now_id = $check_buy_now_OrderId->id;
            $findPro = OrderItem::where('order_id',$buy_now_id)->first();
            if($checkOrderId){
                $findPro->order_id = $checkOrderId->id;
                $findPro->save();
                $check_buy_now_OrderId->delete();
            }else{
                $check_buy_now_OrderId->is_buy_now = 0;
                $check_buy_now_OrderId->save();
            }
        }

        $checkOrderId = Order::where([['user_id',$user_id],['order_status',0],['is_buy_now',0]])->orderBy('id','desc')->first();

        if($checkOrderId){
            $oid = $checkOrderId->id;
            $checkProduct = OrderItem::where([['order_id',$oid],['product_id',$pid]])->first();
            if($checkProduct){
                $checkProduct->qty=$checkProduct->qty+1;
                $checkProduct->save();
                return redirect()->back();
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
        $data->user_id = $user_id;
        $data->qty = 1;
        $data->save();

        return redirect()->back();
    }

    function buyNow($pid=null){

        $user_id = Auth::user()->id;


        $checkOrderId = Order::where([['user_id',$user_id],['order_status',0],['is_buy_now',0]])->orderBy('id','desc')->first();

        //checking buy now
        $check_buy_now_OrderId = Order::where([['user_id',$user_id],['order_status',0],['is_buy_now',1]])->orderBy('id','desc')->first();
        if($check_buy_now_OrderId){
            $buy_now_id = $check_buy_now_OrderId->id;
            $findPro = OrderItem::where('order_id',$buy_now_id)->first();
            if($checkOrderId){
                $findPro->order_id = $checkOrderId->id;
                $findPro->save();
                $check_buy_now_OrderId->delete();
            }else{
                $check_buy_now_OrderId->is_buy_now = 0;
                $check_buy_now_OrderId->save();
            }
        }

        $newOrder = new Order();
        $newOrder->user_id = $user_id;
        $newOrder->order_status = 0;
        $newOrder->is_buy_now = 1;
        $newOrder->save();
        $oid = $newOrder->id;

        $data = new OrderItem();
        $data->order_id = $oid;
        $data->product_id = $pid;
        $data->user_id = $user_id;
        $data->qty = 1;
        $data->save();
        $user_id = Auth::user()->id;
        $count_cart = OrderItem::where([['user_id',$user_id],['o_status',0]])->count();

        return redirect()->route('checkout', ["oid"=>$oid,'cart_value'=>$count_cart]);
    }

    function checkOut($oid=null){
        $user_id = Auth::user()->id;

        if($oid==null){
           $check_oid = Order::where([['user_id',$user_id],['order_status',0],['is_buy_now',0]])->first();
           if(!$check_oid)
                $check_oid = Order::where([['user_id',$user_id],['order_status',0],['is_buy_now',1]])->first();

        }else{
            $check_oid = Order::where([['user_id',$user_id],['id',$oid],['order_status',0],['is_buy_now',1]])->first();
            if(!$check_oid){
                return redirect()->back();
            }
        }

            $get_cart_product = OrderItem::with("productDetails")->where('order_id',$check_oid->id)->get();
            $product_details_array = [];
            $pay_amount = 0;
            foreach($get_cart_product as $pro_details){
                $p = $pro_details['productDetails'];
                $cal_discount = Auth::user()->role == 'user' ? (($p->pro_price * $p->user_margin)/100) :  (($p->pro_price * $p->retail_margin)/100) ;
                $cal_price = $p->pro_price - $cal_discount ;

                $cal_total = $pro_details->qty * $cal_price;
                $cal_save = $pro_details->qty * $cal_discount;
                $pay_amount+=$cal_total;
                $product_details_array[]=[
                    'title'=>$p->pro_title,
                    'price'=>$cal_price ,
                    'qty'=>$pro_details->qty,
                    'image'=>$p->pro_image,
                    'save'=>$cal_save,
                    'total'=>$cal_total,
                ];
            }

            $product_details_array;

            $user_id = Auth::user()->id;
            $count_cart = OrderItem::where([['user_id',$user_id],['o_status',0]])->count();
            $data = [
                'category' => Category::all(),
                'product' => Product::all(),
                'product_details' => $product_details_array,
                'pay_amount' => $pay_amount,
                'oid' => $check_oid,
                "cart_value" => $count_cart
            ];
            return view('checkoutpage',$data);
    }

    function removeFromCart($pid=null){
        $check_pro = Product::find($pid);
        if(!$check_pro){
            return redirect()->back();
        }

        $user_id = Auth::user()->id;

        $checkOrderId = Order::where([['user_id',$user_id],['order_status',0],['is_buy_now',0]])->orderBy('id','desc')->first();

        if(!$checkOrderId){
            $checkOrderId = Order::where([['user_id',$user_id],['order_status',0],['is_buy_now',1]])->orderBy('id','desc')->first();
            $findPro = OrderItem::where([['product_id',$pid],['order_id',$checkOrderId->id]])->first();
            if($findPro){
                $findPro->delete();
                $checkOrderId->is_buy_now = 0;
                $checkOrderId->save();
                return response()->back();
            }
        }

        $oid = $checkOrderId->id;
        $checkProduct = OrderItem::where([['order_id',$oid],['product_id',$pid]])->first();
        if(!$checkProduct){
            return redirect()->back();
        }

        if($checkProduct->qty==1){
            $checkProduct->delete();
            return redirect()->back();
        }else{
            $checkProduct->qty = $checkProduct->qty - 1;
            $checkProduct->save();
            return redirect()->back();
        }


    }

    public function orderHistory(){
        if(!Auth::user()){
            return redirect()->route("login");
        }
        $user_id = Auth::user()->id;
            $getOrderHistory = OrderItem::where([["user_id",$user_id],["o_status",'!=',0]])->get();
            $product_details_array = [];
            $pay_amount = 0;
            foreach($getOrderHistory as $pro_details){
                $p = $pro_details['productDetails'];

                $cal_discount = Auth::user()->role == 'user' ? (($p->pro_price * $p->retail_margin)/100) :  (($p->pro_price * $p->user_margin)/100) ;
                $cal_price = $p->pro_price - $cal_discount ;
                // $cal_total = $pro_details->qty * $cal_price;


                $cal_total = $pro_details->qty * $p->pro_price;
                $pay_amount+=$cal_total;
                $product_details_array[]=[
                    'title'=>$p->pro_title,
                    'price'=>$cal_price,
                    'qty'=>$pro_details->qty,
                    'image'=>$p->pro_image,
                    'status'=>$pro_details->o_status,
                    'total'=>$pro_details->paid
                ];
            }


            $user_id = Auth::user()->id;
            $count_cart = OrderItem::where([['user_id',$user_id],['o_status',0]])->count();
            $data = [
                'category' => Category::all(),
                'product' => Product::all(),
                'product_details' => $product_details_array,
                // 'pay_amount' => $pay_amount,
                "cart_value" => $count_cart,
                // "oid" => $oid
            ];
            return view('orders',$data);
    }

}
