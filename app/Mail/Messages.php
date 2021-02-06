<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Messages extends Mailable
{
    use Queueable, SerializesModels;
    
    public $admin;
    public $nb_notif;
    public $url_redirection;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin, $nb_notif,$url_redirection)
    {
        $this->admin = $admin;
        $this->nb_notif = $nb_notif;
        $this->url_redirection = $url_redirection;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.msg_to_user');
    }
}
