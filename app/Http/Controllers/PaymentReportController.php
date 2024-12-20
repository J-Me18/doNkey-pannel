<?php

namespace App\Http\Controllers;

use App\Models\PaymentDetails;
use App\Models\Subscriber;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PaymentReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($request);
        $paymentDetails = PaymentDetails::with('subscriber')->latest()->get();
        $subscribermail = Subscriber::all();
        // dd($paymentDetails);
        return view('admin.paymentreport.index', ['paymentDetails' => $paymentDetails, 'subscribermail' => $subscribermail]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentDetails  $paymentDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentDetails $paymentDetail)
    {
        return view('admin.paymentreport.view', ['paymentDetail' => $paymentDetail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentDetails  $paymentDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentDetails $paymentDetail)
    {
        $subscriber = Subscriber::all();
        //    <!-- dd($subscriber); -->

        return view('admin.paymentreport.invoice', ['paymentDetail' => $paymentDetail, 'subscriber' => $subscriber]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentDetails  $paymentDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentDetails $paymentDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentDetails  $paymentDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentDetails $paymentDetail)
    {
        //
    }

    public function invoice(Request $request, PaymentDetails $paymentDetail) {}
    public function downloadPDF(Request $request, PaymentDetails $paymentDetail)
    {
        // dd($paymentDetail);
        $subscriber = Subscriber::all();
        $view = view('admin.paymentreport.pdf', ['paymentDetail' => $paymentDetail, 'subscriber' => $subscriber]);
        $html = $view->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('enable_remote', true); // This is where you enable remote resources     
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="invoice.pdf"');
    }
    //     public function downloadPDF(Request $request)
    // {
    //     // Render the Blade view with styles
    //     $html = View::make('admin.paymentreport.pdf')->render();

    //     // Create a Dompdf instance
    //     $dompdf = new Dompdf();

    //     // Load HTML content with styles
    //     $dompdf->loadHtml($html);

    //     // Set paper size and orientation
    //     $dompdf->setPaper('A4', 'portrait');

    //     // Render the PDF
    //     $dompdf->render();

    //     // Output the PDF
    //     return response($dompdf->output(), 200)
    //             ->header('Content-Type', 'application/pdf')
    //             ->header('Content-Disposition', 'inline; filename="invoice.pdf"');
    // }
}

