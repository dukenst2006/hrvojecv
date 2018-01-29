<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginDetailsEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $dataForEmail;
    private $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataForEmail, $password)
    {
        $this->dataForEmail = $dataForEmail;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dataForEmail = $this->dataForEmail;
        $password = $this->password;
        return $this->view('emails.loginDetails', compact('dataForEmail', 'password'))
                    ->subject('Login details for Hrvoje Zubcic CV');
    }
}
