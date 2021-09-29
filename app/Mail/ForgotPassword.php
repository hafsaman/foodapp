<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $otp)
    {
        $this->user = $user;
        $this->otp = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('dilpreet.seraphic@gmail.com')
                    ->subject('Forgot Password Email')
                    ->view('emails.forgotpassword')
                    ->with(
                      [
                            'user_name' => $this->user,
                            'otp_send' => $this->otp,
                      ]);
    }
}
