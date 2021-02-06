<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageToAdmin extends Mailable
{
    use Queueable, SerializesModels;


    public $user_name;
    public $nb_notif;
    public $email_user;
    public $url_redirection;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_user, $user_name, $nb_notif,$url_redirection)
    {

        $this->user_name = $user_name;
        $this->nb_notif = $nb_notif;
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
        return $this->markdown('emails.msg_to_admin');
    }
}
