@extends('layouts/homemaster')
@section('content')
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<style>
    .fadeInRight {
        animation-name: fadeInRight;
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

    .sec1 {
        opacity: 0;
        filter: blur(5px);
        transition: all 1s;
        transform: translateX(-100%);
    }

    .show {
        opacity: 1;
        filter: blur(0);
        transform: translateX(0);

    }


    .animate-on-scroll {
        opacity: 0;
        transform: translateX(-50px);
        /* Start off-screen to the left */
        transition: opacity 1s, transform 1s;
    }

    .animate-on-scroll.animate {
        opacity: 1;
        transform: translateX(0);
        /* Move to its original position */
    }
    @media (max-width: 480px) {
    .biki{
        margin-top:-35px !important;
    }
    .smvbike{
        width:300px !important;
        height:300px !important;
    }
    .picpic{
        background-size:100% 200px !important;
        margin-top: -119px !important;
        margin-bottom: -192px !important;
    }
    .abtus{
        font-size:20px !important;
    }
    .prs{
        font-size:30px !important;
        margin-top: 10px !important;
    }
    }
</style>

<!-- Page Title -->
<section class="page-title picpic" style="background-image: url({{url('public/assets/images/about.jpeg')}});">
    <div class="background-text">
        <div data-parallax='{"x": 100}'>
            <div class="text-1"></div>
            <div class="text-2"></div>
        </div>
    </div>
    <div class="auto-container">
        <div class="content-box">
            <div class="content-wrapper">
                <div class="title mb-5">
                    <h1 class="abtus">About Us</h1>
                </div>

            </div>
        </div>
    </div>
</section>
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

<!-- Who we are -->
<section class="who-we-are-section">
    <div class="top-content">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-6">
                    <br><br>
                    <div class="sec-title mb-30">
                        <div class="sub-titlee" style="font-size: 27px; font-weight:600;">Company</div><br>
                        <h2 class="prs">Provide a <br> Reliable Services <br> Since 2018</h2>
                    </div>
                    <div class="experience-year">
                        <div class="icon"><i class="flaticon-package-1"></i></div>
                        <div class="content">
                            <h3><?php echo date('Y') - 2018; ?> <span>+ Years</span></h3>
                            <h5>Experience in Service</h5>
                        </div>

                    </div>
                    <!-- <div class="link mb-30"><a href="history.html" class="theme-btn btn-style-one"><span><i
                                    class="flaticon-up-arrow"></i>Our History</span></a></div> -->
                </div>
                <div class="col-lg-6">
                    <div class="image mb-30 animate-once">
                        <img src="{{url('public/assets/images/servicee.png')}}" class="animate-on-scroll" style="height: 70%; width: 80%;" alt="">
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        var $image = $('.animate-once');

                        $(window).scroll(function() {
                            var windowScroll = $(this).scrollTop();
                            var colPosition = $('.col-lg-6').offset().top - $(window).height();

                            // Check if the user has scrolled to the col-6
                            if (windowScroll > colPosition) {
                                $image.addClass('animate');
                            }
                        });
                    });
                </script>

            </div>
        </div>
    </div>
    <div class="overview">
        <div class="auto-container">
            <div class="wrapper-box">
                <h2>About Our Company</h2>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="text " style="text-align:start ;text-align: justify;text-justify: inter-word;">
                            <p>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;At do N key, we are
                                passionate about providing efficient and reliable bike taxi and
                                delivery services to our clients. Our company was established in 2018 and since then, we
                                have been dedicated to delivering top-notch services to our clients. We have a
                                successful delivery rating, which is a testament to our commitment to excellence.
                            </p>
                            <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                In order to expand our business and reach more customers, we recently rebranded our
                                company from do N key Deliveries to do N key Deliveries. With a new brand name of do N key, we
                                launched a new mobile app that enables us to offer our services in multiple cities. Our
                                app is user-friendly and allows our customers to book bike taxis and delivery services
                                with ease.
                            </p>

                        </div>
                        <!-- <div class="author-info wow fadeInUp" data-wow-duration="1500ms">
                            <div class="video-btn">
                                <a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s"
                                    class="overlay-link lightbox-image video-fancybox"><i
                                        class="flaticon-play-arrow"></i></a>
                            </div>
                            <div class="signature"><img src="{{url('public/assets/images/resource/sign.png')}}" alt="">
                            </div>
                            <div>
                                <div class="author-title">Roman Primera </div>
                                <div class="designation">CEO & Founder of Transida</div>
                            </div>
                        </div> -->
                    </div>

                    <div class="col-lg-6">
                        <div class="row m-10 mb-5">
                            <img class="biki" src="{{url('public/assets/images/rider.png')}}" style="height: 40%; width:100%; margin-top: -135px;" alt="" class="wow fadeInRight animate-on-scroll">
                        </div>
                    </div>
                    <script>
                        new WOW().init();
                    </script>

                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row m-10">
                            <!--Column-->
                            <img src="{{url('public/assets/images/bd.jpeg')}}" style="width: 100%;" alt="" class="animate-on-scroll">

                            <!-- <div class="col-md car1">
                                <div class="weel weel11"></div>
                                <div class="weel weel21"></div>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text " style="text-align:start ;text-align: justify;text-justify: inter-word; margin-top:85px;">
                            <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                We pride ourselves on our ability to provide a personalized service to each of our
                                clients. Our team of experienced riders is committed to delivering your parcels on time
                                and ensuring that you arrive at your destination safely and comfortably. We understand
                                the importance of reliability and efficiency, and this is what we strive to offer to our
                                clients every day.

                                Whether you need to run errands, deliver a package, or simply need a ride, we are here
                                to serve you. Our commitment to customer satisfaction is what sets us apart from the
                                rest. Trust do N Key to handle all your bike taxi and delivery needs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<!-- Statement -->
<section class="statement-section pt-0">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-6">
                <div class="image">
                    <img class="smvbike" src="{{url('public/assets/images/vission.png')}}" alt="" data-aos="fade-in" style="width:600px; height:600px;" class="animate-on-scroll">
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const images = document.querySelectorAll('.animate-on-scroll');

                    const observer = new IntersectionObserver(entries => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('animate');
                            }
                        });
                    });

                    images.forEach(image => {
                        observer.observe(image);
                    });
                });
            </script>
            <div class="col-lg-6">
                <div class="content" style="border-radius:20px">
                    <!-- <div class="badge"><img src="{{url('public/assets/images/resource/badge-3.png')}}" alt=""></div> -->
                    <!-- Tab panes -->
                    <div class="tab-content wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1200ms">
                        <div class="tab-pane fadeInUp animated active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                            <div class="text-block">
                                <div class="sec-title mb-30">
                                    <!-- <div class="sub-title">Statements</div> -->
                                    <h2>Statement Of Mission</h2>
                                </div>
                                <div class="text">Our mission is to provide high-quality service to our customers, no
                                    matter where they are located in India. We believe that our dedication to hard work
                                    and transparent communication with our customers has enabled us to expand our
                                    business from a small town to a nationwide service. </div>
                            </div>
                        </div>
                        <div class="tab-pane fadeInUp animated" id="tab-two" role="tabpanel" aria-labelledby="tab-two">
                            <div class="text-block">
                                <div class="sec-title mb-30">
                                    <!-- <div class="sub-title">Statements</div> -->
                                    <h2>Statement Of Vision</h2>
                                </div>
                                <div class="text">Our vision is to become the leading delivery business in the country,
                                    providing top-notch services to all our customers. As a small team, we have already
                                    achieved success in our small town, and now we are expanding our business to include
                                    many more prime business partners from all over the country who share our enthusiasm
                                    for business.
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fadeInUp animated" id="tab-three" role="tabpanel" aria-labelledby="tab-three">
                            <div class="text-block">
                                <div class="sec-title mb-30">
                                    <!-- <div class="sub-title">Statements</div> -->
                                    <h2>Statement Of Value</h2>
                                </div>
                                <div class="text">As a bike taxi and delivery-based company, we provide a fast and
                                    eco-friendly transportation solution for our customers, while also offering reliable
                                    and efficient delivery services.
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs tab-btn-style-one" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-one-area" data-toggle="tab" href="#tab-one" role="tab" aria-controls="tab-one" aria-selected="true">
                                <h4><i class="flaticon-up-arrow"></i>Mission</h4>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-two-area" data-toggle="tab" href="#tab-two" role="tab" aria-controls="tab-two" aria-selected="false">
                                <h4><i class="flaticon-up-arrow"></i>Vision</h4>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-three-area" data-toggle="tab" href="#tab-three" role="tab" aria-controls="tab-three" aria-selected="false">
                                <h4><i class="flaticon-up-arrow"></i>Value</h4>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Whychooseus section four -->
<section class="whychooseus-section-four" style="background-image: url(public/assets/images/wc.png);">
    <div class="auto-container">
        <div class="sec-title light text-center">
            <div class="sub-title text-white">Why Choose Us</div>
            <h2> Why to Choose Our <br> Services</h2>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 whychooseus-block-four">
                <div class="inner-box wow fadeInUp animated" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-name: fadeInUp;">
                    <div class="icon"><span class="flaticon-shield"></span><i class="fas fa-check"></i></div>
                    <h4>Trasparent Pricing</h4>
                    <!-- <div class="text">Indignation dislike men who -->
                    <!-- so beguiled all demoralized by the charms.</div> -->
                    <div class="count">01</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 whychooseus-block-four">
                <div class="inner-box wow fadeInUp animated" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-name: fadeInUp;">
                    <div class="icon"><span class="flaticon-delivery"></span><i class="fas fa-check"></i></div>
                    <h4>On - Time Delivery</h4>
                    <!-- <div class="text">Foresee the pain & trouble that are bound ensue equal belongs to fail duty.</div> -->
                    <div class="count">02</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 whychooseus-block-four">
                <div class="inner-box wow fadeInUp animated" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-name: fadeInUp;">
                    <div class="icon"><span class="flaticon-box"></span><i class="fas fa-check"></i></div>
                    <h4>Real Time Tracking</h4>
                    <!-- <div class="text">Indignation dislike men who -->
                    <!-- so beguiled all demoralized by the charms. -->
                    <!-- </div> -->
                    <div class="count">03</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 whychooseus-block-four">
                <div class="inner-box wow fadeInUp animated" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-name: fadeInUp;">
                    <div class="icon"><span class="flaticon-24-hours"></span><i class="fas fa-check"></i></div>
                    <h4>24/7 Online Support</h4>
                    <!-- <div class="text">Foresee the pain & trouble that are bound ensue equal belongs to fail duty.</div> -->
                    <div class="count">04</div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>
@endsection