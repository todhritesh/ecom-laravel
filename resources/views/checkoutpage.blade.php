@extends('base')


@section('title',"Our Products")

@section('content')
      <!-- inner page section -->
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>Checkout Page  <i class="bi bi-cart3"></i></h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
   <!-- end inner page section -->
   <!-- product section -->
   <section class="product_section layout_padding">
      <div class="container">
         <div class="row">
               <div class="col-lg-9 mx-auto">
                   <div class="card">
                       <div class="card">
                           <div class="card-header">BILLING DETAILS</div>
                           <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <td>Product Name</td>
                                        <td>Product Image</td>
                                        <td>Price</td>
                                        <td>Quantity</td>
                                        <td>Total</td>
                                    </tr>

                                    @foreach ($product_details as $p)
                                        <tr>
                                            <td>{{$p['title']}}</td>
                                            <td><img src="{{ asset('images/speaker.png') }}" alt="" style="width:50px"></td>
                                            <td>₹ {{$p['price']}}</td>
                                            <td>{{$p['qty']}}</td>
                                            <td>₹ {{$p['total']}}</td>
                                        </tr>
                                        @endforeach

                                    <tr class="mt-4">
                                        <td></td>
                                        <td colspan="1" class="bg-warning h4 text-center">Sub Total : </td>
                                        <td></td>
                                        <td class="h5 text-center">₹ {{$pay_amount}}</td>
                                    </tr>
                                </table>

                                <div class="btn-box float-end">
                                    <div class="options">
                                        <a href="{{route('pay.with.razorpay',['pay'=>$pay_amount,'oid'=>$oid])}}" class="option1 px-0">CONTINUE</a>
                                    </div>
                                </div>
                           </div>
                       </div>
                   </div>
               </div>
         </div>
      </div>
   </section>
   <!-- end product section -->

@endsection
