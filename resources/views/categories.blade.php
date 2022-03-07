@extends('base')

@section('title','Homepage')


@section('content')
     <!-- inner page section -->
     <section class="inner_page_head">
      <div class="container_fuild">
         <div class="row">
            <div class="col-md-12">
               <div class="full">
                  <h3>{{$cate->cat_title}} Products</h3>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- end inner page section -->
   <!-- product section -->
   <section class="product_section layout_padding">
      <div class="container">
         <div class="heading_container">
            <p class="fw-bold fs-5 text-decoration-underline">
               Total Products found in {{$cate->cat_title}} - {{$countProduct}}
            </p>
         </div>
         <div class="row">
            {{-- <div class="col-sm-6 col-md-4 col-lg-3">
               <div class="box">
                  <div class="option_container">
                     <div class="options">
                        <a href="" class="option2">
                        Buy Now
                        </a>
                     </div>
                  </div>
                  <div class="img-box">
                     <img src="images/p1.png" alt="">
                  </div>
                  <div class="detail-box">
                     <h5>
                        Men's Shirt
                     </h5>
                     <h6>
                        $75
                     </h6>
                  </div>
               </div>
            </div> --}}

            @if (count($product) > 0)
            @foreach ($product as $pro)
            <div class="col-sm-6 col-md-4 col-lg-3">
               <div class="box py-1">
                  <div class="option_container">
                     <div class="options">
                        <a href="{{ route('product.singleView',['id' => $pro->id]) }}" class="option1">
                           View Product
                        </a>
                        <a href="" class="option2">
                        Buy Now
                        </a>
                        <div class="bg-light text-center">
                           <h5>
                              {{$pro->pro_title}}
                           </h5>
                           <h6>
                              ₹{{$pro->pro_price}}
                           </h6>
                        </div>
                     </div>
                  </div>
                  <div class="img-box">
                     <img src="images/p1.png" alt="">
                  </div>
                  <div class="detail-box d-block">
                     <h5 class="text-start">
                        {{$pro->pro_title}}
                     </h5>
                     <h6 class="text-start">
                        ₹{{$pro->pro_price}}
                     </h6>
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
