@extends('base')


@section('title',"Our Products")

@section('content')
      <!-- inner page section -->
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>Your Cart <i class="bi bi-cart3"></i></h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
   <!-- end inner page section -->
   <!-- product section -->
   <section class="product_section layout_padding" >
      <div class="container">
         <div class="row" >

            @if ($cart_products)
                <div class="row" >
                    <div class="col-8">
                        <div class="col-4 ms-auto mb-3" >
                            <a href="{{route('checkout')}}" class="btn btn-success w-100">Checkout</a>
                        </div>
                    </div>
                </div>
                @foreach ($cart_products as $cp)
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body box d-flex mt-1">
                            <img src="{{ asset('images/speaker.png') }}" alt="" class="card-img-top" style="width:100px">
                            <div class="vr"></div>
                            <div class="ms-4">
                                <p class="fw-bold fs-5 mb-1">{{$cp['title']}}</p>
                                <p class="fs-6 mb-3">{{$cp['total']}}</p>
                                <div class="d-flex">
                                    <a href="{{route('removeFromCart',['pid'=>$cp['pid']])}}" class="btn btn-outline-dark fs-5 py-0 mt-2" style="height: 30px">-</a>
                                    <p class="lead mt-2 fs-5 px-2">{{$cp['qty']}}</p>
                                    <a href="{{route('addToCart',['pid'=>$cp['pid']])}}" class="btn btn-outline-dark fs-5 py-0 mt-2" style="height: 30px">+</a>
                                </div>
                                <p class="text-secondary">Sold by: Jai Mata Di Electronics</p>
                            </div>
                            {{-- <div class="ms-auto">
                                <div class="btn-box">
                                    <div class="options">
                                        <a href="{{ route('buy_now',['pid'=>$cp['pid']]  ) }}" class="option1">BUY NOW</a>
                                        <a href="" class="option2 fs-6 px-0">ADD TO WISHLIST</a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                @endforeach

            @else

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body box d-flex mt-1">
                        <div class="display-4">Yout Cart is empty !</div>

                    </div>
                </div>
            </div>

            @endif

         </div>
      </div>
   </section>
   <!-- end product section -->

@endsection
