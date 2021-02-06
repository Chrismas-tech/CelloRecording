<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Delivery extends Mailable
{
    use Queueable, SerializesModels;

    public $user_name;
    public $order_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_name, $order_id)
    {
        $this->user_name = $user_name;
        $this->order_id = $order_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.delivery');
    }
}