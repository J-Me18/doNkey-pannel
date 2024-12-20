<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 800px;/ Adjust width for A4 size / margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .invoice-header {
            text-align: start;
            margin-bottom: 20px;
        }

        .invoice-headerr {
            text-align: end !important;
            margin-bottom: 20px;
        }

        .invoice-header img {
            width: 200px;
            height: auto;
        }

        .invoice-header h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .invoice-header p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }

        /* .invoice-container {
            display: flex;
            justify-content: space-between !important;
            flex-wrap: wrap;
        } */

        .invoice-details {
            width: calc(50% - 10px);
            margin-bottom: 30px;
        }

        .invoice-details h3 {
            margin-top: 0;
            font-size: 18px;
            color: #333;
        }

        .invoice-details p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }

        .table-container {
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .invoice-total {
            margin-top: 30px;
        }

        .invoice-total p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }

        .invoice-footer {
            margin-top: 30px;
        }

        .invoice-footer ul {
            padding-left: 20px;
            list-style-type: square;
            font-size: 14px;
            color: #666;
        }

        .mode p {
            display: inline-block;
            margin-bottom: 30px;
            margin-right: 25px;
            margin-left: 15px;


        }

        .thank {
            text-align: center;
            margin-bottom: 20px;
            margin-top: 30px !important;
        }

        .top-container {
            display: inline-block;
        }

        .tax {
            text-align: center;
            margin-bottom: 30px;
        }

        .date {
            margin-left: 280px;
        }

        .dates {
            margin-left: 15px;
        }

        .right {
            margin-right: 200px;
        }

        .data {
            border: none !important;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    @php
        $site = App\Models\site::where('id', 1)->first();
    @endphp
    <div class="container">
        {{-- <div class="top-container"> --}}
        <h2 class="tax">Tax Invoice</h2>
        <div class="invoice-header  top-container">
            <img src="{{ url('public/site/' . $site->main_logo) }}" style="height: 80px;width:50px;" alt="Do N Key">
        </div>
        <div class="invoice-headerr  top-container">
            {{-- <p class="date">Invoice Number: {{ $paymentDetail?->invoice_no }}</p> --}}
            <p class="date">Date: {{ now()->format('d-m-Y') }}</p>
        </div>
        {{-- </div> --}}


        <div class="invoice-container">
            <div class=" top-container">
                <h3>do N key Deliveries</h3>
                <p>12-4-26, 1st Floor, Govindasamy Street,<br>Mettupatti, Chinnalapatti,
                    <br> Dindigul - 624301.
                </p>
                <p><strong>GSTIN/UIN:</strong> 33FJIPK6344H1Z3</p>
                <p><strong>State Name:</strong> Tamil Nadu, Code: 33</p>
                <p><strong>Email:</strong> <a
                        href="mailto:finance@donkeydeliveries.com">finance@donkeydeliveries.com</a></p>
            </div>
            <div class=" top-container dates">
                <h3>Buyer (Bill to)</h3>
                <p><strong>Name:</strong> {{ $paymentDetail?->subscriber?->name }}</p>
                <p><strong>subscriberId:</strong> {{ $paymentDetail?->subscriber?->subscriberId }}</p>
                <p>{{ $paymentDetail?->subscriber?->location }}</p>
                <p><strong>GSTIN/UIN:</strong> {{ $paymentDetail?->subscriber?->gst }} <!-- Buyer's GSTIN/UIN --></p>
                <p><strong>State Name:</strong> Tamil Nadu</p>
            </div>

        </div>
        {{-- {{ dd($paymentDetail); }} --}}
        <div class="mode">
            <p>Invoice No:{{ $paymentDetail?->invoice_no }}</p>
            <p>Date Issued: {{ now()->format('d-m-Y') }}</p>
            <p>Mode of Payment: Online</p>
        </div>
        @php
            if ($paymentDetail->type == 1) {
                $subtotal = $paymentDetail->amount / 100;
                $subscriptionPrice = $subtotal - $paymentDetail->subscriber->subscription_price;
                $cgst = $subscriptionPrice / 2; // CGST is 9% of the subtotal
                $sgst = $subscriptionPrice / 2; // SGST is also 9% of the subtotal
                $total = $paymentDetail->subscriber->subscription_price;
            } elseif ($paymentDetail->type == 2) {
                $subtotal = $paymentDetail->amount / 100;
                $subscriptionPrice = $subtotal - $paymentDetail->subscriber->subscription_price;
                $cgst = ($paymentDetail->subscriber->subscription_price * 9) / 100; // CGST is 9% of the subtotal
                $sgst = ($paymentDetail->subscriber->subscription_price * 9) / 100; // SGST is also 9% of the subtotal
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
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Description of Services</th>
                        <th>Units</th>
                        <th>Per</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        @if ($paymentDetail->type == 1 || $paymentDetail->type == 2)
                            <td class="left">Renewal Pay</td>
                        @else
                            <td class="left">PLat Form Fee</td>
                        @endif
                        <td>{{ count($pincodes) }}</td>
                        <td>Nos</td>
                        <td>{{ number_format($total, 2) }}</td>
                    </tr>

                </tbody>
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
            </table>
            <div class="col-lg-4 col-sm-5 ml-auto">
                <table class="table table-clear">
                    <tbody>
                        <tr>
                            <td class="data">
                                <strong class="text-dark">Subtotal</strong>
                            </td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>

                            <td class="data"> {{ $total }}</td>
                        </tr>
                        <tr>
                            <td class="data">
                                <strong class="text-dark">CGST {{ $paymentDetail->type == 3 ? '' : '(9%)' }}</strong>
                            </td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data">{{ $cgst }}</td>
                        </tr>
                        <tr>
                            <td class="data">
                                <strong class="text-dark">SGST {{ $paymentDetail->type == 3 ? '' : '(9%)' }}</strong>
                            </td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data">{{ $sgst }}</td>
                        </tr>
                        <tr>
                            <td class="data">
                                <strong class="text-dark">Round-off Total</strong>
                            </td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data"></td>
                            <td class="data">
                                <strong class="text-dark">{{ $subtotal }}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="invoice-total">
            <p><strong>Amount Paid:</strong>{{ $subtotal }}</p>
            <p><strong>Amount In Words:</strong>INR {{ $amount_in_words }} Only</p>
            <p class="thank"><strong>Thank you for your business.</strong></p>
        </div>

        <div class="invoice-footer">
            <p><strong>Terms and Conditions:</strong></p>
            <ul>
                <li>This invoice is valid for a period of 28 days from the date of issuance.</li>
                <li>This is a computer-generated bill and no signature is required.</li>
            </ul>
        </div>
    </div>

</body>

</html>
