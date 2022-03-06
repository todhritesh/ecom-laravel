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
                                    <tr>
                                        <td>Ahuja Speakers</td>
                                        <td><img src="{{ asset('images/speaker.png') }}" alt="" style="width:50px"></td>
                                        <td>₹1270</td>
                                        <td>2</td>
                                        <td>₹2540</td>
                                    </tr>
                                </table>

                                <div class="btn-box float-end">
                                    <div class="options">
                                        <a href="" class="option1 px-0">CONTINUE</a>
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
