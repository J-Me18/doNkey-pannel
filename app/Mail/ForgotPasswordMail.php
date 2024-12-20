<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
         //dd($data);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $resetLink = $this->data['resetLink'];
        $employee = $this->data['employee'];
        return $this->view('admin.password.mail', ['resetLink' => $resetLink, 'employee' => $employee]);
    }
}
