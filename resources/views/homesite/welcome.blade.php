@extends('layouts/homemaster')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap">

    <style>
        /* Media query for screens smaller than 768px (typical mobile devices) */
        /* @media (max-width: 320px) {
                h5 {
                    margin-top:-120px;
                    font-size: 8px;
                }
        
                h1 {
                    font-size: 10cm;
                    margin-bottom: -40px;
        
                }
        
                h3 {
                    font-size: 5px;
                    display:flex;
                    margin-top: -20px;
                }
        
                .text {
                    font-size: 10px;
                }
        
                ul {
                    justify-content: flex-start; /* Align list items to the left */
        /* }
        
                li {
                    margin-right: 5px;
                    font-size: 14px;
                }
        
                button {
                    font-size: 8px;
                    margin-top: 10px;
                }
            }  */
       

       
    </style>
    <style>
    .owl-nav{
            display:  none !important;
        }
        body{
        overflow-x:hidden !important;
        }
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

        .sec1 {
            opacity: 0;
            filter: blur(2px);
            transition: all 1s;
            transform: translateX(-100%);
            scroll-behavior: smooth;
        }

        .show {
            opacity: 1;
            filter: blur(0);
            transform: translateX(0);
            scroll-behavior: smooth;


        }

        .fadeInRight {
            animation-name: fadeInRight;
            scroll-behavior: smooth;

        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translate3d(100%, 0, 0);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }
        @media (max-width: 480px) {
    .sty {
        font-size: 20px !important;
        margin-top:-70px !important;
    }

    .styl {
        font-size: 24px !important;
    }

    .styll {
        font-size: 20px !important;
        margin-top:-60px !important;
        
    }

    .stylll {
        font-size: 12px !important;
        margin-top:-60px !important;
        margin-bottom:30px !important;
    }

    .styyy {
        margin-top:-20px !important;
        font-size: 10px !important;
    }

    .styy {
        font-size: 15px !important;
        
        /* height:25px !important; */
        text-align: center !important;
        
    }
    .cc{
        margin-top:-90px !important;
    }
    .ando{
        width:350px !important;
    }
    .bgim{
        background-size:100% 200px !important;
        background-repeat:no-repeat !important;
    }
    .dts{
        margin-top:-40px !important;
    }
    .opto{
        font-size: 12px !important;
        margin-top:-10px !important;
    }
    .eff{
        margin-left:20px !important;
    }
    .efff{
        display:inline-block !important;
    }
    .subs{
        margin-left:70px !important;
    }
    .cri{
        margin-left:30px !important;
    }
    .cw{
        width:250px !important;
        height:250px !important;
    }
    .ihw{
       margin-top:-10px !important;
        width:25px !important;
        height:25px !important; 
    }
    .ihww{
       margin-top:-19px !important;
        width:25px !important;
        height:25px !important; 
    }
    .bjp{
        font-size: 15px !important;
        margin-top:-20px !important;
    }
    .bjpp{
        font-size: 15px !important;
        margin-top:-30px !important;
    }
    .ct{
        font-size:12px !important;
        margin-top:-16px !important;
    }
    .mds{
        margin-top:-20px !important;
        font-size:10px !important;
        /* padding:0px !important;
         */
         padding-right: 9px !important;
         padding-left: 9px !important;
         padding-top:0px !important;
         padding-bottom:0px !important;
    }
    .ceme{
        height:650px !important;
    }
}
@media only screen and (max-width:991px){
.couosal_image{
    /* background-size: 100% 100%; */
    right: 0px !important;
    background-size: 100% 100% !important;
background-repeat: no-repeat;
}
}
    </style>
    <!-- Bnner Section -->
    <section class="banner-section cc">

       
        <div class="swiper-container banner-slider">
            <!-- Slide Item -->
            <!-- Slide Item -->
            @foreach ($site_details as $site)
                <?php $image = explode(',', $site->image); ?>

                @foreach ($image as $i)
                    <div class="swiper-slide"
                        style="background: rgb(216,247,124);
            background: linear-gradient(0deg, rgba(216,247,124,1) 0%, rgba(76,77,76,1) 99%);">

                        <div class="content-outer">
                            <div class="content-box">
                                <div class="inner text-center ">
                                    <h5 class="sty"
                                        style="font-family: 'Times New Roman', Times, serif; font-weight: 700; font-size: 24px; color: whitesmoke; margin-bottom: 2%;">
                                        Begin Your Business with Our Pocket-Friendly Subscription!</h5>
                                    <br>
                                    <h1 class="styl">"Prime Business Partner"</h1>
                                    <h3 class="styll">Your Exclusive Way to Advance Your Career</h3>

                                   
                                        <h5 class="stylll" style="font-size: 20px; background: #C23B36; background: repeating-linear-gradient(to top right, #C23B36 0%, #FC4F49 98%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-family: 'Times New Roman', Times, serif; margin-bottom:20px; "> Hurry, Areas Are Filling Up Fast!</h5>

                                    <ul style="list-style: none; display: flex; justify-content: center; padding: 0;">
                                        <li class="styyy"
                                            style="margin-right: 10px; font-size: 16px; color: black; font-family: Georgia, 'Times New Roman', Times, serif;">
                                            🚫 No Deposit</li>
                                        <li class="styyy"
                                            style="font-size: 16px; color: black; font-family: Georgia, 'Times New Roman', Times, serif;">
                                            🚫 No Hidden Charges</li>
                                    </ul>

                                    <a href="{{ url('pbp') }}">
                                        <button type="submit" class="btn btn-lg custom-btnn styy"
                                            style="background: linear-gradient(#d3ff53, #d7ed93); color: black; border: none; margin-top: 20px; font-family: 'Times New Roman', Times, serif; font-weight: 900;">Join
                                            with Us</button>
                                    </a>
                                </div>
                            </div>
                        </div>




                    </div>
                @endforeach
            @endforeach

        </div>
        </div>
        {{-- <div class="banner-slider-nav style-two">
        <div class="banner-slider-control banner-slider-button-prev"><span><i class="far fa-angle-left"></i>Prev</span>
        </div>
        <div class="banner-slider-control banner-slider-button-next"><span>Next<i class="far fa-angle-right"></i></span>
        </div>
    </div> --}}
    </section>
    <!-- End Bnner Section -->

    <!-- Services Section -->
    <section class="services-section">
        <div class="auto-container">
            <div class="sec-title text-center">
                <div class="sub-title">Three Paths to Success</div>
                <h2>Navigate Our Service Categories</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 service-block-one">
                    <div class="inner-box wow  zoomIn hoverclass" data-wow-duration="1500ms"
                        style="padding-bottom: 26px !important;">
                        <h4>Buy & Delivery</h4>
                        <div class=" text">Let us shop for you! Our buy and delivery service saves you time and hassle....
                        </div>
                        <a href="{{ url('readmore/buyanddelivery') }}" class="readmore-link" style="color:white"><i
                                class="flaticon-up-arrow" style="color:white"></i>More Details</a>
                        <div class="count"><span>01</span></div>
                        <div class="image" data-parallax='{"y": 30}'><img
                                src="{{ url('public/assets/images/images1.png') }}" style="max-width: 210px !important;"
                                alt=""></div>

                    </div>
                </div>
                <div class="col-lg-4 service-block-one">
                    <div class="inner-box wow   zoomIn hoverclass" data-wow-duration="1700ms"
                        style="padding-bottom: 26px !important;">
                        <h4>Bike taxi</h4>
                        <div class="text">Zip through traffic and arrive on time with our efficient and convenient bike
                            taxi
                            service...
                        </div>
                        <a href="{{ url('readmore/biketaxi') }}" class="readmore-link" style="color:white"><i
                                class="flaticon-up-arrow" style="color:white"></i>More Details</a>
                        <div class="count"><span>02</span></div>
                        <div class="image" data-parallax='{"y": 30}'><img
                                src="{{ url('public/assets/images/images2.png') }}" style="max-width: 210px !important;"
                                alt=""></div>
                    </div>
                </div>
                <div class="col-lg-4 service-block-one">
                    <div class="inner-box wow   zoomIn hoverclass" data-wow-duration="1900ms">
                        <h4>A - Z delivery</h4>
                        <div class="text">A-to-Z delivery on two wheels - our fast and reliable delivery service gets your
                            items where they need to go, within the city
                        </div>
                        <a href="{{ url('readmore/atozdelivery') }}" class="readmore-link" style="color:white"><i
                                class="flaticon-up-arrow" style="color:white"></i>More Details</a>
                        <div class="count"><span>03</span></div>
                        <div class="image" data-parallax='{"y": 30}'><img
                                src="{{ url('public/assets/images/images3.png') }}" style="max-width: 210px !important;"
                                alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section"
        style="background-image: url('public/assets/images/bg-1.jpg'); background-repeat: no-repeat;
background-size: cover; ">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="sec-title">
                        <div class="sub-titlee" style="font-size: 27px; font-weight:600;"><b>Company</b></div><br>
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
                                    <a href="{{ url('readmore/about') }}">
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
                                    <a href="{{ url('readmore/mission') }}">
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
                                    <a href="{{ url('readmore/vision') }}">
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
                                    <a href="{{ url('readmore/value') }}">
                                        <h4>Statement of <br> Value</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="image wow fadeInRight" data-aos="fade-in" data-wow-duration="1500ms"
                        data-wow-offset="50">
                        <img class="ando"  src="{{ url('public/assets/images/services.png') }}" alt="">
                    </div>
                </div>

                <script>
                    new WOW().init();
                </script>

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
                            <div class="text">No hidden fees, no surprises. Honest rates for our bike taxi and delivery
                                service..</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 why-choose-block">
                    <div class="inner-box wow fadeInUp  zoomIn hoverclass" style="border-radius:20px"
                        data-wow-duration="1500ms">
                        <div class="icon"><span class="count">02</span><i><img class="imgg"
                                    src="public/assets/images/icons/delivery-bike.png" alt=""
                                    style="height: 39px; width:39px; padding-bottom:3px;"> </i></div>
                        <div class="content">
                            <h4>On - Time Delivery</h4>
                            <div class="text">Delivering your orders with precision and care - on time and always safely
                                on
                                two wheels.. <br> </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 why-choose-block">
                    <div class="inner-box wow fadeInUp  zoomIn hoverclass" style="border-radius:20px"
                        data-wow-duration="1500ms">
                        <div class="icon"><span class="count">03</span><i class="flaticon-24-hours"></i></div>
                        <div class="content">
                            <h4>Real Time Tracking</h4>
                            <div class="text">Enjoy rapid and hassle-free bike taxi and delivery services with live
                                tracking..<br> </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 why-choose-block">
                    <div class="inner-box wow fadeInUp  zoomIn hoverclass" style="border-radius:20px"
                        data-wow-duration="1500ms">
                        <div class="icon"><span class="count">04</span><i><img class="imgg"
                                    src="public/assets/images/icons/payment.png" alt=""> </i></div>
                        <div class=" content">
                            <h4>Online payment</h4>
                            <div class="text">Enjoy secure mobile payments for hassle-free bike taxi and delivery
                                services on the go..</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Work-process Section -->
    <section class="work-process-section">
        <div class="bg bgim" style="background-image: url('public/assets/images/ban.jpg');"></div>
        <div class="auto-container">
            <div class="sec-title text-center light dts">
                <div class="sub-title text-center" style="color:white !important">Driving Toward Safety</div>
                <h2 class="opto">Our Promise to Our Users, Riders, and Prime Business Partners</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 work-process-block">
                    <div class="inner-box wow fadeInUp  zoomIn" data-wow-duration="1500ms">
                        <div class="count">01</div>
                        <div class="icon"><span class="flaticon-shipping"></span></div>
                        <h4>Safety for all</h4>
                        <div class="text">At do N key, safety is our top priority. We take extensive measures to ensure
                            the
                            safety of our customers, riders, and prime business partners providing a comfortable and secure
                            ride for everyone.</div>
                        {{-- <a href="#" class="readmore-link"><i class="flaticon-up-arrow"></i>More Details</a> --}}
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 work-process-block">
                    <div class="inner-box wow fadeInDown  zoomIn" data-wow-duration="1500ms">
                        <div class="count">02</div>
                        <div class="icon"><span><img src="public/assets/images/icons/rating.png" alt=""
                                    style="width: 50px; height:50px;"></span></div>
                        <h4>For customers</h4>
                        <div class="text">do N key keeps a watchful eye on every ride with detailed access to the precise
                            latitude and longitude, providing a secure and reliable transportation experience.</div>
                        {{-- <a href="#" class="readmore-link"><i class="flaticon-up-arrow"></i>More Details</a> --}}
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 work-process-block">
                    <div class="inner-box wow fadeInUp  zoomIn" data-wow-duration="1500ms">
                        <div class="count">03</div>
                        <div class="icon"><span><img src="public/assets/images/icons/delivery-bike.png" alt=""
                                    style="width: 50px; height:50px;"></span></div>
                        <h4>For Riders</h4>
                        <div class="text">At do N key, we prioritize driver safety through comprehensive measures that
                            include verification, training, monitoring, and regular checks.</div>
                        {{-- <a href="#" class="readmore-link"><i class="flaticon-up-arrow"></i>More Details</a> --}}
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 work-process-block">
                    <div class="inner-box wow fadeInDown  zoomIn" data-wow-duration="1500ms">
                        <div class="count">04</div>
                        <div class="icon"><span><img src="public/assets/images/icons/deal.png" alt=""
                                    style="width: 50px; height:50px;"></span></div>
                        <h4>Prime Business Partner</h4>
                        <div class="text">Ensuring proper safety measures and providing comprehensive guidance is our top
                            priority as your business partner in technical assistance. <br>
                        </div>
                        {{-- <a href="#" class="readmore-link"><i class="flaticon-up-arrow"></i>More Details</a> --}}

                    </div>
                </div>
            </div>
            <div>

                <!-- <div class="container mt-5">
                                <center>
                                    <blockquote> <b>
                                            Effortless Transportation at Your Fingertips:
                                        </b> &nbsp; Personalized Ride and Delivery Services, Just a Tap Away.
                                        <span>
                                            <a href="{{ url('contact') }}"> Get In Touch</a>
                                </center>
                                </span>
                                </blockquote>


                            </div> -->

                <div class="container mt-5 sec1 eff">
                    <center>
                        <blockquote class="efff">
                            <b>Effortless Transportation at Your Fingertips:</b>&nbsp;Personalized Ride and Delivery
                            Services, Just a Tap Away.
                            <span><a href="{{ url('contact') }}">Get In Touch</a></span>
                        </blockquote>
                    </center>
                </div>
                <script>
                    const ele = document.querySelectorAll('.sec1');

                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('show');
                            } else {
                                entry.target.classList.remove('show');

                            }
                        });
                    });

                    ele.forEach((el) => observer.observe(el));
                </script>
            </div>
    </section>
    <!-- Button trigger modal -->

    <!-- Modal -->

    <!-- Industries Covered -->
    <section class="industries-covered ceme" style="background-image: url('public/assets/images/sandal.jpg'); height:850px;">
        <div class="background-text" data-parallax='{"x": 100}'></div>
        <div class="outer-box side-container">
            <div class="outer-container">
                <div class="theme_carousel owl-theme owl-carousel"
                    data-options='{"loop": true, "center": true, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 6000, "smartSpeed": 1800, "responsive":{ "0" :{ "items": "1" }, "600" :{ "items" : "1" }, "768" :{ "items" : "1" } , "992":{ "items" : "1" }, "1200":{ "items" : "1" }}}'>
                    <div class="text-block">
                        <div class="inner-box">
                            <div class="image couosal_image" style="background-image: url('public/assets/images/busi.jpeg');">
                            </div>
                            <div class="content wow zoomIn cw" style="border-radius:20px">
                                <div class="icon"><span><img src="public/assets/images/icons/deal.png" alt=""
                                            style="width: 55px; height:55px;" class="ihww"></span></div>
                                <h4 class="bjpp">Join as <br> Prime business partner</h4>
                                <div class="text ct">Join Forces with Us: Together, We Can Take Our Business to the Next
                                    Level.
                                </div>

                                <div class="link">
                                    <a href="{{ url('readmore/primebusinesspartner') }}" class="readmore-link theme mds"
                                        style="background: #fff;
                                            color: #2a2a2a;
                                            border: 1px dashed black;
                                            border-radius: 20px;"><i
                                            class="flaticon-up-arrow"></i>More
                                        Details</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="text-block">
                        <div class="inner-box">
                            <div class="image couosal_image" style="background-image: url('public/assets/images/rid.jpg');">
                            </div>
                            <div class="content wow  zoomIn cw" style="border-radius:20px">
                                <div class="icon"><span><img src="public/assets/images/icons/two.png" alt=""
                                            style="width: 50px; height:50px;" class="ihw"></span></div>
                                <h4 class="bjpp">Join as Rider</h4>
                                <div class="text ct">Ride and Deliver Your Way to Success: Be Your Own Boss with Our Bike
                                    Taxi
                                    and Delivery Service. </div>

                                <div class="link">
                                    <a href="{{ url('readmore/joinasrider') }}" class="readmore-link theme mds"
                                        style="background: #fff;
    color: #2a2a2a;
    border: 1px dashed black;
    border-radius: 20px;" ><i
                                            class="flaticon-up-arrow"></i>More
                                        Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-block">
                        <div class="inner-box">
                            <div class="image couosal_image" style="background-image: url('public/assets/images/bscs.jpg');">
                            </div>
                            <div class="content wow zoomIn cw" style="border-radius:20px">
                                <div class="icon"><span><img src="public/assets/images/icons/rating.png" alt=""
                                            style="width: 55px; height:55px;" class="ihw"></span></div>
                                <h4 class="bjp">Business customers</h4>
                                <div class="text ct">Multi-Delivery Made Easy: See How Our Business Customers Are Enjoying
                                    the
                                    Benefits. </div>
                                <div class="link">
                                    <a href="{{ url('readmore/businesscustomer') }}" class="readmore-link theme mds"
                                        style="background: #fff;
                                            color: #2a2a2a;
                                            border: 1px dashed black;
                                            border-radius: 20px;"><i
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
    <br><br><br><br><br><br>
    <section class="newsletter-section">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-5">
                    <h3><span class="flaticon-email"></span> Subscribe Our Newsletter <br> & Get Updates.</h3>
                </div>
                <div class="col-lg-7">
                    
                    <div class="newsletter-form">
                        <form method="post" action="{{ route('storeNewsletter') }}" id="subscription-form">
                            @csrf
                            <div class="form-group">
                                <i class="far fa-envelope-open"></i>
                                <input type="email" name="email" placeholder="Enter Your Email Address..." id="subscription-email" required>
                                <button type="submit" class="theme-btn btn-style-one subs"><span><i class="flaticon-up-arrow"></i>Subscribe</span></button>
                                <label class="subscription-label" for="subscription-email"></label>
                            </div>
                        </form>
                    </div>
                    
                    <div id="success-message" style="display: none;" class="cri">Subscription successful!</div>
                    
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const subscriptionForm = document.getElementById('subscription-form');
                            const successMessage = document.getElementById('success-message');
                    
                            subscriptionForm.addEventListener('submit', function(event) {
                                event.preventDefault(); // Prevent the default form submission
                    
                                // Display the success message
                                successMessage.style.display = 'block';
                    
                                // Automatically hide the success message after 2 seconds
                                setTimeout(function() {
                                    successMessage.style.display = 'none';
                                }, 2000); // 2000 milliseconds (2 seconds)
                    
                                // Submit the form after displaying the message
                                setTimeout(function() {
                                    subscriptionForm.submit();
                                }, 2000); // 2000 milliseconds (2 seconds)
                            });
                        });
                    </script>
                    



                </div>
            </div>
        </div>
    </section>
@endsection