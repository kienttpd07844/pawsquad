<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $resetLink;

    public function __construct($resetLink)
    {
        $this->resetLink = $resetLink;
    }
    public function build()
    {
        return $this->view('clients.emails.forgotpassword')
            ->with([
                'resetUrl' => $this->resetLink,
            ])->subject('Thay đổi mật khẩu tại ' . env('APP_NAME'));
    }
}
