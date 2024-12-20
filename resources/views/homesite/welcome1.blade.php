@extends('layouts/homemaster')
@section('content')
<style>
.flaticon-email:before {
    content: "\f134";
    color: white;
}

.newsletter-form .btn-style-one {
    vertical-align: middle;
    padding: 22.5px 35px;
    background: #fff;
    color: #2a2a2a;
    border: 1px dashed black;
    border-radius: 20px;
}
</style>
<!-- Bnner Section -->
<section class="banner-section">
    <div class="left-panel">
        <div class="side-menu-nav sidemenu-nav-toggler"><span class="flaticon-interface"></span>More</div>
        <div class="option-box">
            <div class="icon"><span class="flaticon-tracking"></span></div>
            <h4>Track <br> Shipment</h4>
            <div class="order-form-area">
                <div class="wrapper-box">
                    <h4>Track Your Shipment</h4>
                    <form class="order-form">
                        <div class="form-group">
                            <input type="text" placeholder="Enter Shipment Number *">
                        </div>
                        <div class="form-group">
                            <select class="selectpicker" name="make">
                                <option value="*">Type of Reference *</option>
                                <option value=".category-1">Package</option>
                                <option value=".category-3">Freight</option>
                                <option value=".category-4">Mail of Innovations</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="theme-btn btn-style-one"><span><i
                                        class="flaticon-up-arrow"></i>Track Now</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="option-box">
            <a href="pricing-plan.html">
                <div class="icon"><span class="flaticon-logistics"></span></div>
                <h4>Pricing <br> Plan</h4>
            </a>
        </div>
        <div class="option-box">
            <a href="grequest-quote.html">
                <div class="icon"><span class="flaticon-test"></span></div>
                <h4>Get A <br>Quote</h4>
            </a>
        </div>
    </div>
    <div class="background-text">
        <div data-parallax='{"x": 100}'>
            <div class="text-1">transida</div>
            <div class="text-2">transida</div>
        </div>
    </div>
    <div class="swiper-container banner-slider">
        <div class="swiper-wrapper">
            <!-- Slide Item -->
            <!-- Slide Item -->
            @foreach($site_details as $site)
            <?php $image = explode(',', $site->image); ?>

            @foreach($image as $i)

            <div class="swiper-slide" style="background-image: url({{url('public/admin/upload')}}/{{$i}});">
                <div class="content-outer">
                    <div class="content-box">
                        <div class="inner text-center">
                            <h4>Competitve rates </h4>
                            <h1>safety & reliable on-time</h1>
                            <div class="text">We denounce with righteous indignation & dislike beguiled</div>

                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @endforeach

        </div>
    </div>
    <div class="banner-slider-nav style-two">
        <div class="banner-slider-control banner-slider-button-prev"><span><i class="far fa-angle-left"></i>Prev</span>
        </div>
        <div class="banner-slider-control banner-slider-button-next"><span>Next<i class="far fa-angle-right"></i></span>
        </div>
    </div>
</section>
<!-- End Bnner Section -->

<!-- Services Section -->
<section class="services-section">
    <div class="auto-container">
        <div class="sec-title text-center">
            <div class="sub-title">Our Services</div>
            <h2>Navigate Our Service Categories</h2>
        </div>
        <div class="row">
            <div class="col-lg-4 service-block-one">
                <div class="inner-box wow  zoomIn hoverclass" data-wow-duration="1500ms">
                    <h4>Buy & Delivery</h4>
                    <div class="text">Let us shop for you! Our buy and delivery service saves you time and hassle....
                    </div>
                    <a href="{{url('readmore/buyanddelivery')}}" class="readmore-link" style="color:white"><i
                            class="flaticon-up-arrow" style="color:white"></i>More Details</a>
                    <div class="count"><span>01</span></div>
                    <div class="image" data-parallax='{"y": 30}'><img src="{{url('public/assets/images/images1.png')}}"
                            style="max-width: 210px !important;" alt=""></div>

                </div>
            </div>
            <div class="col-lg-4 service-block-one">
                <div class="inner-box wow   zoomIn hoverclass" data-wow-duration="1700ms">
                    <h4>Bike taxi</h4>
                    <div class="text">Zip through traffic and arrive on time with our efficient and convenient bike taxi
                        service...
                    </div>
                    <a href="{{url('readmore/biketaxi')}}" class="readmore-link" style="color:white"><i
                            class="flaticon-up-arrow" style="color:white"></i>More Details</a>
                    <div class="count"><span>02</span></div>
                    <div class="image" data-parallax='{"y": 30}'><img src="{{url('public/assets/images/images2.png')}}"
                            style="max-width: 210px !important;" alt=""></div>
                </div>
            </div>
            <div class="col-lg-4 service-block-one">
                <div class="inner-box wow   zoomIn hoverclass" data-wow-duration="1900ms">
                    <h4>A - Z delivery</h4>
                    <div class="text">A-to-Z delivery on two wheels - our fast and reliable delivery service gets your
                        items where they need to go, within the city
                    </div>
                    <a href="{{url('readmore/atozdelivery')}}" class="readmore-link" style="color:white"><i
                            class="flaticon-up-arrow" style="color:white"></i>More Details</a>
                    <div class="count"><span>03</span></div>
                    <div class="image" data-parallax='{"y": 30}'><img src="{{url('public/assets/images/images3.png')}}"
                            style="max-width: 210px !important;" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section" style="background-image: url({{url('public/assets/images/background/bg-1.jpg')}});">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-6">
                <div class="sec-title">
                    <div class="sub-title">Company</div>
                    <h2>Provide a <br> Reliable Services <br> Since 2018</h2>
                    <div class="text">We are a seasoned startup in the bike taxi and delivery industry, providing
                        on-demand services through our user-friendly mobile app. Our experienced team is committed to
                        delivering efficient and reliable solutions for our customers' transportation and delivery
                        needs.</div>
                    {{-- <a href="#" class="readmore-link"><i class="flaticon-up-arrow"></i>More Details</a> --}}
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="icon-box wow fadeInUp hoverclass zoomIn" style="border-radius:20px"
                            data-wow-duration="1500ms">
                            <div class="icon"><span class="flaticon-package"></span></div>
                            <div class="content">
                                <a href="{{url('readmore/about')}}">
                                    <h4>About <br>Our Company</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="icon-box wow fadeInUp hoverclass zoomIn" style="border-radius:20px"
                            data-wow-duration="1500ms">
                            <div class="icon"><span class="flaticon-goal"></span></div>
                            <div class="content">
                                <a href="{{url('readmore/mission')}}">
                                    <h4>Statement of <br> Mission</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="icon-box wow fadeInUp hoverclass zoomIn" style="border-radius:20px"
                            data-wow-duration="1700ms">
                            <div class="icon"><span class="flaticon-binoculars"></span></div>
                            <div class="content">
                                <a href="{{url('readmore/vision')}}">
                                    <h4>Statement of <br> Vision</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="icon-box wow fadeInUp hoverclass zoomIn" style="border-radius:20px"
                            data-wow-duration="1900ms">
                            <div class="icon"><span class="flaticon-gold"></span></div>
                            <div class="content">
                                <a href="{{url('readmore/value')}}">
                                    <h4>Statement of <br> Value</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="image wow fadeInRight" data-wow-duration="1500ms"><img
                        src="{{url('public/assets/images/resource/image-1.jpg')}}" alt=""></div>
            </div>
        </div>
    </div>
</section>

<!-- Whychooseus Section -->
<section class="Whychooseus-section">
    <div class="auto-container">
        <div class="sec-title text-center">
            <div class="sub-title text-center">Experience the Future of Delivery</div>
            <h2>What's in it for you</h2>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 why-choose-block">
                <div class="inner-box wow fadeInUp  zoomIn hoverclass" style="border-radius:20px"
                    data-wow-duration="1500ms">
                    <div class="icon"><span class="count">01</span><i class="flaticon-shield"></i></div>
                    <div class="content">
                        <h4>Transparent Pricing</h4>
                        <div class="text">Experience the ease of transparent pricing in our bike taxi & delivery service
                            - no hidden fees, no surprises, just straightforward and honest rates.</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 why-choose-block">
                <div class="inner-box wow fadeInUp  zoomIn hoverclass" style="border-radius:20px"
                    data-wow-duration="1500ms">
                    <div class="icon"><span class="count">02</span><i class="flaticon-delivery"></i></div>
                    <div class="content">
                        <h4>On - Time Delivery</h4>
                        <div class="text">Delivering your orders with precision and care - on time and always safely on
                            two wheels..</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 why-choose-block">
                <div class="inner-box wow fadeInUp  zoomIn hoverclass" style="border-radius:20px"
                    data-wow-duration="1500ms">
                    <div class="icon"><span class="count">03</span><i class="flaticon-24-hours"></i></div>
                    <div class="content">
                        <h4>Real Time Tracking</h4>
                        <div class="text">Experience swift and hassle-free deliveries with real-time tracking on our
                            bike taxi and delivery service.</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 why-choose-block">
                <div class="inner-box wow fadeInUp  zoomIn hoverclass" style="border-radius:20px"
                    data-wow-duration="1500ms">
                    <div class="icon"><span class="count">04</span><i class="flaticon-24-hours"></i></div>
                    <div class="content">
                        <h4>Online payment</h4>
                        <div class="text">Experience seamless and secure transactions on-the-go with our online payment
                            option for hassle-free bike taxi and delivery services.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Work-process Section -->
<section class="work-process-section">
    <div class="bg" style="background-image: url({{url('public/assets/images/background/bg-2.jpg')}});"></div>
    <div class="auto-container">
        <div class="sec-title text-center light">
            <div class="sub-title text-center" style="color:white !important">Driving Toward Safety</div>
            <h2>Our Promise to Our Users, Riders, and Prime Business Partners</h2>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 work-process-block">
                <div class="inner-box wow fadeInUp  zoomIn" data-wow-duration="1500ms">
                    <div class="count">01</div>
                    <div class="icon"><span class="flaticon-shipping"></span></div>
                    <h4>Safety for all</h4>
                    <div class="text">At do N key, safety is our top priority. We take extensive measures to ensure the
                        safety of our customers, riders, and prime business partners providing a comfortable and secure
                        ride for everyone.</div>
                    {{-- <a href="#" class="readmore-link"><i class="flaticon-up-arrow"></i>More Details</a> --}}
                </div>
            </div>
            <div class="col-lg-3 col-md-6 work-process-block">
                <div class="inner-box wow fadeInDown  zoomIn" data-wow-duration="1500ms">
                    <div class="count">02</div>
                    <div class="icon"><span class="flaticon-warehouse"></span></div>
                    <h4>For customers</h4>
                    <div class="text">do N key keeps a watchful eye on every ride with detailed access to the precise
                        latitude and longitude, providing a secure and reliable transportation experience.</div>
                    {{-- <a href="#" class="readmore-link"><i class="flaticon-up-arrow"></i>More Details</a> --}}
                </div>
            </div>
            <div class="col-lg-3 col-md-6 work-process-block">
                <div class="inner-box wow fadeInUp  zoomIn" data-wow-duration="1500ms">
                    <div class="count">03</div>
                    <div class="icon"><span class="flaticon-packing-list"></span></div>
                    <h4>For Riders</h4>
                    <div class="text">At do N key, we prioritize driver safety through comprehensive measures that
                        include verification, training, monitoring, and regular checks.</div>
                    {{-- <a href="#" class="readmore-link"><i class="flaticon-up-arrow"></i>More Details</a> --}}
                </div>
            </div>
            <div class="col-lg-3 col-md-6 work-process-block">
                <div class="inner-box wow fadeInDown  zoomIn" data-wow-duration="1500ms">
                    <div class="count">04</div>
                    <div class="icon"><span class="flaticon-delivery-1"></span></div>
                    <h4>Prime Business Partner</h4>
                    <div class="text">Ensuring proper safety measures and providing comprehensive guidance is our top
                        priority as your business partner in technical assistance. <br>
                        Effortless Transportation at Your Fingertips: Personalized Ride and Delivery Services, Just a
                        Tap Away</div>
                    {{-- <a href="#" class="readmore-link"><i class="flaticon-up-arrow"></i>More Details</a> --}}
                </div>
            </div>
        </div>
        <div class="bottom-text">Simplifying Your Freight & Logistics Needs With a Personal Approach. <a
                href="{{url('contact')}}"> Get In Touch</a></div>
    </div>
</section>
<!-- Button trigger modal -->

<!-- Modal -->

<!-- Industries Covered -->
<section class="industries-covered" style="background-image: url({{url('public/assets/images/background/bg-3.jpg')}});">
    <div class="background-text" data-parallax='{"x": 100}'>industries</div>
    <div class="outer-box side-container">
        <div class="outer-container">
            <div class="theme_carousel owl-theme owl-carousel"
                data-options='{"loop": true, "center": true, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 6000, "smartSpeed": 1000, "responsive":{ "0" :{ "items": "1" }, "600" :{ "items" : "1" }, "768" :{ "items" : "1" } , "992":{ "items" : "1" }, "1200":{ "items" : "1" }}}'>
                <div class="text-block">
                    <div class="inner-box">
                        <div class="image"
                            style="background-image: url({{url('public/assets/images/resource/image-2.jpg')}});">
                        </div>
                        <div class="content wow zoomIn" style="border-radius:20px">
                            <div class="icon"><span class="flaticon-spaceship"></span></div>
                            <h4>Join as <br> Prime business partner</h4>
                            <div class="text">Join Forces with Us: Together, We Can Take Our Business to the Next Level.
                            </div>
                            <div class="link">
                                <a href="{{url('readmore/primebusinesspartner')}}" class="readmore-link"><i
                                        class="flaticon-up-arrow"></i>More
                                    Details</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="text-block">
                    <div class="inner-box">
                        <div class="image"
                            style="background-image: url({{url('public/assets/images/resource/image-4.jpg')}});">
                        </div>
                        <div class="content wow  zoomIn" style="border-radius:20px">
                            <div class="icon"><span class="flaticon-spaceship"></span></div>
                            <h4>Join as Rider</h4>
                            <div class="text">Ride and Deliver Your Way to Success: Be Your Own Boss with Our Bike Taxi
                                and Delivery Service. </div>
                            <div class="link">
                                <a href="{{url('readmore/joinasrider')}}" class="readmore-link"><i
                                        class="flaticon-up-arrow"></i>More
                                    Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-block">
                    <div class="inner-box">
                        <div class="image"
                            style="background-image: url({{url('public/assets/images/resource/image-5.jpg')}});">
                        </div>
                        <div class="content wow zoomIn" style="border-radius:20px">
                            <div class="icon"><span class="flaticon-box-1"></span></div>
                            <h4>Business customers</h4>
                            <div class="text">Multi-Delivery Made Easy: See How Our Business Customers Are Enjoying the
                                Benefits. </div>
                            <div class="link">
                                <a href="{{url('readmore/businesscustomer')}}" class="readmore-link"><i
                                        class="flaticon-up-arrow"></i>More
                                    Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about-section"
    style="margin-top:40px;margin-bottom:40px;background-image: url({{url('public/assets/images/background/bg-1.jpg')}});">
    <!-- <div class="auto-container"> -->
    <div class="car">
        <div class="weel weel1"></div>
        <div class="weel weel2"></div>
    </div>
    <!-- </div> -->
</section>
<section class="newsletter-section">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-5">
                <h3><span class="flaticon-email"></span> Subscribe Our Newsletter <br> & Get Updates.</h3>
            </div>
            <div class="col-lg-7">
                <div class="newsletter-form">
                    <form class="ajax-sub-form" method="post">
                        <div class="form-group">
                            <i class="far fa-envelope-open"></i>
                            <input type="email" placeholder="Enter Your Email Address..." id="subscription-email">
                            <button type="submit" class="theme-btn btn-style-one"><span><i
                                        class="flaticon-up-arrow"></i>Subscribe</span></button>
                            <label class="subscription-label" for="subscription-email"></label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
