<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $subscriber;
    protected $payemntDetails;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct($data)
    {
        // dd($data);
        // Extracting data into individual variables
        $this->subscriber = $data['subscriber'];
        $this->payemntDetails = $data['payemntDetails'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->payemntDetails);
        $subscriber = $this->subscriber;
        $paymentDetails = $this->payemntDetails;
        // dd("build", $paymentDetails);
        return $this->view('subscriber.invoicemail', ['subscriber' => $subscriber, 'paymentDetail' => $paymentDetails->load('subscriber')]);
    }
}
