<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Revision extends Mailable
{
    use Queueable, SerializesModels;

    public $email_user;
    public $user_name;
    public $url;
    public $order_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_user, $user_name, $url, $order_id)
    {
        $this->email_user = $email_user;
        $this->user_name = $user_name;
        $this->url = $url;
        $this->url = $order_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.revision');
    }
}
