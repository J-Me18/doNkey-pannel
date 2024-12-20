@extends('layouts/homemaster')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <style>
        .owl-nav{
            display:  none !important;
        }
        .owl-prev,
        .owl-next {
            display: none;
        }
@media only screen and (max-width:320px){
.page-title .content-box{
padding:0px !important;
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

        /* Style for success message */
        .alert-success {
            background-color: white;
            /* Green color */
            color: #4CAF50;
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
        }

        @media (max-width: 480px) {
            .picpic {
                background-size: 100% 200px !important;
                margin-top: -119px !important;
                margin-bottom: -219px !important;
                background-color: #f6f7fd !important;
                padding:0px !important;
            }

            .abtus {
                font-size: 20px !important;
                display:none !important;
            }

            .cel {
                font-size: 14px !important;
                margin-left: -30px !important;
            }

            .cads {
                font-size: 15px !important;
            }
            .conco{
            display:none !important;
            }

            .japbp {
                font-size: 24px !important;
            }

            .cont {
                color: white !important;
                font-weight:800 !important;
                display: inline-flex !important;
                width: 250px !important;
                margin-left: -40px !important;
            }
            .icbx{
                margin-top: -1px !important;
            }
            .inner-container{
            margin-right: 0px !important;
        }
        .oxh{
            overflow-x: hidden !important;
        }
        }
    </style>
    <!-- Page Title -->
    <div class="oxh">
    <section class="page-title picpic" style="background-image: url('public/assets/images/contactbaner.jpeg');">
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
                        
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="contact-map">
            <iframe src="{{ $site_details[0]->map }}" width="600" height="490" style="border:0; width: 100%"
                allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </section>


    <!-- Contact Info section two -->
    <section class="contact-info-section-two">
        <div class="auto-container">
            <div class="nav-tabs-wrapper">
                <div class="nav nav-tabs tab-btn-style-two">
                    <div class="theme_carousel owl-theme owl-carousel"
                        data-options='{"loop": false, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 6000, "smartSpeed": 1000, "responsive":{ "0" :{ "items": "1" }, "600" :{ "items" : "1" }, "768" :{ "items" : "2" } , "992":{ "items" : "2" }, "1200":{ "items" : "3" }}}'>
                        <ul class="item">
                            <li><a class="active e1" data-toggle="tab" href="#tab-one">
                                    <h4>{{ $site_details[0]->sitename }}</h4>
                                </a></li>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="tab-content ">
                <div class="tab-pane fadeInUp  animated" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="outer-box">
                                <h4><span class="flaticon-cursor cads "
                                        style="color:white;"></span>{{ $site_details[0]->address }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="wrapper-box">
                                            <div class="icon-box">
                                                <div class="icon"><span class="flaticon-calling"
                                                        style="color:white;"></span></div>
                                                <div class="text-area">
                                                    <div class="col">
                                                        <div class="text"><strong></strong>
                                                            @php
                                                                $numbers = explode('/', $site_details[0]->phone);
                                                            @endphp
                                                            <a
                                                                href="tel:{{ str_replace([' ', '-', '(', ')'], '', $numbers[0]) }}" class="cont" style="color: white;font-weight:800;">

                                                                {{ $numbers[0] }}
                                                            </a>
                                                            <br>
                                                            <a
                                                                href="tel:{{ str_replace([' ', '-', '(', ')'], '', $numbers[1]) }}"  class="cont" style="color: white;font-weight:800;">

                                                                {{ $numbers[1] }}
                                                                <!-- {{ $site_details[0]->phone }} -->

                                                            </a>
                                                        </div>
                                                    </div>








                                                </div>
                                            </div>
                                            <br>
                                            <div class="icon-box icbx" style="margin-top:-27px;">
                                                <div class="icon"><span class="flaticon-mail" style="color:white;"></span>
                                                </div>
                                                <div class="text-area">
                                                    <div class="text"><strong><a
                                                                href="mailto:{{ $site_details[0]->email }}"
                                                                style="color: white;"
                                                                class="cel">{{ $site_details[0]->email }}</a></strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="sec-title">
                                <h2 class="japbp"> Join as Prime business partner</h2>
                            </div>
                            <div class="text">Join Forces with Us: <br> Together, We Can Take Our Business to the Next
                                Level.</div>
                            <div class="link">
                                <a href="{{ url('pbp') }}" class="readmore-link theme"
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
    </section>

    <!-- Contact form section -->
    <section class="contact-form-section">
        <div class="auto-container">
            <div class="sec-title text-center">
                <div class="sub-titled"
                    style="font-weight: 900; font-size:25px; padding-bottom:18px;
            font-family: 'Poppins', sans-serif;">
                    Give a Feedback</div>
                <h2 class="japbp">We’re Always Here for You</h2>
                <div class="text">"Effortless buying, swift delivery – all in one place."</div>
            </div>
            <!--Contact Form-->
            <div class="contact-form">
                <div id="success-message" style="display: none;" class="alert alert-success">Successfully Submitted!</div>

                <form method="post" action="{{ route('feedback') }}" id="contact-form" onsubmit="showSuccessMessage();">

                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name"
                                required>
                        </div>
                        {{-- <div class="form-group col-md-6">
                        <input type="text" name="company" value="{{ old('company') }}" placeholder="Company Name" required>
                    </div> --}}
                        <div class="form-group col-md-6">
                            <input type="text" name="email" value="{{ old('email') }}" placeholder="Your Email"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone Number"
                                required>
                        </div>


                        <div class="form-group col-md-6">
                            <textarea name="message" placeholder="Message" value="{{ old('message') }}"></textarea>
                        </div>
                        <div class="form-group text-center col-md-12">
                            <input id="form_botcheck" class="form-control" type="hidden" value="">
                            <button class="theme-btn btn-style-one" type="submit"
                                data-loading-text="Please wait..."><span><i class="flaticon-up-arrow"></i>Send
                                    Feedback</span></button>
                        </div>
                    </div>
                </form>
                <script>
                    function showSuccessMessage() {
                        // Prevent the form from submitting normally
                        event.preventDefault();

                        // Get the form element
                        const contactForm = document.getElementById('contact-form');

                        // Serialize the form data into a format that can be sent via AJAX
                        const formData = new FormData(contactForm);

                        // Send an AJAX POST request to the server
                        fetch(contactForm.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                },
                            })
                            .then(response => {
                                if (response.ok) {
                                    // Display a SweetAlert success message
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Successfully Submitted',
                                        text: '',
                                        showConfirmButton: false,
                                        timer: 2000, // 2 seconds
                                        timerProgressBar: true,
                                    });

                                    // Clear the form inputs and reset the form after a brief delay
                                    setTimeout(function() {
                                        contactForm.reset();
                                    }, 2000); // 2 seconds
                                } else {
                                    // Handle errors here, e.g., show an error message
                                    console.error('Error submitting the form');
                                }
                            })
                            .catch(error => {
                                console.error('An error occurred:', error);
                            });
                    }
                </script>






            </div>
            <!--End Contact Form-->
        </div>
    </section></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.e1').trigger('click');
        })
    </script>
@endsection
