<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Order extends Mailable
{
    use Queueable, SerializesModels;
    use Queueable, SerializesModels;

    public $message;
    public $user_name;
    public $email_user;
    public $url_redirection;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message, $user_name, $email_user, $url_redirection)
    {
        $this->message = $message;
        $this->user_name = $user_name;
        $this->email_user = $email_user;
        $this->url_redirection = $url_redirection;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.order');
    }
}
