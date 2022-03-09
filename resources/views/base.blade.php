<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="">
      <title>JMDElec | @yield('title')</title>
      <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

      <!-- font awesome style -->
      <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
      {{-- bootstrap icons --}}
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

   </head>
   <style>
      
   </style>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         <header class="header_section mb-5">
            <div class="container-fluid">
               <nav class="navbar navbar-expand-lg custom_nav-container fixed-top bg-light p-3 ">
                  <a href="{{route('index')}}" class="navbar-brand text-dark fs-2 fw-bolder py-0">JMDElec</a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        <li class="nav-item active">
                           <a class="nav-link" style="color:@php echo Request::path()=="/"?"#f7444e":"black" @endphp" href="{{ route  ('index') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                       <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown" role="button" style="color:@php echo Request::path()=="category"?"#f7444e":"black" @endphp" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Categories <span class="caret"></span></a>
                           <ul class="dropdown-menu">
                              @foreach ($category as $cat)
                              <li><a href="{{ route('category.index', ['id'=>$cat->id]) }}">{{$cat->cat_title}}</a></li>
                              @endforeach
                              <li><hr class="dropdown-divider"></li>
                              <li><a href="" class="">View all...</a></li>
                           </ul>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{ route('product.index') }}" style="color:@php echo Request::path()=="products"?"#f7444e":"black" @endphp">Products</a>
                        </li>
                        {{-- <li class="nav-item">
                           <a class="nav-link" href="contact.html">Contact</a>
                        </li> --}}
                        @if (Auth::check())
                        <li class="nav-item">
                           <a class="me-4 nav-link position-relative" href="{{ route('cart') }}" style="color:@php echo Request::path()=="cart"?"#f7444e":"black" @endphp">
                              <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                                 <g>
                                    <g>
                                       <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                                          c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                    </g>
                                 </g>
                                 <g>
                                    <g>
                                       <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                                          C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                                          c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                                          C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                    </g>
                                 </g>
                                 <g>
                                    <g>
                                       <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                                          c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                    </g>
                                 </g>
                                 <g>
                                 </g>
                                 <g>
                                 </g>
                                 <g>
                                 </g>
                                 <g>
                                 </g>
                                 <g>
                                 </g>
                                 <g>
                                 </g>
                                 <g>
                                 </g>
                                 <g>
                                 </g>
                                 <g>
                                 </g>
                                 <g>
                                 </g>
                                 <g>
                                 </g>
                                 <g>
                                 </g>
                                 <g>
                                 </g>
                                 <g>
                                 </g>
                                 <g>
                                 </g>
                                </svg>

                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{$cart_value}}
                            </span>

                           </a>
                        </li>
                        <li class="nav-item dropdown">
                           <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">{{auth()->user()->name}} <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li class="dropdown-item" style="background-color:@php echo Request::path()=="orders"?"#f7444e; border-radius:5px":"" @endphp"><a style="color:black" href="{{ route('order') }}">Orders</a></li>
                                <li class="dropdown-item"><a href="{{ route('logout') }}">Logout</a></li>
                              </ul>
                           </li>
                        </li>
                        {{-- <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">LOGOUT</a></li> --}}
                        @else
                            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link" style="color:@php echo Request::path()=="login"?"#f7444e":"black" @endphp">LOGIN</a></li>
                        @endif
                        <form class="form-inline">
                           <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                           <i class="fa fa-search" aria-hidden="true"></i>
                           </button>
                        </form>
                     </ul>
                  </div>
               </nav>
            </div>
         </header>


         @section('content')

         @show




               <!-- footer start -->
      <footer>
        <div class="container">
           <div class="row">
              <div class="col-md-4">
                  <div class="full">
                     <div class="logo_footer">
                        <a href="" class="navbar-brand text-dark fs-2 fw-bolder py-0">JMDElec</a>
                     </div>
                     <div class="information_f">
                       <p><strong>ADDRESS:</strong> 28 White tower, Street Name New York City, USA</p>
                       <p><strong>TELEPHONE:</strong> +91 987 654 3210</p>
                       <p><strong>EMAIL:</strong> yourmain@gmail.com</p>
                     </div>
                  </div>
              </div>
              <div class="col-md-8">
                 <div class="row">
                 <div class="col-md-7">
                    <div class="row">
                       <div class="col-md-6">
                    <div class="widget_menu">
                       <h3>Menu</h3>
                       <ul>
                          <li><a href="#">Home</a></li>
                          <li><a href="#">About</a></li>
                          <li><a href="#">Services</a></li>
                          <li><a href="#">Testimonial</a></li>
                          <li><a href="#">Blog</a></li>
                          <li><a href="#">Contact</a></li>
                       </ul>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="widget_menu">
                       <h3>Account</h3>
                       <ul>
                          <li><a href="#">Account</a></li>
                          <li><a href="#">Checkout</a></li>
                          <li><a href="#">Login</a></li>
                          <li><a href="#">Register</a></li>
                          <li><a href="#">Shopping</a></li>
                          <li><a href="#">Widget</a></li>
                       </ul>
                    </div>
                 </div>
                    </div>
                 </div>
                 <div class="col-md-5">
                    <div class="widget_menu">
                       <h3>Newsletter</h3>
                       <div class="information_f">
                         <p>Subscribe by our newsletter and get update protidin.</p>
                       </div>
                       <div class="form_sub">
                          <form>
                             <fieldset>
                                <div class="field">
                                   <input type="email" placeholder="Enter Your Mail" name="email" />
                                   <input type="submit" value="Subscribe" />
                                </div>
                             </fieldset>
                          </form>
                       </div>
                    </div>
                 </div>
                 </div>
              </div>
           </div>
        </div>
     </footer>
     <!-- footer end -->
     <div class="cpy_">
        <p>© 2021 All Rights Reserved</a></p>
     </div>
     <!-- jQery -->
     <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
     <!-- popper js -->
     <script src="{{ asset('js/popper.min.js') }}"></script>
     <!-- bootstrap js -->
     <script src="{{ asset('js/bootstrap.js') }}"></script>
     <!-- custom js -->
     <script src="{{ asset('js/custom.js') }}"></script>


  </body>
</html>
