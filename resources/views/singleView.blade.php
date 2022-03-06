@extends('base')


@section('content')
      <!-- inner page section -->
      <section class="inner_page_head py-1 px-5">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full py-1">
                     <h3 class="text-start">{{$selected_pro->pro_title}}</h3>
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
            @if ($selected_pro)
               
               <div class="card col-lg-4 shadow-sm border-0">
                   <img src="{{ asset('images/p1.png') }}" alt="" class="img-fluid" style="height:500px">
                </div> 
                <div class="col-lg-1"></div>

                <div class="col-lg-7">
                    <div class="box py-1 mt-0 shadow-sm">
                        <div class="detail-box d-block">
                            <p class="fs-3 fw-bold text-decoration-underline text-start">Description</p>
                           <p class="fs-5 text-start">
                              {{$selected_pro->pro_description}}
                           </p>
                           
                        </div>
                     </div>
                </div>
            @else
               <div class="alert alert-danger">NO PRODUCTS ARE AVAILABLE FOR NOW</div>
            @endif
         </div>
         <div class="text-center">
            <div class="btn-box">
                <div class="options justify-content-center" style="flex-direction: row">
                    <a href="" class="option1 px-0 fs-5" style="width: 10pc">
                        ADD TO CART
                     </a>
                     <a href="" class="option2 fs-5 px-0" style="width: 10pc">
                     BUY NOW
                     </a>
                </div>
            </div>
         </div>
      </div>
   </section>
   <!-- end product section -->

@endsection