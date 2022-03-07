@extends('base')


@section('title',"Our Products")

@section('content')
      <!-- inner page section -->
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>Product Grid</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
   <!-- end inner page section -->
   <!-- product section -->
   <section class="product_section layout_padding">
      <div class="container">
         {{-- <div class="heading_container heading_center">
            <h2>
               Our <span>products</span>
            </h2>
         </div> --}}
         <div class="row">
            @if (count($product) > 0)
               @foreach ($product as $pro)
               @php
                $cal_discount = Auth::user()->role == 'user' ? (($pro->pro_price * $pro->user_margin)/100) :  (($pro->pro_price * $pro->retail_margin)/100) ;
                $cal_price = $pro->pro_price - $cal_discount ;
               @endphp

               <div class="col-sm-6 col-md-4 col-lg-3">
                  <div class="box py-1">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{ route('product.singleView',['id' => $pro->id]) }}" class="option1">
                              View Product
                           </a>
                           <a href="{{ route('buy_now',['pid'=>$pro['id']]  ) }}" class="option2">
                           Buy Now
                           </a>
                           <div class="bg-light text-center">
                              <h5>
                                 {{$pro->pro_title}}
                              </h5>
                              <h5>
                                 ₹{{$cal_price}}
                              </h5>
                           </div>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="{{ asset('images/speaker.png') }}" alt="">
                     </div>
                     <div class="detail-box d-block">
                        <h5 class="text-start">
                           {{$pro->pro_title}}
                        </h5>
                        <h5 class="text-start ">
                            ₹{{$cal_price}}
                         </h5>
                     </div>
                  </div>
               </div>

               @endforeach


            @else
               <div class="alert alert-danger">NO PRODUCTS ARE AVAILABLE FOR NOW</div>
            @endif
         </div>
         <div class="btn-box">
            <a href="">
            View All products
            </a>
         </div>
      </div>
   </section>
   <!-- end product section -->

@endsection
