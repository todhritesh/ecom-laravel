<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;

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

        \Session::put('uoid',$oid);


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
            $save_payment->user_id = Auth::user()->id;
            $save_payment->status = $response['status'];
            $save_payment->amount = $response['amount'];
            $save_payment->save();

            $order= Order::find($oid);
            $order->order_status = 1;
            // $order->paid = $response['amount'];
            $order->save();

            $orderItemLoop= OrderItem::where([['order_id',$oid],['o_status',0],['user_id',Auth::user()->id]])->get();
            foreach($orderItemLoop as $o){
                $pro = Product::where('id',$o->product_id)->first();

                $pro_price = $pro->pro_price ;
                $user_margin = $pro->user_margin ;
                $retail_margin = $pro->retail_margin ;

                $cal_discount = Auth::user()->role == 'user' ? (($pro_price * $user_margin)/100) :  (($pro_price * $retail_margin)/100) ;
                $cal_price = $pro_price - $cal_discount ;

                $cal_total = $o->qty * $cal_price;
                $o->paid = $cal_total;
                $o->o_status = 1;
                $o->save();
            }
            $request->session()->flash('success', 'Payment successful');
            return redirect()->route("order");
        }else{
            $save_payment = new Payment();
            $save_payment->r_payment_id = $response['id'];
            $save_payment->order_id = $oid;
            $save_payment->user_id = Auth::user()->id;
            $save_payment->status = $response['status'];
            $save_payment->amount = $response['amount'];
            $save_payment->save();

            $order= Order::find($oid);
            $order->order_status = -1;
            // $order->paid = $response['amount'];
            $order->save();

            $orderItemLoop= OrderItem::where([['order_id',$oid],['o_status',0],['user_id',Auth::user()->id]])->get();
            foreach($orderItemLoop as $o){
                $pro = Product::where('id',$o->product_id)->first();

                $pro_price = $pro->pro_price ;
                $user_margin = $pro->user_margin ;
                $retail_margin = $pro->retail_margin ;

                $cal_discount = Auth::user()->role == 'user' ? (($pro_price * $user_margin)/100) :  (($pro_price * $retail_margin)/100) ;
                $cal_price = $pro_price - $cal_discount ;

                $cal_total = $o->qty * $cal_price;
                $o->paid = $cal_total;
                $o->o_status = -1;
                $o->save();

                $request->session()->flash('failure','Payment Failed !');
                return redirect()->route("order");
            }

        }



        return redirect()->back();
    }
}
