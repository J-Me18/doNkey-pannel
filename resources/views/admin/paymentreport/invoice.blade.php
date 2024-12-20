@extends('layouts.master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- In the <head> section of your layout file -->
<!-- jQuery CDN link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@section('content')
    <style>
        @media only screen and (max-width: 565px) {
            .amount {
                width: auto !important;
            }
        }


        .padding {

            padding: 2rem !important;
        }

        .card {
            margin-bottom: 30px;
            border: none;
            -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e6e6f2;
        }

        h3 {
            font-size: 20px;
        }

        h5 {
            font-size: 15px;
            line-height: 26px;
            color: #3d405c;
            margin: 0px 0px 0px 0px;
            font-family: 'Circular Std Medium';
        }

        .text-dark {
            color: #3d405c !important;
        }

        .table-responsive-sm {
            margin-top: 40px;
        }
    </style>

    <body>
        @php
            $site = App\Models\site::where('id', 1)->first();
        @endphp

        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
            <div class="pull-right pl-2">
                <a class="btn btn-danger" target="blank" id="downloadPdf"
                    href="{{ route('invoicedownloadPDF', $paymentDetail->id) }}">
                    <i class="fas fa-file-pdf"></i> Download PDF
                </a>
            </div>




            <div class="card">


                <div class="card-header p-4">
                    {{-- <a class="pt-2 d-inline-block" href="index.html" data-abc="true">BBBootstrap.com</a> --}}
                    {{-- <img src="public/assets/images/do.png" alt=""> --}}
                    <img src="{{ url('public/site/' . $site->main_logo) }}" class=" pt-2 d-inline-block"
                        style="width: 80; height:55px;">
                    <div class="float-right">
                        <h3 class="mb-0">Tax Invoice </h3>
                        {{-- Invoice Number: {{ $paymentDetail?->invoice_no }}<br> --}}
                        Date: {{ now()->format('d-m-Y') }}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h5 class="mb-3"><b> do N key Deliveries</b> </h5>
                            <h6 class="text-dark mb-1">12-4-26, 1st Floor, Govindasamy Street,
                                Mettupatti, Chinnalapatti, Dindigul - 624301.
                            </h6>

                            <div><b> GSTIN/UIN :</b> 33FJIPK6344H1Z3</div>
                            <div> <b> State Name :</b> Tamil Nadu, Code : 33</div>
                            <div> <b> Email :</b> finance@donkeydeliveries.com</div>


                        </div>
                        <div class="col-sm-6 ">
                            <h5><b> Buyer (Bill to)</b> </h5>
                            <div><b> Name :{{ $paymentDetail?->subscriber?->name }} </b> </div>
                            <div><b> SubscriberId :{{ $paymentDetail?->subscriber?->subscriberId }} </b> </div>
                            {{-- {{ dd($subscriber); }} --}}
                            <h6 class="text-dark mb-1"> {{ $paymentDetail?->subscriber?->location }} </h6>

                            <div><b> GSTIN/UIN :{{ $paymentDetail?->subscriber?->gst }} </b> </div>
                            <div><b> State Name :</b> Tamil Nadu</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4"><b> Invoice No:</b>{{ $paymentDetail?->invoice_no }}</div>
                        <div class="col-4"><b> Date Issued:</b>{{ now()->format('d-m-Y') }}</div>
                        <div class="col-4"><b> Mode of Payment:</b> Online </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                @php
                                    // dd($paymentDetail);
                                    if ($paymentDetail->type == 1) {
                                        $subtotal = $paymentDetail->amount / 100;
                                        $subscriptionPrice = $subtotal - $paymentDetail->subscriber->subscription_price;
                                        $cgst = $subscriptionPrice / 2; // CGST is 9% of the subtotal
                                        $sgst = $subscriptionPrice / 2; // SGST is also 9% of the subtotal
                                        $total = $paymentDetail->subscriber->subscription_price;
                                    } elseif ($paymentDetail->type == 2) {
                                        $subtotal = $paymentDetail->amount / 100;
                                        $subscriptionPrice = $subtotal - $paymentDetail->subscriber->subscription_price;
                                        $cgst = ($paymentDetail->subscriber->subscription_price * 100) / 9; // CGST is 9% of the subtotal
                                        $sgst = ($paymentDetail->subscriber->subscription_price * 100) / 9; // SGST is also 9% of the subtotal
                                        $total = $subtotal - ($cgst + $sgst);
                                    } else {
                                        $subtotal = $paymentDetail->amount / 100;
                                        $subscriptionPrice = $subtotal - $paymentDetail->subscriber->subscription_price;
                                        $cgst = 0; // CGST is 9% of the subtotal
                                        $sgst = 0; // SGST is also 9% of the subtotal
                                        $total = $paymentDetail->amount / 100;
                                    }
                                    $pincodes = json_decode($paymentDetail->subscriber->pincode);
                                @endphp
                                <tr>
                                    <th class="center">S.No</th>
                                    <th>Description of Services</th>
                                    <th class="right">Units</th>
                                    <th class="center">Per</th>
                                    <th class="right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="center">1</td>
                                    @if ($paymentDetail->type == 1 || $paymentDetail->type == 2)
                                        <td class="left">Renewal Pay</td>
                                    @else
                                        <td class="left">PLat Form Fee</td>
                                    @endif
                                    <td class="right">{{ count($pincodes) }}</td>
                                    <td class="center">Nos</td>
                                    <td class="right">{{ number_format($total, 2) }}</td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                    @php
                        function convertAmountToWords($amount)
                        {
                            $ones = [
                                1 => 'One',
                                2 => 'Two',
                                3 => 'Three',
                                4 => 'Four',
                                5 => 'Five',
                                6 => 'Six',
                                7 => 'Seven',
                                8 => 'Eight',
                                9 => 'Nine',
                            ];

                            $teens = [
                                11 => 'Eleven',
                                12 => 'Twelve',
                                13 => 'Thirteen',
                                14 => 'Fourteen',
                                15 => 'Fifteen',
                                16 => 'Sixteen',
                                17 => 'Seventeen',
                                18 => 'Eighteen',
                                19 => 'Nineteen',
                            ];

                            $tens = [
                                10 => 'Ten',
                                20 => 'Twenty',
                                30 => 'Thirty',
                                40 => 'Forty',
                                50 => 'Fifty',
                                60 => 'Sixty',
                                70 => 'Seventy',
                                80 => 'Eighty',
                                90 => 'Ninety',
                            ];

                            $amount_in_words = '';

                            if ($amount < 10) {
                                $amount_in_words = $ones[$amount];
                            } elseif ($amount < 20) {
                                $amount_in_words = $teens[$amount];
                            } elseif ($amount < 100) {
                                $tens_digit = floor($amount / 10) * 10;
                                $ones_digit = $amount % 10;
                                $amount_in_words = $tens[$tens_digit];
                                if ($ones_digit > 0) {
                                    $amount_in_words .= ' ' . $ones[$ones_digit];
                                }
                            } elseif ($amount < 1000) {
                                $hundreds_digit = floor($amount / 100);
                                $remainder = $amount % 100;
                                $amount_in_words = $ones[$hundreds_digit] . ' Hundred';
                                if ($remainder > 0) {
                                    $amount_in_words .= ' ' . convertAmountToWords($remainder);
                                }
                            } elseif ($amount < 100000) {
                                // Up to 99,999
                                $thousands_digit = floor($amount / 1000);
                                $remainder = $amount % 1000;
                                $amount_in_words = convertAmountToWords($thousands_digit) . ' Thousand';
                                if ($remainder > 0) {
                                    $amount_in_words .= ' ' . convertAmountToWords($remainder);
                                }
                            } elseif ($amount < 10000000) {
                                // Up to 9,999,999
                                $lakhs_digit = floor($amount / 100000);
                                $remainder = $amount % 100000;
                                $amount_in_words = convertAmountToWords($lakhs_digit) . ' Lakh';
                                if ($remainder > 0) {
                                    $amount_in_words .= ' ' . convertAmountToWords($remainder);
                                }
                            } elseif ($amount < 1000000000) {
                                // Up to 999,999,999
                                $crores_digit = floor($amount / 10000000);
                                $remainder = $amount % 10000000;
                                $amount_in_words = convertAmountToWords($crores_digit) . ' Crore';
                                if ($remainder > 0) {
                                    $amount_in_words .= ' ' . convertAmountToWords($remainder);
                                }
                            } else {
                                $amount_in_words = 'Out of range';
                            }

                            return $amount_in_words;
                        }
                    @endphp

                    @php
                        // $subtotal = ;
                        $amount_in_words = convertAmountToWords($subtotal);

                    @endphp

                    <div class="row">
                        <div class="col-lg-4 col-sm-5">
                            <h5 style="margin-top: 20px;font-weight:700;font-size:20px;">Amount Paid:
                                <i>&#8377;</i>{{ $subtotal }}
                            </h5>
                            <p style="font-weight:100;">Amount In Words,</p>
                            <p style="width:340px;" class="amount">INR {{ $amount_in_words }} Only</p>
                            <h6 class="mt-5 text-dark" style=""><strong> Thank you for business</strong></h6>
                        </div>

                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">Subtotal</strong>
                                        </td>
                                        <td class="right">{{ $total }}</td>
                                    </tr>

                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">CGST
                                                {{ $paymentDetail->type == 3 ? '' : '(9%)' }}</strong>
                                        </td>
                                        <td class="right">{{ $cgst }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">SGST
                                                {{ $paymentDetail->type == 3 ? '' : '(9%)' }}</strong>
                                        </td>
                                        <td class="right">{{ $sgst }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">Round-off Total</strong>
                                        </td>
                                        <td class="right">
                                            <strong class="text-dark">{{ $subtotal }}</strong>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <p class="mb-0">Terms and Condition</p>
                    <ul>
                        <li>This invoice is valid for a period of 28 days from the date of issuance.</li>
                        <li>This is a computer-generated bill and no signature is required.</li>
                    </ul>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js" onload="initPdfDownload()"></script>
        <script>
            $(document).ready(function() {
                initPdfDownload();
            });

            function initPdfDownload() {
                document.getElementById('downloadPdf').addEventListener('click', function() {
                    // Ensure jsPDF is loaded before proceeding
                    if (typeof jsPDF !== 'undefined') {
                        // Get the HTML content of the card
                        var cardContent = document.querySelector('.card').outerHTML;

                        // Create a new jsPDF instance
                        var pdf = new jsPDF();

                        // Add HTML content to the PDF
                        pdf.html(cardContent, {
                            callback: function(pdf) {
                                // Save the PDF as a file
                                pdf.save('invoice.pdf');
                            }
                        });
                    } else {
                        console.error('jsPDF library is not loaded.');
                    }
                });
            }
        </script>
    @endsection
