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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message, $user_name)
    {
        $this->message = $message;
        $this->user_name = $user_name;
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