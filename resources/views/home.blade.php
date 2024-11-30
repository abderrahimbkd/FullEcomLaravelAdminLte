 @extends('layouts.app')
 @section('content')
     <main class="main">
         <div class="intro-section bg-lighter pt-5 pb-6">
             <div class="container">
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="intro-slider-container slider-container-ratio slider-container-1 mb-2 mb-lg-0">
                             <div class="intro-slider intro-slider-1 owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl"
                                 data-owl-options='{
                                        "nav": false, 
                                        "responsive": {
                                            "768": {
                                                "nav": true
                                            }
                                        }
                                    }'>
                                 @foreach ($getSlider as $slider)
                                     @if (!empty($slider->getImage()))
                                         <div class="intro-slide">
                                             <figure class="slide-image">
                                                 <picture>
                                                     <source media="(max-width: 480px)" srcset="{{ $slider->getImage() }}">
                                                     <img src="{{ $slider->getImage() }}" alt="Image Desc">
                                                 </picture>
                                             </figure><!-- End .slide-image -->

                                             <div class="intro-content  ">
                                                 <h1 class="intro-title ">{{ $slider->title }}</h1><!-- End .intro-title -->
                                                 @if (!empty($slider->button_link) && !empty($slider->button_name))
                                                     <a href="{{ $slider->button_link }}" class="btn btn-outline-white">
                                                         <span>{{ $slider->button_name }}</span>
                                                         <i class="icon-long-arrow-right"></i>
                                                     </a>
                                                 @endif

                                             </div><!-- End .intro-content -->
                                         </div><!-- End .intro-slide -->
                                     @endif
                                 @endforeach



                             </div><!-- End .intro-slider owl-carousel owl-simple -->

                             <span class="slider-loader"></span><!-- End .slider-loader -->
                         </div><!-- End .intro-slider-container -->
                     </div><!-- End .col-lg-8 -->

                 </div><!-- End .row -->

                 <div class="mb-6"></div><!-- End .mb-6 -->

                 <div class="owl-carousel owl-simple" data-toggle="owl"
                     data-owl-options='{
                            "nav": false, 
                            "dots": false,
                            "margin": 30,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":2
                                },
                                "420": {
                                    "items":3
                                },
                                "600": {
                                    "items":4
                                },
                                "900": {
                                    "items":5
                                },
                                "1024": {
                                    "items":6
                                }
                            }
                        }'>
                     <a href="#" class="brand">
                         <img src="front/assets/images/brands/1.png" alt="Brand Name">
                     </a>

                     <a href="#" class="brand">
                         <img src="front/assets/images/brands/2.png" alt="Brand Name">
                     </a>

                     <a href="#" class="brand">
                         <img src="front/assets/images/brands/3.png" alt="Brand Name">
                     </a>

                     <a href="#" class="brand">
                         <img src="front/assets/images/brands/4.png" alt="Brand Name">
                     </a>

                     <a href="#" class="brand">
                         <img src="front/assets/images/brands/5.png" alt="Brand Name">
                     </a>

                     <a href="#" class="brand">
                         <img src="front/assets/images/brands/6.png" alt="Brand Name">
                     </a>
                 </div><!-- End .owl-carousel -->
             </div><!-- End .container -->
         </div><!-- End .bg-lighter -->

         <div class="mb-6"></div><!-- End .mb-6 -->
         @if (!empty($getProductTrendy->count()))
             <div class="container">
                 <div class="heading heading-center mb-3">
                     <h2 class="title-lg">Trendy Products</h2><!-- End .title -->
                 </div><!-- End .heading -->

                 <div class="tab-content tab-content-carousel">
                     <div class="tab-pane p-0 fade show active" id="trendy-all-tab" role="tabpanel" aria-labelledby="trendy-all-link">
                         <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                             data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":4,
                                        "nav": true,
                                        "dots": false
                                    }
                                }
                            }'>



                             @foreach ($getProductTrendy as $value)
                                 @php
                                     $getProductImage = $value->getImageSingle($value->id);
                                 @endphp
                                 <div class="product product-7 text-center">
                                     <figure class="product-media">

                                         <a href="{{ url($value->slug) }}">
                                             @if (!empty($getProductImage) && !empty($getProductImage->getLogo()))
                                                 <img style="height: 280px;width:100%;object-fit:cover" src="{{ $getProductImage->getLogo() }}"
                                                     alt="{{ $value->title }}" class="product-image">
                                             @endif
                                         </a>

                                         <div class="product-action-vertical">

                                             @if (!empty(Auth::check()))
                                                 <a href="javascript:;"
                                                     class="add_to_wishlist add_to_wishlist{{ $value->id }} btn-product-icon btn-wishlist btn-expandable  {{ !empty($value->checkWishlist($value->id)) ? 'btn-wishlist-add' : '' }} "
                                                     title="Wishlist" id="{{ $value->id }}"><span>Add to
                                                         Wishlist</span></a>
                                             @else
                                                 <a href="#signin-modal" data-toggle="modal" class="btn-product-icon btn-wishlist btn-expandable"
                                                     title="Wishlist"><span>Add to
                                                         Wishlist</span></a>
                                             @endif

                                         </div><!-- End .product-action-vertical -->

                                     </figure><!-- End .product-media -->

                                     <div class="product-body">
                                         <div class="product-cat">
                                             <a
                                                 href="{{ url($value->category_slug . '/' . $value->sub_category_slug) }}">{{ $value->sub_category_name }}</a>
                                         </div><!-- End .product-cat -->
                                         <h3 class="product-title"><a href="{{ url($value->slug) }}">{{ $value->title }}</a></h3>
                                         <!-- End .product-title -->
                                         <div class="product-price">
                                             ${{ number_format($value->price, 2) }}
                                         </div><!-- End .product-price -->
                                         <div class="ratings-container">
                                             <div class="ratings">
                                                 <div class="ratings-val" style="width: {{ $value->getReviewRating($value->id) }}%;"></div>
                                                 <!-- End .ratings-val -->
                                             </div><!-- End .ratings -->
                                             <span class="ratings-text">( {{ $value->getTotalReview() }} Reviews )</span>
                                         </div><!-- End .rating-container -->


                                     </div><!-- End .product-body -->
                                 </div><!-- End .product -->
                             @endforeach



                         </div><!-- End .owl-carousel -->
                     </div><!-- .End .tab-pane -->
                 </div><!-- End .tab-content -->
             </div><!-- End .container -->
         @endif


         @if (!empty($getCategory->count()))
             <div class="container categories pt-6">
                 <h2 class="title-lg text-center mb-4">Shop by Categories</h2><!-- End .title-lg text-center -->

                 <div class="row">
                     @foreach ($getCategory as $category)
                         @if (!empty($category->getImage()))
                             <div class="col-sm-12 col-lg-4 banners-sm">
                                 <div class="banner banner-display banner-link-anim col-lg-12 col-6">
                                     <a href="{{ url($category->slug) }}">
                                         <img src="{{ $category->getImage() }}" alt="{{ $category->name }}" style="height: 260px">
                                     </a>

                                     <div class="banner-content banner-content-center">
                                         <h3 class="banner-title text-white"><a href="{{ url($category->slug) }}">{{ $category->name }}</a></h3>
                                         <!-- End .banner-title -->
                                         @if (!empty($category->button_name))
                                             <a href="{{ url($category->slug) }}"
                                                 class="btn btn-outline-white banner-link">{{ $category->button_name }}<i
                                                     class="icon-long-arrow-right"></i></a>
                                         @endif

                                     </div><!-- End .banner-content -->
                                 </div>
                             </div><!-- End .col-sm-6 col-lg-3 -->
                         @endif
                     @endforeach

                 </div><!-- End .row -->
             </div><!-- End .container -->

             <div class="mb-5"></div><!-- End .mb-6 -->
         @endif



         <div class="container">
             <div class="heading heading-center mb-6">
                 <h2 class="title">Recent Arrivals</h2><!-- End .title -->

                 <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                     <li class="nav-item">
                         <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab" role="tab"
                             aria-controls="top-all-tab" aria-selected="true">All</a>
                     </li>
                     @foreach ($getCategory as $category)
                         <li class="nav-item">
                             <a class="nav-link getCategoryProduct" data-val="{{ $category->id }}" id="top-{{ $category->slug }}-link"
                                 data-toggle="tab" href="#top-{{ $category->slug }}-tab" role="tab"
                                 aria-controls="top-{{ $category->slug }}-tab" aria-selected="false">{{ $category->name }}</a>
                         </li>
                     @endforeach

                 </ul>
             </div><!-- End .heading -->

             <div class="tab-content">
                 <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
                     <div class="products">
                         <div class="row justify-content-center">
                             @php
                                 $is_home = 1;
                             @endphp

                         </div><!-- End .row -->
                         @include('product._list')
                     </div><!-- End .products -->
                     <div class="more-container text-center">
                         <a href="{{ url('search') }}" class="btn btn-outline-darker btn-more"><span>Load more products</span><i
                                 class="icon-long-arrow-down"></i></a>
                     </div>
                 </div><!-- .End .tab-pane -->
                 @foreach ($getCategory as $category)
                     <div class="tab-pane p-0 fade getCategoryProduct{{ $category->id }}" id="top-{{ $category->slug }}-tab" role="tabpanel"
                         aria-labelledby="top-{{ $category->slug }}-link">
                     </div><!-- .End .tab-pane -->
                 @endforeach

             </div><!-- End .tab-content -->

         </div><!-- End .container -->

         <div class="container">
             <hr>
             <div class="row justify-content-center">
                 <div class="col-lg-4 col-sm-6">
                     <div class="icon-box icon-box-card text-center">
                         <span class="icon-box-icon">
                             <i class="icon-rocket"></i>
                         </span>
                         <div class="icon-box-content">
                             <h3 class="icon-box-title">Payment & Delivery</h3><!-- End .icon-box-title -->
                             <p>Free shipping for orders over $50</p>
                         </div><!-- End .icon-box-content -->
                     </div><!-- End .icon-box -->
                 </div><!-- End .col-lg-4 col-sm-6 -->

                 <div class="col-lg-4 col-sm-6">
                     <div class="icon-box icon-box-card text-center">
                         <span class="icon-box-icon">
                             <i class="icon-rotate-left"></i>
                         </span>
                         <div class="icon-box-content">
                             <h3 class="icon-box-title">Return & Refund</h3><!-- End .icon-box-title -->
                             <p>Free 100% money back guarantee</p>
                         </div><!-- End .icon-box-content -->
                     </div><!-- End .icon-box -->
                 </div><!-- End .col-lg-4 col-sm-6 -->

                 <div class="col-lg-4 col-sm-6">
                     <div class="icon-box icon-box-card text-center">
                         <span class="icon-box-icon">
                             <i class="icon-life-ring"></i>
                         </span>
                         <div class="icon-box-content">
                             <h3 class="icon-box-title">Quality Support</h3><!-- End .icon-box-title -->
                             <p>Alway online feedback 24/7</p>
                         </div><!-- End .icon-box-content -->
                     </div><!-- End .icon-box -->
                 </div><!-- End .col-lg-4 col-sm-6 -->
             </div><!-- End .row -->

             <div class="mb-2"></div><!-- End .mb-2 -->
         </div><!-- End .container -->
         <div class="blog-posts pt-7 pb-7" style="background-color: #fafafa;">
             <div class="container">
                 <h2 class="title-lg text-center mb-3 mb-md-4">From Our Blog</h2><!-- End .title-lg text-center -->

                 <div class="owl-carousel owl-simple carousel-with-shadow" data-toggle="owl"
                     data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "600": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                }
                            }
                        }'>
                     <article class="entry entry-display">
                         <figure class="entry-media">
                             <a href="single.html">
                                 <img src="front/assets/images/blog/home/post-1.jpg" alt="image desc">
                             </a>
                         </figure><!-- End .entry-media -->

                         <div class="entry-body pb-4 text-center">
                             <div class="entry-meta">
                                 <a href="#">Nov 22, 2018</a>, 0 Comments
                             </div><!-- End .entry-meta -->

                             <h3 class="entry-title">
                                 <a href="single.html">Sed adipiscing ornare.</a>
                             </h3><!-- End .entry-title -->

                             <div class="entry-content">
                                 <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit.<br>Pelletesque aliquet nibh
                                     necurna. </p>
                                 <a href="single.html" class="read-more">Read More</a>
                             </div><!-- End .entry-content -->
                         </div><!-- End .entry-body -->
                     </article><!-- End .entry -->

                     <article class="entry entry-display">
                         <figure class="entry-media">
                             <a href="single.html">
                                 <img src="front/assets/images/blog/home/post-2.jpg" alt="image desc">
                             </a>
                         </figure><!-- End .entry-media -->

                         <div class="entry-body pb-4 text-center">
                             <div class="entry-meta">
                                 <a href="#">Dec 12, 2018</a>, 0 Comments
                             </div><!-- End .entry-meta -->

                             <h3 class="entry-title">
                                 <a href="single.html">Fusce lacinia arcuet nulla.</a>
                             </h3><!-- End .entry-title -->

                             <div class="entry-content">
                                 <p>Sed pretium, ligula sollicitudin laoreet<br>viverra, tortor libero sodales leo, eget blandit nunc tortor eu
                                     nibh. Nullam mollis justo. </p>
                                 <a href="single.html" class="read-more">Read More</a>
                             </div><!-- End .entry-content -->
                         </div><!-- End .entry-body -->
                     </article><!-- End .entry -->

                     <article class="entry entry-display">
                         <figure class="entry-media">
                             <a href="single.html">
                                 <img src="front/assets/images/blog/home/post-3.jpg" alt="image desc">
                             </a>
                         </figure><!-- End .entry-media -->

                         <div class="entry-body pb-4 text-center">
                             <div class="entry-meta">
                                 <a href="#">Dec 19, 2018</a>, 2 Comments
                             </div><!-- End .entry-meta -->

                             <h3 class="entry-title">
                                 <a href="single.html">Quisque volutpat mattis eros.</a>
                             </h3><!-- End .entry-title -->

                             <div class="entry-content">
                                 <p>Suspendisse potenti. Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero
                                     eu augue. </p>
                                 <a href="single.html" class="read-more">Read More</a>
                             </div><!-- End .entry-content -->
                         </div><!-- End .entry-body -->
                     </article><!-- End .entry -->
                 </div><!-- End .owl-carousel -->
             </div><!-- container -->

             <div class="more-container text-center mb-0 mt-3">
                 <a href="blog.html" class="btn btn-outline-darker btn-more"><span>View more articles</span><i class="icon-long-arrow-right"></i></a>
             </div><!-- End .more-container -->
         </div>
         <div class="cta cta-display bg-image pt-4 pb-4" style="background-image: url(front/assets/images/backgrounds/cta/bg-6.jpg);">
             <div class="container">
                 <div class="row justify-content-center">
                     <div class="col-md-10 col-lg-9 col-xl-8">
                         <div class="row no-gutters flex-column flex-sm-row align-items-sm-center">
                             <div class="col">
                                 <h3 class="cta-title text-white">Sign Up & Get 10% Off</h3><!-- End .cta-title -->
                                 <p class="cta-desc text-white">Molla presents the best in interior design</p><!-- End .cta-desc -->
                             </div><!-- End .col -->

                             <div class="col-auto">
                                 <a href="login.html" class="btn btn-outline-white"><span>SIGN UP</span><i class="icon-long-arrow-right"></i></a>
                             </div><!-- End .col-auto -->
                         </div><!-- End .row no-gutters -->
                     </div><!-- End .col-md-10 col-lg-9 -->
                 </div><!-- End .row -->
             </div><!-- End .container -->
         </div><!-- End .cta -->
     </main><!-- End .main -->
 @endsection

 @section('script')
     <script type="text/javascript">
         $('body').delegate('.getCategoryProduct', 'click', function() {

             var category_id = $(this).attr('data-val');
             $.ajax({
                 type: 'POST',
                 url: "{{ url('recent_arrival_category_product') }}",
                 data: {
                     "_token": "{{ csrf_token() }}",
                     category_id: category_id,
                 },
                 dataType: 'json',
                 success: function(response) {
                     $('.getCategoryProduct' + category_id).html(response.success);
                 },
                 error: function(data) {

                 }
             });

         });
     </script>
 @endsection
