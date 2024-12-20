@extends('layouts/homemaster')
@section('content')
<style>
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
    @media (max-width: 480px) {
        .picpic{
        background-size:100% 200px !important;
        margin-top: -119px !important;
        margin-bottom: -199px !important;
        background-color: #f6f7fd !important;
    }
    .svs{
        font-size:20px !important;
    }
    .nosc{
        font-size:30px !important;
    }
    
    }
</style>
<!-- Page Title -->
<section class="page-title picpic" style="background-image: url('public/assets/images/servicebaner.jpeg');">
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
    <div class="background-text">
        <div data-parallax='{"x": 100}'>
            <div class="text-1"></div>
            <div class="text-2"></div>
        </div>
    </div>
    <div class="auto-container">
        <div class="content-box">
            <div class="content-wrapper">
                <div class="title">
                    <h1 class="svs">Services</h1>
                </div>
                <!-- <ul class="bread-crumb clearfix">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#">Pages</a></li>
                    <li>Pricing Plan</li>
                </ul> -->
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section">
    <div class="auto-container">
        <div class="sec-title text-center">
            <div class="sub-title">Three Paths to Success</div>
            <h2 class="nosc">Navigate Our Service Categories</h2>
        </div>
        <div class="row">
            <div class="col-lg-4 service-block-one">
                <div class="inner-box wow  zoomIn hoverclass" data-wow-duration="1500ms" style="padding-bottom: 26px !important;">
                    <h4>Buy & Delivery</h4>
                    <div class=" text">Let us shop for you! Our buy and delivery service saves you time and hassle....
                    </div>
                    <a href="{{url('readmore/buyanddelivery')}}" class="readmore-link" style="color:white"><i class="flaticon-up-arrow" style="color:white"></i>More Details</a>
                    <div class="count"><span>01</span></div>
                    <div class="image" data-parallax='{"y": 30}'><img src="{{url('public/assets/images/images1.png')}}" style="max-width: 210px !important;" alt=""></div>

                </div>
            </div>
            <div class="col-lg-4 service-block-one">
                <div class="inner-box wow   zoomIn hoverclass" data-wow-duration="1700ms" style="padding-bottom: 26px !important;">
                    <h4>Bike taxi</h4>
                    <div class="text">Zip through traffic and arrive on time with our efficient and convenient bike taxi
                        service...
                    </div>
                    <a href="{{url('readmore/biketaxi')}}" class="readmore-link" style="color:white"><i class="flaticon-up-arrow" style="color:white"></i>More Details</a>
                    <div class="count"><span>02</span></div>
                    <div class="image" data-parallax='{"y": 30}'><img src="{{url('public/assets/images/images2.png')}}" style="max-width: 210px !important;" alt=""></div>
                </div>
            </div>
            <div class="col-lg-4 service-block-one">
                <div class="inner-box wow   zoomIn hoverclass" data-wow-duration="1900ms">
                    <h4>A - Z delivery</h4>
                    <div class="text">A-to-Z delivery on two wheels - our fast and reliable delivery service gets your
                        items where they need to go, within the city
                    </div>
                    <a href="{{url('readmore/atozdelivery')}}" class="readmore-link" style="color:white"><i class="flaticon-up-arrow" style="color:white"></i>More Details</a>
                    <div class="count"><span>03</span></div>
                    <div class="image" data-parallax='{"y": 30}'><img src="{{url('public/assets/images/images3.png')}}" style="max-width: 210px !important;" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    @media only screen and (min-width: 320px) {

        .car,
        .car1,
        .weel {
            display: block !important;
        }
    }
</style>

<!-- Pricing Section -->
<!-- <section class="pricing-section">
    <div class="auto-container">
        <div class="sec-title text-center">
            <div class="sub-title text-center">Pricing & Plans</div>
            <h2>Our Effective and Affordable <br> Pricing Plans</h2>
        </div>
        <div class="row m-0">
            <div class="col-lg-4 col-md-6 pricing-block">
                <div class="inner-box wow fadeInUp" data-wow-duration="1500ms">
                    <div class="category-wrapper">
                        <div class="category">Basic Plan</div>
                    </div>
                    <div class="price">$89.99</div>
                    <div class="time">Per Month</div>
                    <ul class="content">
                        <li>1 Warehouse </li>
                        <li>Custom Business Rules</li>
                        <li>Real Time Rate Shopping</li>
                        <li>100% Insurance</li>
                        <li>50 Freight Shipments</li>
                    </ul>
                    <div class="link-box">
                        <a href="#" class="theme-btn btn-style-one"><span><i class="flaticon-up-arrow"></i>Buy Now
                            </span></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pricing-block style-two">
                <div class="inner-box wow fadeInUp" data-wow-duration="1500ms"
                    style="background-image: url(assets/images/resource/image-3.jpg);">
                    <div class="category-wrapper">
                        <div class="category">Standard Plan</div>
                    </div>
                    <div class="price">$129.99</div>
                    <div class="time">Per Month</div>
                    <ul class="content">
                        <li>1 Warehouse </li>
                        <li>Custom Business Rules</li>
                        <li>Real Time Rate Shopping</li>
                        <li>100% Insurance</li>
                        <li>50 Freight Shipments</li>
                    </ul>
                    <div class="link-box">
                        <a href="#" class="theme-btn btn-style-one"><span><i class="flaticon-up-arrow"></i>Buy Now
                            </span></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pricing-block">
                <div class="inner-box wow fadeInUp" data-wow-duration="1500ms">
                    <div class="category-wrapper">
                        <div class="category">Advanced Plan</div>
                    </div>
                    <div class="price">$149.99</div>
                    <div class="time">Per Month</div>
                    <ul class="content">
                        <li>1 Warehouse </li>
                        <li>Custom Business Rules</li>
                        <li>Real Time Rate Shopping</li>
                        <li>100% Insurance</li>
                        <li>50 Freight Shipments</li>
                    </ul>
                    <div class="link-box">
                        <a href="#" class="theme-btn btn-style-one"><span><i class="flaticon-up-arrow"></i>Buy Now
                            </span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
@endsection