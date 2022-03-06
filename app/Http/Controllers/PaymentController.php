<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use Session;
use Redirect;

class PaymentController extends Controller
{
    public function create($pay=null,$oid=null)
    {
        if($pay==null){
            return redirect()->back();
        }
        if($oid==null){
            return redirect()->back();
        }


        $user = Auth::user();

        // $check_oid = Order::where([['user_id',$uid],['order_status',0]])->orderBy('id','desc')->first();
        // if(!$check_oid){
        //     return ;
        // }

        // $oid = $check_oid->id;

        // $check_cart = OrderItem::where('order_id',$oid)->count();

        // if(!$check_cart){
        //     return ;
        // }
        \Session::put('uoid',$oid);
        // $get_cart_product = OrderItem::with("productDetails")->where('order_id',$oid)->get();
        // $product_details_array = [];
        // $pay_amount = 0;
        // foreach($get_cart_product as $pro_details){
        //     $p = $pro_details['productDetails'];
        //     $cal_total = $p->pro_qty * $p->pro_price;
        //     $pay_amount+=$cal_total;

        //     $product_details_array[]=[
        //         'title'=>$p->pro_title,
        //         'price'=>$p->pro_price,
        //         'qty'=>$p->pro_qty,
        //         'image'=>$p->pro_image,
        //         'total'=>$cal_total,
        //     ];
        // }

        // $product_details_array;

        $data = [
            'pay_amount'=>$pay
        ];


        return view('razorpay',$data);
    }

    public function payment(Request $request)
    {
        $input = $request->all();

        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
            } catch (\Exception $e) {
                return  $e->getMessage();
                \Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }

        // dd($response);
        $oid = \Session::get('uoid');
        if($response['status']=='captured'){
            $save_payment = new Payment();
            $save_payment->r_payment_id = $response['id'];
            $save_payment->order_id = $oid;
            $save_payment->user_id = 12;
            $save_payment->status = $response['status'];
            $save_payment->amount = $response['amount'];
            $save_payment->save();

            $order= Order::find($oid);
            $order->order_status = 1;
            $order->save();
        }else{
            $save_payment = new Payment();
            $save_payment->r_payment_id = $response['id'];
            $save_payment->order_id = $oid;
            $save_payment->user_id = 12;
            $save_payment->status = $response['status'];
            $save_payment->amount = $response['amount'];
            $save_payment->save();
        }
        return 345;

        \Session::put('success', 'Payment successful');

        return redirect()->back();
    }
}
