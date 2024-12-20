@extends('layouts/homemaster')
@section('content')
    <style>
        .statement-section .content {
            position: relative;
            margin: 60px 0 0;
            margin-left: -119px;
            background: #fff;
            padding: 60px 0;

            padding-left: 120px;
        }

        .images img {
            width: 85%;
            height: 700px;
        }

        @media only screen and (max-width:320px) {

            .images img {
                width: 85%;
                height: 500px;
            }
        }

        @media only screen and(max-width:320px) {
            .page-title .banner {
                background-size: 100% 520px !important;
            }
        }

        .greenbutton {

            background-color: #d3ff53;
            color: black;

            /* margin-top: 20px; */

        }


        .greenbutton:hover {
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
    .abttus{
        margin-top:20px !important;
        /* text-align: center !important;
         */
         /* margin-left:80px !important; */
        font-size:20px !important;
    }
    .rmr{
        width:200px !important;
        height:200px !important;
        margin-left:30px !important;
    }
    .js{
        margin-left:120px !important;
        margin-bottom: 20px !important;
    }
        
        }
    </style>
    <!-- Page Title -->

    <section class="page-title banner picpic" style="background-image: url('{{ asset('public/assets/images/' . $banner) }}');">


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
                        <h1 class="abtus">{{ $heading }}</h1>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Statement -->

    <section class="statement-section pt-5">
        <div class="auto-container">

            <div class="row">
                <div class="col-10">
                    <div class="sec-title mb-30">
                        <h2 class="abttus">{{ $heading }}</h2>
                    </div>
                </div>
                @if ($heading == $button)
                    <div class="col-md-2"> <a href="{{ url('pbp') }}"><button type="submit" class="btn greenbutton js">
                                Join Us</button></a>
                    </div>
            </div>
            @endif


            <div class="card" style="border: none;">
                <div class="card-body">
                    <style>
                        @media only screen and(max-width:320px) {
                            .images>img {
                                height: 300px;
                                width: 300px;
                            }
                        }
                    </style>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="image images "><img class="rmr" src="{{ url('public/assets/images/') }}/{{ $image }}"
                                    alt="" style="height:300px; width:400px; margin-top:20px;margin-bottom:-15px; ">
                            </div>
                        </div>

                        @if ($point == $heading)
                            <div class="col-md-6">
                                <div class="tab-content wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1200ms">
                                    <div class="tab-pane fadeInUp animated active" id="tab-one" role="tabpanel"
                                        aria-labelledby="tab-one">
                                        <div class="text-block">

                                            <div class="text"
                                                style="justify-content: center;text-align: justify;margin-top:30px;">
                                                {{ $content[0] }}<br>
                                                {{ $content[1] }}<br>
                                                {{ $content[2] }}<br>
                                                {{ $content[3] }}<br>
                                                {{ $content[4] }}<br>
                                                {{ $content[5] }}<br>
                                                {{ $content[6] }}<br>
                                                {{ $content[7] }}<br>
                                                {{ $content[8] }}<br>
                                                {{ $content[9] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-md-6">
                                <div class="tab-content wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1200ms">
                                    <div class="tab-pane fadeInUp animated active" id="tab-one" role="tabpanel"
                                        aria-labelledby="tab-one">
                                        <div class="text-block">

                                            <div class="text"
                                                style="justify-content: center;text-align: justify;margin-top:30px;">
                                                {{ $content[0] }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12" style="margin-top: -38px;">
                                <div class="tab-content wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1200ms">
                                    <div class="tab-pane fadeInUp animated active" id="tab-one" role="tabpanel"
                                        aria-labelledby="tab-one">
                                        <div class="text-block">

                                            <div class="text" style="justify-content: center;text-align: justify">
                                                {{ $content[1] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                    @endif


                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
