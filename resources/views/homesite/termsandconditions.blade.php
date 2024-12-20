<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from st.ourhtmldemo.com/new/Transida2/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Feb 2023 11:49:26 GMT -->

<head>
    <meta charset="utf-8">
    <title>{{ $site_details[0]->sitename }}</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add these links in the <head> section of your HTML document -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap">


    <link href="{{ url('public/assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rvCmN5lLPWk9ZFBq8v8VzL4pF6Eu/jl5F5n5n5n5n5n5n5n5n5n5n5n5n5n5n5n5n5n5" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/js/bootstrap.min.js"
        integrity="sha384-Rn538y5F5EC5CyTCWT5/Cs5eHV8l5X6w5V5X6w5X6w5X6w5V5X6w5X6w5X6w5V5X6w5" crossorigin="anonymous">
    </script>

    <link href="{{ url('public/assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

    <!-- Responsive File -->
    <link href="{{ url('public/assets/css/responsive.css') }}" rel="stylesheet">
    <!-- Color File -->
    <link href="{{ url('public/assets/css/color.css') }}" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&amp;family=Yantramanav:wght@300;400;500;700;900&amp;display=swap"
        rel="stylesheet">

    <link rel="shortcut icon" href="{{ url('public/assets/images/fav.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ url('public/assets/images/fav.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <style>
   @media (max-width: 480px){
    
        .headdd{
    /* margin-top:-96px  !important; */
    font-size: 25px !important;
}
.inner-container{
            margin-right: 0px !important;
        }
.sii{
    margin-left:95px !important;
    /* margin-top:70px !important; */
    /* width:150px !important; */
}
.bi{
    margin-bottom: 1px !important;
}

.ing{
    font-size: 17px !important;

}
.ani{
    width:50px !important;
    height:50px !important;
}
.gra{
    font-size: 13px !important;
    display:inline-flex !important;
}
.mal{
    margin-top:-40px !important;
}
.nene{
    margin-top:60px !important;
    margin-left:-51px !important;
}
.gree{
    width:300px !important;
    height:200px !important;
}
.kick{
    width:250px !important;
    height: 300px !important;
    margin-left: -25px !important;
}
.lin{
    font-size: 12px !important;
}
.buil{
    color: #5C5C5C !important;
    margin-left: -18px !important;
    font-size: 35px !important;
    font-style: bold !important;
    font-weight: 700 !important;
}
.buill{
    color: #5C5C5C !important;
    margin-left: -18px !important;
    font-size: 35px !important;
    font-style: bold !important;
    font-weight: 700 !important;
    margin-top:-15px !important;
}

.pa{
    margin-left:-20px !important;

}
.ca{
    width:312px !important;
    margin-left: -44px !important;

}
.any{
    display:inline-flex !important;
    font-size: 15px !important;
    width:300px !important
}
.anyy{
    margin-right:50px !important;
  
}
.anyyy{
    width:300px !important;
    display:inline-flex !important;
    font-size: 15px !important;


}
.anyyy{
    display:inline-flex !important;
    font-size: 15px !important;
}
.es{
    width:85px !important;
    height:85px !important;
}
.hh{
    font-size:15px !important;
}
.wynts{
    margin-left: -1px !important;
}
.ess{
    margin-left: -1px !important;

}
.lili{
    margin-bottom:15px !important;
    margin-top:5px !important;
    margin-left:-52px !important;
    font-size:15px !important;
}
.liliss{
    font-size:15px !important;
}
.lilil{
    margin-bottom:15px !important;
}
.lilili{
    line-height: 1.5 !important;
}
.rd{
    margin-top:40px !important;
    margin-left:20px !important;
    width:300px !important;
    height:1100px !important;
}
.coll{
    margin-right:90px !important;
}
.it{
    width: 200px !important;
    margin-bottom:10px !important;
}
.pty{
    display: inline-flex;
    width: 200px;
    text-align: justify;
}
.nonn{
    margin-left:-47px !important;
     margin-top:32px !important; 
}
 .nonnn{
    margin-left:0px !important;
    /* margin-top:-20px !important; */

} 
.sta{
    margin-top:40px !important;
}
.ic{
    margin-left:280px !important;
}
.ml{
    margin-left:30px !important;
}
.em{
    margin-left:110px !important;
}
.slic{
    margin-top:10px !important;
    width:350px !important;
    margin-left:-40px !important;
}
.ridr{
        margin-top:-70px !important;
    }
    .gplay{
        margin-top:20px !important;
        margin-bottom: 30px !important;

    }
    .picpic{
        background-size:100% 200px !important;
        margin-top: -136px !important;
        margin-bottom: -219px !important;
        background-color: white !important; 
    }
    .abtus{
        font-size:20px !important;
    }
    .dodo{
        width:180px !important;
        margin-left:10px !important;
    }

    }
   




        /* Initialize AOS animations */
        /* Style for the custom card */
        .custom-card {
            width: 800px;
            /* Adjust the width as needed */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Medium shadow */
            transition: transform 0.2s;
            /* Add smooth transition for zoom effect */
            margin: 0 auto;
            /* Center the card horizontally */
            background-color: #d3ff53;
            /* Card background color */
        }

        /* Hover effect to slightly zoom the card */
        .custom-card:hover {
            transform: scale(1.05);
            /* Slightly zoom on hover */
        }

        /* Style for card content */
        .card-content {
            padding: 20px;
            font-family: Verdana, Geneva, Tahoma, sans-serif cursive;
            font-weight: 800px;
        }

        /* Initialize AOS animations */
        [data-aos] {
            opacity: 0;
            transition-duration: 7s;
        }


        .owl-prev,
        .owl-next {
            display: none;
        }

        /* Mobile responsive */
        @media screen and (max-width: 768px) {

            .left-column,
            .right-column {
                width: 100%;
                text-align: left;
            }
        }

        h2 {
            margin-bottom: 25px;
            position: relative;
            display: inline-block;
        }

        h2::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -0.05em;
            /* Adjust this value to match your desired thickness */
            width: 100%;
            height: 0.1em;
            /* Adjust this value to match your desired thickness */
            background-color: transparent;
            transition: all 0.3s ease;
        }

        h2:hover::after {
            background-color: #d3ff53;
            height: 0.1em;
            /* Adjust this value to match your desired thickness */
            font-weight: bold;
        }


        .para {
            display: inline;
            margin-left: 10px;
        }

        .support__item {
            font-size: 20px;
            line-height: 30px;
            font-weight: 500;
            padding: 0 0 30px 40px;
            color: #182438;
            background: url(https://img.icons8.com/?size=1x&id=mej9MOJovqMH&format=png) no-repeat;
            background-size: 20px 20px;
            background-position: left 5px;

        }

        .card {
            width: 1200px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Adjust the shadow properties as needed */
            border-radius: 8px;
            /* Add rounded corners to the card */
            transition: transform 0.2s ease;
            /* Add a smooth hover effect */
        }

        .card:hover {
            transform: translateY(-5px);
            /* Lift the card slightly on hover */
        }

        .card-title {
            margin: 0;
        }

        .custom-green-button {

            background-color: #d3ff53;
            color: black;
            margin-left: 505px;
            margin-top: 20px;

        }


        .custom-green-button:hover {
            background-color: black;
            color: white;

        }

        label {
            font-weight: 600;
        }

        .custom-hover:hover {
            border: 1px solid #d3ff53;
            /* Add a blue border */
            box-shadow: 0 0 5px rgba(0, 0, 255, 0.5);
            /* Add a blue box shadow with a blur effect */
        }

        img {
            max-width: 100%;
            vertical-align: middle;
            border: 0;
        }

        @media (max-width: 760px) {
            .open_img {
                width: 60px;
                height: 60px;
                float: left;
            }
        }

        @media (max-width: 1024px) {
            .open_img {
                width: 100px;
                height: 100px;
                position: relative;
            }
        }

        @media (max-width: 1280px) {
            .open_img {
                width: 100px;
                height: 100px;

            }
        }

        @media (max-width: 1600px) {
            .open_img {
                width: 130px;
                height: 130px;

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

        .zoom-on-hover {
            transition: transform 0.3s ease;
        }

        .zoom-on-hover:hover {
            transform: scale(1.05);
            /* Zoom in slightly on hover */
        }

        .animated-text {
            opacity: 0;
            animation: fadeInText 2s ease-in-out forwards;
        }

        @keyframes fadeInText {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }



        .fade-in-on-scroll {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }
        .support__resume-text {
    color: #182438;
    font-size: 20px;
    line-height: 30px;
    padding-top: 20px;
    max-width: 560px;
        }
   .scroll{
    overflow:hidden;
   }
  

    </style>
    <style>
        .copyright-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.flag-india {
    display: flex;
    align-items: center;
    gap: 5px; /* Adjust the gap as needed */
}

        /* @media only screen and(max-width:320px){
            .myhiddennav{
                display:block;
            }
        }
        */
        /*
        @media only screen and (max-width:1440px){

            .myhiddennav1{
                display:none !important;
            }
        }
        @media only screen and (max-width:1440px){

 .myhiddennav1{
     display:none !important;
 }
} */
        /* @media only screen and (max-width:1240px){

 .myhiddennav1{
     display:none !important;
 }
}
@media only screen and (max-width:768px){

 .myhiddennav1{
     display:none !important;
 }
}
@media only screen and (max-width:320px){

 .myhiddennav1{
     display:none !important;
 }
} */
         html,
    body {
        scroll-behavior: smooth;
    } 
    </style>
    <style>
        a {
            text-decoration: none !important;
        }

       

        /*!
 * three-dots - v0.3.2
 * CSS loading animations made with single element
 * https://nzbin.github.io/three-dots/
 *
 * Copyright (c) 2018 nzbin
 * Released under MIT License
 */
        @charset "UTF-8";

        /**
 * ==============================================
 * Dot Elastic
 * ==============================================
 */
    </style>
    <style>
        /* Add this CSS for mobile responsiveness */
        /* Add this CSS for mobile responsiveness */
        @media (max-width: 746px) {
            .pb{
                /* float: left; */
                margin-left:250px !important;
            }
        }
        @media (max-width: 320px) {
            .pb{
                /* float: left; */
                margin-left:250px !important;
            }
            .row {
                flex-direction: column;
                display: flex;
            }

            .widget {
                text-align: center;
                margin-bottom: 20px;
                width: 100%;
            }

            .widget.contact-widget {
                text-align: center;
                width: 100%;
            }

            .icon-box {
                display: flex;
                align-items: center;
                width: 100%;
            }

            .icon-box .icon {
                width: 100%;
                margin-right: 10px;
            }

            .social-icon {
                width: 100%;
                text-align: center;
                margin-top: 10px;
            }

            .widget.links-widget ul.list {
                width: 100%;
                margin-left: 0;
                padding-left: 0;
                list-style: none;
            }

            .widget_title {
                width: 100%;
                margin-bottom: 10px;
            }

            .widget_title:after {
                content: "";
                display: block;
                width: 20px;
                height: 2px;
                background-color: #000;
                margin-top: 5px;
                width: 100%;
            }
        }



        html,
        body {
            height: 100%;
            background: #f6f7fd;
            font-size: 16px;
        }

        .heading {
            margin: 36px 0;
            padding: 24px 32px;
            background: rgba(255, 255, 255, 0.4);
            border: 1px solid rgba(0, 32, 128, 0.12);
            border-radius: 16px;
            font-size: 18px;
        }
        .has-search{
            margin-left:-20px;
        }

        .snippet {
            position: relative;
            background: #fff;
            padding: 32px 5%;
            margin: 24px 0;
            box-shadow: 0 4px 12px -2px rgba(0, 32, 128, .1), 0 0 0 1px rgba(60, 80, 120, 0.1);
            border-radius: 16px;
        }

        .snippet::before {
            display: inline-block;
            position: absolute;
            top: 6px;
            left: 6px;
            padding: 0 8px;
            content: attr(data-title);
            font-size: 12px;
            font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            color: white;
            background-color: rgb(255, 25, 100);
            border-radius: 10px;
            line-height: 20px;
        }

        .snippet:hover {
            cursor: pointer;
            outline: 2px solid rgb(255, 25, 100);
        }
        .stage {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            padding: 32px 0;
            margin: 0 -5%;
            overflow: hidden;
        }

        .filter-contrast {
            filter: contrast(5);
            background-color: white;
        }

        .footer {
            margin: 120px 0 20px;
            text-align: center;
            overflow: auto;
        }

        .tooltip::after {
            position: absolute;
            top: 100%;
            left: 50%;
            margin-top: 8px;
            padding: 6px 8px;
            border-radius: 4px;
            font-size: 12px;
            line-height: 1;
            color: white;
            background-color: rgba(97, 97, 97, .9);
            transform: translateX(-50%);
            content: attr(aria-label);
            pointer-events: none;
        }

        html {
            scroll-behavior: smooth;
        }

        /* Mobile-first styles (apply to all screen sizes) */

        /* Your existing styles for the footer can remain here */

        /* Media query for screens with a maximum width of 768px (typical mobile devices) */
        @media screen and (max-width: 768px) {
            .main-footer {
                /* Adjust the styles for the main footer container */
                padding: 20px;
                /* Add padding to provide spacing for mobile devices */
            }

            .col-2 {
                /* Adjust styles for the first column (Rider and User App) */
                width: 100%;
                /* Make it full-width on mobile devices */
                text-align: center;
                /* Center the content */
                margin-bottom: 20px;
                /* Add spacing between columns */
            }

            .col-4 {
                /* Adjust styles for the second column (Contact Us) */
                width: 100%;
                /* Make it full-width on mobile devices */
                text-align: center;
                /* Center the content */
                margin-bottom: 20px;
                /* Add spacing between columns */
            }

            .col-3 {
                /* Adjust styles for the third and fourth columns (Useful Links and Policy) */
                width: 100%;
                /* Make them full-width on mobile devices */
                text-align: center;
                /* Center the content */
                margin-bottom: 20px;
                /* Add spacing between columns */
            }

            /* You can further adjust styles as needed for specific elements within the columns */
        }

        /* Mobile-first styles (apply to all screen sizes) */

        /* Your existing styles for the footer can remain here */

        /* Media query for screens with a maximum width of 768px (typical mobile devices) */
        @media screen and (max-width: 768px) {
            .main-footer .row {
                flex-direction: column;
                /* Stack columns vertically on mobile */
            }

            .col-2,
            .col-4,
            .col-3 {
                width: 100%;
                /* Make all columns full-width on mobile devices */
                text-align: center;
                /* Center the content */
                margin-bottom: 20px;
                /* Add spacing between columns */
            }
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Reset default list styles */
        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Semi-transparent background */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .dots {
            display: flex;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Semi-transparent background */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .dot {
            width: 10px;
            height: 10px;
            margin: 0 5px;
            background-color: #d3ff53;
            border-radius: 50%;
            animation: loading 1.8s infinite ease-in-out;

        }

        @keyframes loading {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.5);
            }
        }

        .contentt {
            display: none;
            /* Initially hide the content */
            /* Add your content styles here */
        }
        /* Style for the scroll-to-top button */


    </style>
    <style>
        @media (max-width: 480px) {
        
            .picpic{
        background-size:100% 200px !important;
        margin-top: -119px !important;
        margin-bottom: -219px !important;
        background-color: #f6f7fd !important;
    }
    .abtus{
        font-size:20px !important;
    }
    .tac{
        margin-top:20px !important;
        margin-left:30px !important;
        font-size:24px !important;

    }
    .tacard{
        width:350px !important;
        margin-left:-9px !important;
    }
    .disblo{
            display:block !important;
        }
        }

</style>







</head>

<body class="js-scroll" id="scroll-container">

    <div class="page-wrapper">
        <!-- Preloader -->

    </div>







    <div class="dots">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Simulate a 1.2-second loading time (adjust as needed)
            setTimeout(function() {
                // Hide the preloader
                document.querySelector(".dots").style.display = "none";

                // Display the content
                document.querySelector(".content").style.display = "block";

                // Remove the blur effect
                document.body.style.overflow = "auto";
            }, 1200);
        });
    </script>
    <!-- Main Header -->

    <header class="main-header header-style-one">

        <!-- Header Top -->
        <div class="header-top">
            <div class="auto-container">
                <div class="inner-container" style="margin-right:-38px;">
                    <div class="left-column">
                        <ul class="social-icon ">
                            <li><a href="{{ url('/') }}"><img src="{{ url('public/assets/images/do.png') }}" class="dodo"
                                        style="width: 180px; margin-left:-40px;" ></a></li>
                            <!-- <li class="right-column  myhiddennav  myhiddennav2"><a href="https://www.facebook.com/donkeydeliveries/"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="right-column myhiddennav myhiddennav2"><a href="https://twitter.com/doNkeyDeliverys?t=CcXdqICxVYHRRnr1pE-zug&s=08"><i class="fab fa-twitter"></i></a></li>
                                <li class="right-column myhiddennav myhiddennav2"><a href="#"><i-->
                            <!--            class="fab fa-google-plus-g"></i></a></li>-->
                            <!-- <li class="right-column myhiddennav myhiddennav2"><a href="https://instagram.com/do_n_key_deliveries?igshid=NTc4MTIwNjQ2YQ=="><i class="fab fa-instagram"></i></a></l
                                <li class="right-column myhiddennav myhiddennav2"><a href="#"><i-->
                            <!--            class="fab fa-youtube"></i></a></li>-->
                        </ul>
                        <div class="right-column header-upper myhiddennav1 myhiddennav  ">
                            <!--Nav Box-->
                            <div class="nav-outer  ">
                                <!--Mobile Navigation Toggler-->
                                <div class="mobile-nav-toggler"><img
                                        src="{{ url('public/assets/images/icons/icon-bar.png') }}" alt="" style="margin-top: -147px;">
                                </div>

                                <!-- Main Menu -->
                                <!-- <nav class="main-menu navbar-expand-md navbar-light">
                                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                           <div class="navigations">                                                    <form class="form-inline" id="search-form" action="your-action-url" method="post">
                                                        <div class="form-group has-search" style="font-size: 12px;">
                                                            <span class="fa fa-search form-control-feedback" id="search-icon"></span>
                                                            <input type="text" class="form-control" placeholder="Search" name="search_query">
                                                        </div>
                                                    </form>
                                                    <script>
                                                        // Add an event listener to the search icon
                                                        document.getElementById("search-icon").addEventListener("click", function() {
                                                            // Get the form element
                                                            var form = document.getElementById("search-form");

                                                            // Submit the form
                                                            form.submit();
                                                        });
                                                    </script>
                                                    </div>


                                            <ul class="navigation " style="margin-right: 70px;">
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ url('about') }}">About Us</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ url('services') }}">Services</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ url('contact') }}">Contact</a>
                                                </li>
                                            </ul>

                                        </div>
                                    </nav> -->
                                <nav class="main-menu navbar-expand-md navbar-light">
                                    <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent"
                                        style="margin-left:79px;">
                                        <!-- Search Form -->
                                        {{-- <form class="form-inline sb d-none d-md-block" action="{{ url('/') }}" method="get" style="padding-bottom: -17px;">
                                            @csrf
                                            <div class="form-group has-search" style="font-size: 12px;">
                                                <span class="fa fa-search form-control-feedback" id="search-icon"></span>
                                                <div class="input-container">
                                                    <input id="pincode-input" type="text" class="form-control" placeholder="Search Pincode" name="pincode" value="{{ request('pincode') }}"
                                                        style="background: none !important; border: none !important;"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 6) this.value = this.value.slice(0, 6);">
                                                </div>
                                            </div>
                                            @if (request('pincode') && $notification)
                                                <small id="notification" style="color: {{ $notificationColor ?? 'red' }}; padding-left:5px;">
                                                    {{ $notification }} <span id="clear-notification" style="cursor: pointer;">&times;</span>
                                                </small>
                                            @endif
                                        </form>
                                        
                                        <script>
                                            @if (request('pincode') && $notification)
                                                // Execute this JavaScript code when the clear (X) symbol in the notification is clicked
                                                document.getElementById('clear-notification').addEventListener('click', function() {
                                                    document.getElementById('pincode-input').value = ''; // Clear the input field
                                                    document.getElementById('notification').textContent = ''; // Clear the notification text
                                                });
                                            @endif
                                        </script> --}}
                                        {{-- <form class="form-inline sb d-none d-md-block" action="{{ url('/') }}" method="get" style="padding-bottom: -17px;"> --}}
                                            <form class="form-inline  d-sm-block d-md-block" action="{{ url('/') }}{{ request('pincode') ? '?pincode=' . request('pincode') : '' }}" method="get" style="padding-bottom: -17px;">

                                                @csrf
                                                <div class="form-group has-search" style="font-size: 12px;">
                                                    <span class="fa fa-search form-control-feedback" id="search-icon"></span>
                                                    <div class="input-container">
                                                        <input type="text"  id="pincode-input" class="form-control" placeholder="Search Pincode" name="pincode" value="{{ request('pincode') }}"
                                                            style="background: none !important; border: none !important;"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 6) this.value = this.value.slice(0, 6);">
                                                    </div>
                                                </div>
                                                @if (request('pincode') && $notification)
                                                    {{-- <small style="color: {{ $notificationColor ?? 'red' }}; padding-left:5px;"> {{ $notification }}</small> --}}
                                                    <small id="notification" style="color: {{ $notificationColor ?? 'red' }}; padding-left:5px;">
                                                        {{ $notification }} <span id="clear-notification" style="cursor: pointer;">&times;</span>
                                                    </small>
                                                    @endif
                                            </form>
                                        {{-- <script>
                                            @if (request('pincode') && $notification)
                                                // Execute this JavaScript code when the clear (X) symbol in the notification is clicked
                                                
                                                document.getElementById('clear-notification').addEventListener('click', function() {
                                                    document.getElementById('pincode-input').value = ''; // Clear the input field
                                                    document.getElementById('notification').textContent = ''; // Clear the notification text
                                                    document.getElementById('clear-notification-form').submit(); // Submit the form to redirect
       
                                                    
                                                });
                                            @endif
                                        </script> --}}
                                        <script>
                                            @if (request('pincode') && $notification)
                                                // Execute this JavaScript code when the clear (X) symbol in the notification is clicked
                                                document.getElementById('clear-notification').addEventListener('click', function() {
                                                    document.getElementById('pincode-input').value = ''; // Clear the input field
                                                    document.getElementById('notification').textContent = ''; // Clear the notification text
                                        
                                                    // Remove the pincode parameter from the URL
                                                    const urlWithoutPincode = window.location.href.split('?')[0];
                                                    window.location.reload();
                                                    
                                                    // Update the URL without the pincode parameter
                                                    window.history.replaceState(null, null, urlWithoutPincode);
                                                });
                                            @endif
                                        </script>
                                        
                                        
                                        
                                        
                                        
                                        
                                        

                                        <!-- Navigation Links -->
                                        <ul class="navigation"
                                            style="margin-right: 70px; margin-left:22px; font-size: 12px;">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url('/') }}">Home</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url('about') }}">About Us</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url('services') }}">Services</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url('contact') }}">Contact</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url('pbp') }}">PBP</a>
                                            </li>

                                        </ul>
                                    </div>
                                </nav>

                            </div>
                            <!-- <div class="navbar-right-info ">

                                    <div class="sign-in "><a href="{{ url('login') }}"><i
                                                class="flaticon-delivery-man"></i>Sign In</a></div>

                                </div> -->
                        </div>
                    </div>
                    <div class="right-column myhiddennav  ">
                        <nav class="main-menu navbar-expand-md navbar-light a1">
                            <div class="collapse navbar-collapse show clearfix " id="navbarSupportedContent">

                                <ul class="navigation ">

                                    <li class=""><a href="{{ url('/') }}">Home</a>
                                        <!-- <ul>
                                                <li><a href="index.html">Home Page 01</a></li>
                                                <li><a href="index-2.html">Home Page 02</a></li>
                                                <li><a href="index-3.html">Home Page 03</a></li>
                                                <li><a href="index-4.html">Home Page 04</a></li>
                                                <li><a href="onepage.html">Onepage</a></li>
                                            </ul> -->
                                    </li>
                                    <li class="dropdown "><a href="{{ url('about') }}">About Us</a>
                                        <!-- <ul>
                                                <li><a href="{{ url('about') }}">About Company</a></li>
                                                <li><a href="{{ url('history') }}">History</a></li>
                                                <li><a href="{{ url('leader') }}">Leadership Team</a></li>
                                                <li><a href="{{ url('global') }}">Global Networks</a></li>
                                            </ul> -->
                                    </li>
                                    <li class="dropdown "><a href="{{ url('services') }}">Services</a>
                                        <!-- <ul>
                                                <li><a href="{{ url('services') }}">Services</a></li>
                                                <li><a href="{{ url('about') }}"> Air Freight </a></li>
                                                <li><a href="{{ url('about') }}">Ocean Freight </a></li>
                                                <li><a href="{{ url('about') }}">Road Freight </a></li>
                                                <li><a href="{{ url('about') }}">Train Freight </a></li>
                                                <li><a href="{{ url('about') }}">Warehousing </a></li>
                                                <li><a href="{{ url('about') }}">Packaging</a></li>
                                            </ul> -->
                                    </li>
                                    
                                    <li><a href="{{ url('contact') }}">Contact</a></li>
                                    <li>
                                        <a href="tel:{{ $site_details[0]->phone }}"  style="display:inline-flex; width:116px;">
                                            <i class="flaticon-calling"></i>

                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <div class="phone-number myhiddennav2">
                            {{-- <a href="{{url('login')}}"><i class="flaticon-delivery-man"></i>Sign In</a> --}}
                            <div class="row">
                                <div class="col">
                                    <div class="iconed" style="margin-top: 10px;  margin-right:-20px"> <i
                                            class="flaticon-calling"></i></div>
                                </div>
                                <div class="col">
                                    <a href="tel:{{ $site_details[0]->phone }}"  style="display:inline-flex; width:116px;">
                                        @php
                                            $numbers = explode('/', $site_details[0]->phone);
                                            
                                        @endphp
                                        {{ $numbers[0] }}
                                        <br>
                                        {{ $numbers[1] }}
                                        <!-- {{ $site_details[0]->phone }} --> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Upper -->
        <div class="header-upper  myhiddennav1">
            <div class="auto-container">
                <div class="inner-container">
                    <!--Logo-->
                    <div class="logo-box">
                        <div class="logo">
                            {{-- <a href="{{url('/')}}"><img src="{{url('public/assets/images/do.png')}}" --}} {{-- style="width: 180px"></a> --}} </div>
                    </div>
                    <div class="right-column ">
                        <!--Nav Box-->
                        <div class="nav-outer ">
                            <!--Mobile Navigation Toggler-->
                            <div class="mobile-nav-toggler"><img class="ic"
                                    src="{{ url('public/assets/images/icons/icon-bar.png') }}" alt="" style="margin-top: -147px;">
                            </div>

                            <!-- Main Menu -->
                            <nav class="main-menu navbar-expand-md navbar-light">
                                <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                    <ul class="navigation">
                                        <li><a href="{{ url('/') }}">Home</a>
                                            <!-- <ul>
                                                    <li><a href="index.html">Home Page 01</a></li>
                                                    <li><a href="index-2.html">Home Page 02</a></li>
                                                    <li><a href="index-3.html">Home Page 03</a></li>
                                                    <li><a href="index-4.html">Home Page 04</a></li>
                                                    <li><a href="onepage.html">Onepage</a></li>
                                                </ul> -->
                                        </li>
                                        <li class="dropdown"><a href="{{ url('about') }}">About Us</a>
                                            <!-- <ul>
                                                    <li><a href="{{ url('about') }}">About Company</a></li>
                                                    <li><a href="{{ url('history') }}">History</a></li>
                                                    <li><a href="{{ url('leader') }}">Leadership Team</a></li>
                                                    <li><a href="{{ url('global') }}">Global Networks</a></li>
                                                </ul> -->
                                        </li>
                                        <li class="dropdown"><a href="{{ url('services') }}">Services</a>
                                            <!-- <ul>
                                                    <li><a href="{{ url('services') }}">Services</a></li>
                                                    <li><a href="{{ url('about') }}"> Air Freight </a></li>
                                                    <li><a href="{{ url('about') }}">Ocean Freight </a></li>
                                                    <li><a href="{{ url('about') }}">Road Freight </a></li>
                                                    <li><a href="{{ url('about') }}">Train Freight </a></li>
                                                    <li><a href="{{ url('about') }}">Warehousing </a></li>
                                                    <li><a href="{{ url('about') }}">Packaging</a></li>
                                                </ul> -->
                                        </li>
                                        <!-- <li class="dropdown"><a href="#">Pages</a>
                                                <ul>
                                                    <li class="dropdown"><a href="#">Portfolio</a>
                                                        <ul>
                                                            <li><a href="portfolio.html">Portfolio 02 Column</a></li>
                                                            <li><a href="portfolio-2.html">Portfolio 03 Column</a></li>
                                                            <li><a href="portfolio-3.html">Portfolio 04 Column</a></li>
                                                            <li><a href="portfolio-details.html">Portfolio Details</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="404.html">404</a></li>
                                                    <li><a href="faq.html">FAQ's</a></li>
                                                    <li><a href="request-quote.html">Request a Quote</a></li>
                                                    <li><a href="pricing-plan.html">Pricig Plan</a></li>
                                                </ul>
                                            </li> -->
                                        <!-- <li class="dropdown"><a href="#">Blog</a>
                                                <ul>
                                                    <li><a href="blog.html">3 Columns Grid </a></li>
                                                    <li><a href="blog-2.html">3 Columns Sidebar</a></li>
                                                    <li><a href="blog-3.html">Large Image</a></li>
                                                    <li><a href="blog-details.html">Single Post</a></li>
                                                </ul>
                                            </li> -->
                                        <li><a href="{{ url('contact') }}">Contact</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <!-- <div class="navbar-right-info">
                                    <div class="sign-in"><a href="{{ url('login') }}"><i
                                                class="flaticon-delivery-man"></i>Sign In</a></div>

                                </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!--End Header Upper-->

        <!-- Sticky Header  -->
        <div class="sticky-header">
            <div class="header-upper">
                <div class="auto-container">
                    <div class="inner-container">
                        <!--Logo-->
                        <div class="logo-box">
                            <div class="logo"><a href="{{ url('/') }}"><img
                                        src="{{ url('public/assets/images/do.png') }}" style="width: 180px"
                                        alt=""></a></div>
                        </div>
                        <div class="right-column">
                            <!--Nav Box-->
                            <div class="nav-outer">
                                <!--Mobile Navigation Toggler-->
                                <div class="mobile-nav-toggler "><img
                                        src="{{ url('public/assets/images/icons/icon-bar.png') }}" class="pb" alt="" style="margin-top: -147px;">
                                </div>

                                <!-- Main Menu -->
                                <nav class="main-menu navbar-expand-md navbar-light">
                                </nav>
                            </div>
                            <!-- <div class="navbar-right-info">
                                        <div class="sign-in"><a href="{{ url('login') }}"><i
                                                    class="flaticon-delivery-man-1"></i>Sign In</a>
                                        </div>

                                    </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Sticky Menu -->

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon flaticon-remove"></span></div>

            <nav class="menu-box">
                <div class="nav-logo "><a href="{{ url('/') }}"><img
                            src="{{ url('public/assets/images/fav.png') }}" style="width: 100px; height:100px;" alt=""
                            title=""></a></div>
                <div class="menu-outer">
                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                </div>
                <!--Social Links-->
                <div class="social-links">
                    <ul class="clearfix">
                      
                        <li><a href="https://x.com/doNkey_Delivery?t=MNIa2Z-ja0QlsTExo4eDnQ&s=08"><span class="fab fa-twitter"></span></a></li>
                        <li><a href="https://www.facebook.com/doNkey.app.deliveries?mibextid=ZbWKwL"><span class="fab fa-facebook-square"></span></a></li>
                        <li><a href="https://instagram.com/donkey_deliveries?igshid=MzRlODBiNWFlZA=="><span class="fab fa-instagram"></span></a></li>
                        <li><a href="https://youtube.com/@doNkey_Delivery?si=VnSW6_eHtOQG5Zpg"><span class="fab fa-youtube"></span></a></li>
                    </ul>
                </div>
            </nav>
        </div><!-- End Mobile Menu -->

        <div class="nav-overlay">
            <div class="cursor"></div>
            <div class="cursor-follower"></div>
        </div>
    </header>
    <!-- End Main Header -->

    <!-- Hidden Sidebar -->
    <section class="hidden-sidebar close-sidebar">
        <div class="wrapper-box">
            <div class="content-wrapper">
                <div class="hidden-sidebar-close"><span class="flaticon-remove"></span></div>
                <div class="text-widget sidebar-widget">
                    <div class="logo"><a href="{{ url('/') }}"><img
                                src="{{ url('public/assets/images/do.png') }}" style="width: 180px" alt="">
                            <div class="text"></div>
                    </div>
                    <!-- PDF Widget -->
                    <div class="pdf-widget sidebar-widget">
                        <div class="row">
                            <div class="col-sm-6 column">
                                <div class="content">
                                    <div class="icon"><img src="{{ url('public/assets/images/icons/icon-8.png') }}"
                                            alt="">
                                    </div>
                                    <h4>Sender <br> Instructions</h4>
                                </div>
                            </div>
                            <div class="col-sm-6 column">
                                <div class="content">
                                    <div class="icon"><img src="{{ url('public/assets/images/icons/icon-8.png') }}"
                                            alt="">
                                    </div>
                                    <h4>Sender <br> Instructions</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Contact Widget -->
                    <div class="contact-widget">
                        <div class="icon-box">
                            <div class="icon"><span class="flaticon-cursor"></span></div>
                            {{-- <div class="text">Boat House, 152/21 City Road, <br> Hoxton, N1 6NG, UK.</div> --}}
                        </div>
                        <div class="icon-box">
                            <div class="icon"><span class="flaticon-calling"></span></div>
                            {{-- <div class="text"><strong>Phone</strong><a href="tel:(+61)3245689790">(+61) 324 56 789 &
                                    790</a></div> --}}
                        </div>
                        <div class="icon-box">
                            <div class="icon"><span class="flaticon-mail"></span></div>
                            
                        </div>
                    </div>
                    <!-- Link Btn -->
                    {{-- <div class="link-btn"><a href="#" class="theme-btn btn-style-one style-two"><span><i
                                    class="flaticon-up-arrow"></i>Purchase Our Theme </span></a></div> --}}
                </div>
            </div>
    </section>

    <!--Search Popup-->
    <div id="search-popup" class="search-popup">
        <div class="close-search theme-btn"><span class="flaticon-remove"></span></div>
        <div class="popup-inner">
            <div class="overlay-layer"></div>
            <div class="search-form">
                <form method="post" action="#">
                    <div class="form-group">
                        <fieldset>
                            <input type="search" class="form-control" name="search-input" value=""
                                placeholder="Search Here" required>
                            <input type="submit" value="Search Now!" class="theme-btn">
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
    </div>


<section class="page-title picpic" style="background-image: url('public/assets/images/tc.jpeg');">
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
                    <h1 class="abtus">Terms And Conditions</h1>
                </div>

            </div>
        </div>
    </div>
</section>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <p style="display:flex;font-size:30px;font-weight:600;margin-left:370px;" class="tac">
                Terms And Conditions

            </p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        </div>
       
    </div>
</div>
<style>
.headingstc {
    font-size: 20px;
    font-weight: 200;
}

.headingstcsmall {
    font-size: 16px;
    font-weight: 800;
}
</style>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            <div class="card tacard">
                <div class="card-body" style="text-align: justify">
                    <p class="headingstc">
                        TERMS AND CONDITIONS FOR USERS
                    </p>
                    <p class="headingstcsmall">
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp THIS DOCUMENT IS AN ELECTRONIC
                        RECORD IN TERMS OF INFORMATION
                        TECHNOLOGY ACT, 2000 AND RULES THEREUNDER AS APPLICABLE AND THE
                        PROVISIONS PERTAINING TO ELECTRONIC RECORDS IN VARIOUS STATUTES
                        AS AMENDED BY THE INFORMATION TECHNOLOGY ACT, 2000.
                    </p>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp do N key Deliveries (“Company”)
                    provides technology-based services for booking parcel
                    on two-wheelers (“Vehicle”) to you (“You” or “Users”) and you agree to obtain certain
                    Services (defined hereinafter) offered by third party drivers or vehicle operators
                    ("Riders") by means of the Company’s website WWW.DONKEYDELIVERIES.COM and mobile application
                    (“Platform”). All the Services provided by the Company to you would be by means of
                    your use of the Platform. These Terms of Use shall govern the relationship between you
                    (the customer) and the Company in the course of provision of the Services. These terms
                    of use (“Terms of Use”) mandate the terms on which users using the Services will be
                    governed.
                    <p></p>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    Please read the Terms of Use carefully before using the Platform or registering on the
                    Platform or accessing any material or information through the Platform.
                    Use of and access to the Platform is offered to You upon the condition of acceptance of
                    all the terms, conditions and notices contained in this Terms of Use and Privacy Policy,
                    along with any amendments made by the Company at its sole discretion and posted on
                    the Platform from time to time.
                    <p></p>
                    &nbsp&nbsp&nbsp&nbsp&nbsp <p class="headingstcsmall">
                        1. SERVICES
                    </p>
                    <p></p>
                    The Platform provides the following services (“Services”) to You:
                    <p></p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 1. It allows you to pick up and
                    drop off packages from one location to the other
                    through the Riders (“Package Services”).
                    <p></p>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 2. It allows you to buy items/products
                    from merchants of a store and get the
                    same delivered to you by the Delivery Partners ("Buy and Delivery Services")

                    <p></p>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 3. It allows you to travel from one
                    location to the other
                    through the Riders (“Bike Taxi Services”).

                    <p></p>
                    &nbsp&nbsp&nbsp&nbsp&nbsp <p class="headingstcsmall">
                        2. GENERAL TERMS OF USE
                    </p>
                    <p></p>

                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 1. You must be at least 18 years of
                    age, or the age of legal majority in your
                    jurisdiction (if different than 18 years), to obtain an account.
                    <p></p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 2. The Service is not available
                    for use by persons under the age of 18 years. You
                    shall not authorize third parties to use your account. You shall not allow persons
                    under the age of 18 years to receive transportation or logistics services from the
                    Riders.
                    <p></p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 3. If the Company becomes aware
                    or, it acquires credible knowledge that You have
                    misled us regarding your age, then the Company reserves its rights to deactivate
                    the account and You will not be liable to raise any claims including from the
                    Company.
                    <p></p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 4. The Company may monitor and
                    record calls made to the Riders, for the purpose
                    of training and improving customer care services, including complaint.
                    <p></p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 5. The Riders shall have the
                    sole
                    discretion to accept or reject each request for the
                    Service.
                    <p></p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 6. If the Riders accepts the
                    booking request made by the Company, a notification
                    will be sent you with the information regarding the Riders including its name,
                    contact number etc.
                    <p></p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 7. The Company shall make
                    reasonable efforts to bring you in contact with the
                    Riders in order to obtain the Service subject to availability of the Riders in or
                    around your location at the time of your booking request made to the Company.
                    <p></p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 8. For the avoidance of doubt,
                    it
                    is clarified that the Company itself does not provide
                    the Services. It is the Riders who shall render the Services to you.
                    <p></p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 9. Even after acceptance of
                    booking, the Riders may not reach your pick up location
                    or decide not to render his services. in which event the Company shall not be
                    held liable.
                    <p></p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 10.You warrant that the
                    information you provide to the Company is accurate and
                    complete. The Company is entitled at all times to verify the information that you
                    have provided. You may only access the Services using authorized means.
                    <p></p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 11. The Company shall not be
                    liable if you do not download the correct Platform or
                    visit the appropriate web portal.
                    <p></p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 12.You will refrain from doing
                    anything which we reasonably believe to be
                    disreputable or capable of damaging our reputation and will comply with all
                    applicable laws of the Republic of India.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 13.You will treat the Riders
                    with
                    respect and not cause damage to their Vehicle or
                    engage in any unlawful, threatening, harassing, abusive behaviour or activity
                    whilst using their Vehicle;
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 14. The Company is not
                    responsible
                    for the behaviour, actions or inactions of drivers
                    of Vehicles, Riders or quality of Vehicle which you may use. Any contract for the
                    provision of Vehicle for the Services is exclusively between you and the Riders
                    and the Company is not a party to the same.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 15.You agree that You shall not
                    request for Package Services for Items which are
                    illegal, hazardous, dangerous, or otherwise restricted or constitute Items that are
                    prohibited by any statute or law or regulation or the provisions of this Terms of
                    Use.
                    <p></p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 16.You also agree that you
                    shall
                    not request for dispatch of item(s) which require a
                    special transportation permit or require any special license under applicable law.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 17. The Company does not check
                    or
                    verify the packages that are being picked up
                    and dropped off on behalf of You or the Items that are being delivered to You by
                    the Riders, and therefore the Company shall have no liability with respect to the
                    same. However, if it comes to the knowledge of the Company that You have
                    packaged any illegal or dangerous substance or availed the Package Services
                    using the Platform to deliver any illegal or dangerous substance, the Company
                    shall have the right to report You to the government authorities and take other
                    appropriate legal actions against You.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 18.You agree that before
                    requesting
                    a Package Service, You are well aware of the
                    contents of the package sent or requested by You through registered Riders, and
                    that such contents are legal and within limits of transportation under any
                    applicable laws. Such contents shall not be restricted and/or banned and/or
                    dangerous and/or prohibited for carriage (such items include, but are not limited
                    to, radio-active, incendiary, corrosive or flammable substances, hazardous
                    chemicals, explosives, firearms or parts thereof and ammunition, firecrackers,
                    cyanides, precipitates, gold and silver ore, bullion, precious metals and stones,
                    jewellery, semi-precious stones including commercial carbons or industrial
                    diamonds, currency (paper or coin) of any nationality, securities (including stocks
                    and bonds, share certificates and blank signed share transfer forms), coupons,
                    stamps, negotiable instruments in bearer form, cashier's cheques, travellers,

                    cheques, money orders, passports, credit/debit/ATM cards, antiques, works of
                    art, lottery tickets and gambling devices, livestock, fish, insects, animals, plants
                    and plant material, human corpses, organs or body parts, blood, urine and other
                    liquid diagnostic specimens, hazardous or bio-medical waste, wet ice,
                    pornographic materials, contraband, bottled alcoholic beverages or any intoxicant
                    or narcotics and psychotropic substances or any other prohibited material or
                    material for the transportation of which specific authorisation/license is required
                    under applicable laws).
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 19.You also agree that, upon
                    becoming aware of the commission any offence by
                    You or Your intention to commit any offence upon initiating a Package Service or
                    during a Package Service of any Item(s) restricted under applicable law, the
                    Riders may report such information to Company or to the law enforcement
                    authorities.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 20.You also agree that any
                    payment
                    for the products/goods ordered by you in
                    respect of the Delivery Services shall be at your own risk and the payment shall
                    be settled directly between you and the Riders. Company does not assume any
                    responsibility or liability whatsoever for any damage/deficiency or loss of the
                    products/goods. The Delivery Services are provided to You directly by the Riders
                    and do N key Deliveries merely acts as a technology platform to facilitate delivery
                    initiated on the Platform and do N key Deliveries does not assume any responsibility or
                    liability for any form of deficiency of services on part of the Riders.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 21.You agree that you will be
                    solely responsible for the packages handed over to the
                    Riders and shall be prudent not to handover expensive items to the Riders. You
                    will be solely responsible for any loss or damage to the goods, in case of any
                    theft or any other incidents to the packages by the Riders.
                    <p></p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 22.You can initiate a
                    transaction
                    on the Platform by which You may (through the
                    help of a Riders) send packages at a particular location. The Package Services
                    are provided to You directly by the Riders and do N key Deliveries merely acts as a
                    technology platform to facilitate transactions initiated on the Platform and do N key Deliveries does not assume any responsibility or liability for any form of deficiency of
                    services on part of the Riders.

                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 23.By using the Platform of the
                    Company, you further agree that:
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    1. You will not authorize others to use your account;
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 2. You will
                    not
                    assign or otherwise transfer your account to any other person
                    or legal entity;
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 3. You will
                    not
                    use the Website and mobile application for unlawful purposes, including but not
                    limited to sending or storing any unlawful material or for fraudulent
                    purposes;
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 4. You will
                    not
                    use the Website and mobile application to cause nuisance, annoyance or
                    inconvenience;
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 5. You will
                    not
                    impair the proper operation of the network;
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 6. You will
                    not
                    try to harm the Website and mobile application in any way whatsoever;
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 7. You will
                    not
                    copy, or distribute the Website and mobile application or other Company Content
                    without written permission from the Company;
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 8. You will
                    keep secure and confidential your account password or any
                    identification which the Company may provide you which allows access to
                    the Website and mobile application;
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 9. You will
                    provide the Company with whatever proof of identity we may
                    request;
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 10. In order
                    for us to facilitate UPI payments, we are required to conduct a
                    bank account validation and Virtual Payment Address (“VPA”) validation.
                    We conduct these validations through a third-party service provider.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 11.You will
                    only use an access point or at least a 3G data account (AP) which
                    you are authorized to use.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 12. The
                    Company
                    reserves the right to immediately terminate your use of the
                    Website and mobile application should you not comply with the any of the rules provided in the Terms
                    of Use.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp
                    <p class="headingstcsmall"> 3. PAYMENT FOR SERVICES</p>
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 1. You shall be required to pay charges
                    for
                    the Services used by you either by using
                    the online payment gateway provided in the Platform or by paying cash to the
                    Riders. The Company collects the charges for the Services on behalf of the
                    Riders after obtaining authorisation from the Riders and the payment is remitted
                    to the Rider’s bank account registered with the Company.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 2. In respect of the Delivery Services,
                    you
                    will be required settle the payments
                    incurred towards the good/products purchased from the merchants directly with
                    the Riders. You agree and acknowledge that do N key Deliveries is not in anyway be
                    responsible for the settlement between you and the Riders.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 3. The rates of the Services shall be
                    notified on the website or mobile application of the Company.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 4. The charges for the Services shall be
                    updated or amended from time to time at
                    the sole discretion of the Company and it shall be your responsibility to remain
                    informed about the charges for the Services.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 5. You agree that you will pay for all
                    Services you purchase from the Riders either
                    by way of online payment or by cash. In the event the payment cannot be
                    accepted through the online payment or any other mode, you shall be required to
                    pay the charges for the Services availed by way of cash.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 6. Any payment made is non-refundable. You
                    shall pay the service fees for availing
                    the Package Services and/or the Delivery Services at the end of the completion
                    of such services, as may be displayed to You on the Platform. You cannot initiate
                    another Package Services and/or the Delivery Services until You have paid for
                    the previously completed such Package Services and/or the Delivery Services.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 7. The customer will be required to
                    indicate
                    the accurate address for the delivery of
                    the parcel/good and also an accurate return address in case the parcel/good
                    cannot be delivered for any reason whatsoever at the delivery address.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 8. It is clarified that the transit will
                    commence from the moment the parcel/good is
                    securely handed over to the Riders by the customer till the moment the Riders
                    arrives at the delivery address or as near to the indicated delivery address as
                    may be possible.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 9. In the event the Riders is not able to
                    deliver the parcel/good at the indicated
                    address for any reason whatsoever then the Company shall not be liable for any
                    damages arising to the parcel/goods while delivering the parcel/goods at the
                    return address as provided by the customer.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <p class="headingstcsmall"> 4. LIABILITY</p>
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 1. The information,
                    recommendations
                    provided to you on or through the website for
                    general information purposes only and does not constitute advice.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 2. The Company will reasonably
                    keep
                    the Website and its contents correct and up
                    to date but does not guarantee that the Website are free of errors, defects,
                    malware and viruses or that the Website are correct, up to date and
                    accurate. The Company shall not be liable for any damage arising from the same.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 3. The Company shall further not
                    be
                    liable for damages resulting from the use of or
                    the inability to use the website, including – but not limited to – damages resulting
                    from failure or delay in delivery of electronic communications, interception or
                    manipulation of electronic communications by third parties or by computer
                    programs used for electronic communications and transmission of viruses.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 4. The quality of the Services
                    requested through the use of the Platform is entirely
                    the responsibility of the Riders who ultimately provides such Services to you and
                    the Company is not liable for the same. However, any complaints about the
                    Services provided by the Riders should be submitted to the Company by an email
                    as notified from time to time.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 5. The Company shall not in
                    anyway
                    be responsible for any claims raised by You in
                    respect of the products/goods ordered by you in respect of the Delivery Services
                    shall be at your own risk and the payment shall be settled directly between you
                    and the Riders. do N key Deliveries does not assume any responsibility or liability
                    whatsoever for any damage/deficiency or loss of the products/goods.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <p class="headingstcsmall"> 5. INTELLECTUAL PROPERTY RIGHTS</p>
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 1. The Company is the sole owner
                    and lawful licensee of all the rights to the web
                    site, Platform or any other digital media and its contents. The content means its
                    design, layout, text, images, graphics, sounds, video, etc. the website and mobile application,
                    Platform or any other digital media content embody trade secrets and intellectual property
                    rights protected under worldwide copyright and other laws. All titles, ownership
                    and intellectual property rights in the website and mobile application and its content shall remain
                    with the Company, its affiliates, agents, authorized representatives or licensor's as the
                    case may be.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 2. All rights not otherwise
                    claimed
                    under this Terms of Use or by the Company are
                    hereby reserved. The information contained in this Platform and/or website and mobile application is
                    intended, solely to provide general information for the personal use of the reader,
                    who accepts full responsibility for its use.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 3. The Company does not
                    represent
                    or endorse the accuracy or reliability of any
                    information or advertisement contained on, distributed through, or linked,
                    downloaded or accessed from any of the services contained on this website and mobile application or
                    Platform, or the quality of any products, information or other materials displayed,
                    or obtained by you as a result of any product, information or other materials
                    displayed, or obtained by you as a result of an advertisement or any other
                    information or offer in or in connection with the service.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 4. Logos are registered
                    trademarks
                    or service marks or word marks of the Company
                    in various jurisdictions and are protected under applicable copyrights, trademarks
                    and other proprietary rights laws. The unauthorized copying, modification, use or
                    publication of these marks is strictly prohibited.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 5. All the contents on this
                    website
                    and mobile application and/or Platform is copyright of the
                    Company except the third party content and link to third party website on our website and mobile
                    application and/or Platform.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 6. You shall not do the
                    following:
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 1.
                    license, sublicense, sell, resell, transfer, assign, distribute or otherwise
                    commercially exploit or make available to any third party the Platform in
                    any way;
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 2.
                    modify
                    or make derivative works based upon the Platform;

                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 3.
                    create
                    Internet "links" or "frame" or "mirror" any Website and mobile application on any other
                    server or wireless or Internet-based device.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 4.
                    Reverse
                    engineer or access the Platform in order to:
                    <p></p>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    1. design or build a competitive product or service,
                    <p></p>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    2. design or build a product using similar ideas, features, functions or
                    graphics of the Platform, or
                    <p></p>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    3. copy any ideas, features, functions or graphics of the Platform, or
                    <p></p>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    4. launch an automated program or script, including, but not limited to,
                    web spiders, web crawlers, web robots, web ants, web indexers,
                    bots, viruses or worms, or any program which may make multiple
                    server requests per second, or unduly burdens or hinders the
                    operation and/or performance of the Platform.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <p class="headingstcsmall"> 6. THIRD-PARTY LINKS</p>
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 1. During the use of
                    the website and mobile application, links to websites that are owned and
                    controlled by third parties may be provided from time to time in order to enter into
                    correspondence with, purchase goods or services from, participate in promotions
                    of third parties. These links take you off the website and mobile application, the Website and
                    mobile application and are beyond the Company's control.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 2. During use of the
                    website and mobile application and the Website and mobile application, you may
                    enter into correspondence with, purchase goods and/or services from, or participate in promotions of
                    third party Riders, advertisers or sponsors showing their goods and/or services
                    through a link on the website and mobile application or through the Website and mobile application
                    or Service. These links take you off the website and mobile application, the Website and mobile
                    application and the Service and are beyond the Company's control. You therefore visit or access
                    these websites entirely at your own risk.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 3. Please note that
                    these other websites may send their own cookies to users,
                    collect data or solicit personal information, and you are therefore advised to
                    check the terms of use or privacy policies on those websites prior to using them.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <p class="headingstcsmall"> 7.TERM AND TERMINATION</p>
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 1. The contract
                    between the Company and you is concluded for an indefinite period.
                    You are entitled to terminate the Contract at all times by permanent deletion of
                    the Platform installed on your mobile device, tablet or any electronic device
                    capable of using the Platform thus disabling the use by you of the Platform and
                    the Service.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 2. The Company is
                    entitled to terminate the contract at all times and with immediate
                    effect (by disabling your use of the Website and mobile application and the Service) if you: (a)
                    violate or
                    breach any term of these Terms of Use, or (b) in the opinion of the Company,
                    misuse of the Platform or the Service.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 3. The Company is not
                    obliged to give notice of the termination of the contract in
                    advance. After termination the Company will give notice thereof in accordance
                    with these Terms of Use.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 4. Neither party
                    hereto shall be responsible for delays or failures in performance
                    resulting from acts beyond its reasonable control and without its fault or
                    negligence. Such excusable delays or failures may be caused by, among other
                    things, strikes, lock-out, riots, rebellions, accidental explosions, floods, storms,
                    acts of God and similar occurrences.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <p class="headingstcsmall"> 8. INDEMNITY</p>
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp You will indemnify and
                    hold the Company harmless, from any and all claims, losses,
                    liabilities, damages, expenses and costs (including attorneys’ fees and court costs)
                    which result from a breach or alleged breach of these Terms of Use by you.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <p class="headingstcsmall"> 9. GOVERNING LAW, JURISDICTION AND DISPUTE RESOLUTION</p>
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 1. These Terms of Use
                    shall be governed by and interpreted in all respects in
                    accordance with the laws of the Republic of India.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 2. Subject to the
                    provisions made in Clause 10.3, the Parties hereby submit to the
                    exclusive jurisdiction of the courts of Dindigal, TamilNadu, India.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 3. All disputes
                    arising out of or in relation to these Terms of Use shall be settled
                    amicably by the Parties. In the event no amicable settlement is arrived at within a
                    period of fifteen (15) days from the date of first initiation of the dispute by one
                    Party to other, the Parties shall resolve the dispute by means of arbitration
                    pursuant to the Arbitration and Conciliation Act, 1996.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 4. The arbitration
                    proceedings shall be conducted by an arbitral tribunal comprising
                    of 1 (one) arbitrator mutually appointed by you and the Company.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 5. The arbitration
                    proceedings shall be conducted in English language only and the
                    seat for arbitration shall be Dindigal, TamilNadu, India.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 6. The award of the
                    arbitral tribunal shall be final and binding.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <p class="headingstcsmall">10. ASSIGNMENT</p>
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp You may not assign
                    your rights under these Terms of Use without prior written approval
                    of the Company.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <p class="headingstcsmall"> 11. AMENDMENT</p>
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp These Terms of Use may
                    be amended from time to time and as and when required, at
                    the discretion of the Company.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <p class="headingstcsmall"> 12. SEVERABILITY</p>
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp If any provision or
                    any part of a provision of these Terms of Use is invalid, unenforceable
                    or prohibited by applicable laws of the Republic of India , such provision or part of
                    provision shall be severed from these Terms of Use and shall be considered divisible as
                    to such provision or part thereof and such provision or part thereof shall be inoperative
                    and shall not be part of the consideration moving between you and the Company hereto
                    and the remainder of these Terms of Use shall be valid and binding and of like effect as
                    though such provision was not included herein.
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <p class="headingstcsmall"> 13. NOTICES</p>
                    <p></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp The Company may give
                    notice by means of a general notice on the Website, or by
                    electronic mail to your email address on record in the Company's account information, or
                    by written communication sent by regular mail to your address on record in Company's
                    account information.
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="main-footer">
    <div class="upper-box">
        <div class="auto-container">
            <div class="row">

                <div class="col-md-2">
                    <div class="widget links-widget">

                        <h4 style="font-weight: 700;" class="ridr"> Rider App</h4><br>
                      <a href="https://play.google.com/store/apps/details?id=com.donkey.driverapp">  <img class="gplay" src="{{ asset('public/assets/images/play store.jpg') }}" alt="Rider App"
                            style="height: 35px; width:108px;">
                        <br> <br>
                        <h4 style="font-weight: 700;"> User App</h4><br>
                       <a href="https://play.google.com/store/apps/details?id=com.fertail.donkeyuser"> <img class="gplay" src="{{ asset('public/assets/images/play store.jpg') }}" alt="Rider App"
                            style="height: 35px; width:108px;"></a>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="widget contact-widget style-two">
                        <h4 class="widget_title"> Contact Us</h4>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="wrapper-box">
                                    {{-- <div class="icon-box">
                                        <div class="icon"><span class="flaticon-calling"></span></div>
                                        <div class="text"><strong></strong><a
                                                href="tel:{{ $site_details[0]->phone }}">
                                                @php
                                                    $numbers = explode('/', $site_details[0]->phone);
                                                    
                                                @endphp
                                                {{ $numbers[0] }}
                                                <br>
                                                {{ $numbers[1] }}
                                                <!-- {{ $site_details[0]->phone }} --> </a>
                                        </div>
                                    </div> --}}
                                    <div class="icon-box">
                                        <div class="icon"><span class="flaticon-calling"></span></div>
                                        <div class="text"><strong></strong><a class="disblo"href="tel:{{ str_replace([' ', '-', '(', ')'], '', $numbers[0]) }}">
                                            @php
                                                $numbers = explode('/', $site_details[0]->phone);
                                            @endphp
                                            {{ $numbers[0] }}
                                        </a>
                                            <br>
                                            <a href="tel:{{ str_replace([' ', '-', '(', ')'], '', $numbers[1]) }}">
                                          
                                            {{ $numbers[1] }}
                                            <!-- {{ $site_details[0]->phone }} --> 
                                        </a></div>
                                    </div>
                                    
                                    <div class="icon-box">
                                        <div class="icon" style="display: flex">
                                            <span class="flaticon-mail mr-3"></span>
                                        </div>
                                        <div class="text">
                                            <a href="tel:{{ $site_details[0]->email }}">
                                                {{ $site_details[0]->email }}

                                            </a>
                                        </div>

                                    </div>








                                    <ul class="social-icon" style="margin-top: 10px">
                                        <li> <b>
                                                Follow Us On:</b></li>
                                        <li><a href="https://www.facebook.com/doNkey.app.deliveries?mibextid=ZbWKwL"><i
                                                    class="fab fa-facebook-f"></i></a></li>
                                        <li><a
                                                href="https://x.com/doNkey_Delivery?t=MNIa2Z-ja0QlsTExo4eDnQ&s=08"><i
                                                    class="fab fa-twitter"></i></a></li>
                                        <li><a
                                                href="https://instagram.com/donkey_deliveries?igshid=MzRlODBiNWFlZA=="><i
                                                    class="fab fa-instagram"></i></a></li>
                                                    <li><a
                                                        href="https://youtube.com/@doNkey_Delivery?si=VnSW6_eHtOQG5Zpg"><i
                                                            class="fab fa-youtube"></i></a></li>
                                        <!--<li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>-->
                                        <!--<li><a href="#"><i class="fab fa-youtube"></i></a></li>-->
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget links-widget">
                        <h4 class="widget_title">Useful Links</h4>
                        <div class="widget-content">
                            <ul class="list">
                                <li><a href="{{ url('about') }}">About Company</a></li>
                                <li><a href="{{ url('contact') }}">Get In Touch</a></li>

                                <li><a href="{{ url('services') }}">Our Services</a></li>
                        </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget links-widget">
                        <h4 class="widget_title">Policy</h4>
                        <div class="widget-content">
                            <ul class="list">


                                <li><a href="{{ url('tc') }}">Terms And Conditions</a></li>

                                <li><a href="{{ url('privacypolicyandcookies') }}">Privacy policy and cookies</a>
                                </li>
                                <li><a href="{{ url('returnandrefundpolicy') }}">Return and refund policy</a></li>

                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</footer>

<!--End Main Footer-->

<div class="footer-bottom">
    <div class="auto-container">
        <div class="row m-0 align-items-center justify-content-between">
            <div class="col-auto">
                <div class="copyright-container">
                    <div class="copyright-text text-dark">
                        Copyright © {{ now()->format('Y') }} <a href="{{ url('/') }}">{{ $site_details[0]->sitename }}</a>
                        All Rights Reserved. Patent Pending.
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <ul class="menu">
                    <!-- <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Sitemap</a></li> -->
                </ul>
            </div>
            <div class="col-auto">
                <span class="flag-india">
                    <img src="public/assets/images/india.png" alt="" style="height: 25px; width: 25px;">
                    <b>(IND)</b>
                </span>
            </div>
        </div>
    </div>        
</div>

</div>
<!--End pagewrapper-->

<!--Scroll to top-->
{{-- <div class="scroll-to-top scroll-to-target" data-target="html"><span class="flaticon-right-arrow-6"></span></div>
</div> --}}
<div class="scroll-to-top scroll-to-target" data-target="#top">
    <span class="flaticon-right-arrow-6"></span>
  </div>
  <script>
  // Get the scroll-to-top button element
  const scrollButton = document.querySelector('.scroll-to-top');
  
  // Add a scroll event listener to the window
  window.addEventListener('scroll', () => {
    // Show the button when scrolling down
    if (window.scrollY > 200) {
      scrollButton.style.display = 'block';
    } else {
      scrollButton.style.display = 'none';
    }
  });
  
  // Add a click event listener to the scroll button
  scrollButton.addEventListener('click', () => {
    // Scroll to the top of the page with a smooth transition
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
</script>
        
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-link');

        // Set the active link based on the current URL
        navLinks.forEach(function(link) {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });

        // Highlight the active link when scrolling to a section
        window.addEventListener('scroll', function() {
            const scrollPosition = window.scrollY;
            const sections = document.querySelectorAll('[data-scrollto]');

            sections.forEach(function(section) {
                const offsetTop = section.offsetTop - 100; // Adjust the offset as needed
                const targetLink = document.querySelector(
                    `.nav-link[href="#${section.getAttribute('data-scrollto')}"]`);

                if (scrollPosition >= offsetTop) {
                    navLinks.forEach(function(link) {
                        link.classList.remove('active');
                    });
                    targetLink.classList.add('active');
                }
            });
        });
    });
</script>
<script>
    var scroll = new SmoothScroll('a[href*="#"]', {
      speed: 800, // Adjust the scrolling speed (milliseconds)
      offset: 0,  // Adjust the offset if needed (pixels)
    });
  </script>
  
<script>
    new WOW().init();
</script>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<script src="{{ url('public/assets/js/jquery.js') }}"></script>
<script src="{{ url('public/assets/js/popper.min.js') }}"></script>
<script src="{{ url('public/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ url('public/assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ url('public/assets/js/jquery.fancybox.js') }}"></script>
<script src="{{ url('public/assets/js/isotope.js') }}"></script>
<script src="{{ url('public/assets/js/owl.js') }}"></script>
<script src="{{ url('public/assets/js/appear.js') }}"></script>
<script src="{{ url('public/assets/js/wow.js') }}"></script>
<script src="{{ url('public/assets/js/lazyload.js') }}"></script>
<script src="{{ url('public/assets/js/scrollbar.js') }}"></script>
<script src="{{ url('public/assets/js/TweenMax.min.js') }}"></script>
<script src="{{ url('public/assets/js/swiper.min.js') }}"></script>
<script src="{{ url('public/assets/js/jquery.polyglot.language.switcher.js') }}"></script>
<script src="{{ url('public/assets/js/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ url('public/assets/js/parallax-scroll.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/smooth-scroll@16.1.3/dist/smooth-scroll.polyfills.min.js"></script>


<script src="{{ url('public/assets/js/script.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.25.0/font/bootstrap-icons.css" rel="stylesheet">


<!-- <div class="cursor"></div> -->
<!-- <div class="cursor2"></div> -->
</body>
<!-- <style>
.cursor {
width: 50px;
height: 50px;
border-radius: 100%;
border: 1px solid black;
transition: all 200ms ease-out;
position: fixed;
pointer-events: none;
left: 0;
top: 0;
transform: translate(calc(-50% + 15px), -50%);
}

.cursor2 {
width: 20px;
height: 20px;
border-radius: 100%;
/* background-color: black; */
border: #293e9c 2px solid;
opacity: .3;
position: fixed;
transform: translate(-50%, -50%);
z-index: 10 !important;
pointer-events: none;
transition: width .3s, height .3s, opacity .3s;
animation: zoomInoutanimation 2s infinite;
}

@keyframes zoomInoutanimation {
0% {
    width: 20px;
    height: 20px;
}

10% {
    width: 25px;
    height: 25px;
}

20% {
    width: 30px;
    height: 30px;
}

30% {
    width: 35px;
    height: 35px;
}

40% {
    width: 40px;
    height: 40px;
}

50% {
    width: 45px;
    height: 45px;
}

60% {
    width: 30px;
    height: 30px;
}

70% {
    width: 25px;
    height: 25px;
}

80% {
    width: 20px;
    height: 20px;
}

10% {
    width: 15px;
    height: 15px;
}

100% {
    width: 20px;
    height: 20px;
}
}
</style>
<script>
// UPDATE: I was able to get this working again... Enjoy!

var cursor = document.querySelector('.cursor');
var cursorinner = document.querySelector('.cursor2');
// var a = document.querySelectorAll('a');

document.addEventListener('mousemove', function(e) {
    var x = e.clientX;
    var y = e.clientY;
    cursor.style.transform = `translate3d(calc(${e.clientX}px - 50%), calc(${e.clientY}px - 50%), 0)`
});

document.addEventListener('mousemove', function(e) {
    var x = e.clientX;
    var y = e.clientY;
    cursorinner.style.left = x + 'px';
    cursorinner.style.top = y + 'px';
});

// document.addEventListener('mousedown', function() {
//     cursor.classList.add('click');
//     cursorinner.classList.add('cursorinnerhover')
// });

// document.addEventListener('mouseup', function() {
//     cursor.classList.remove('click')
//     cursorinner.classList.remove('cursorinnerhover')
// });

// a.forEach(item => {
//   item.addEventListener('mouseover', () => {
//     cursor.classList.add('hover');
//   });
//   item.addEventListener('mouseleave', () => {
//     cursor.classList.remove('hover');
//   });
// })
</script> -->

</html>