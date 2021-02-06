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
    public $user_id;
    public $user_name;
    public $nb_notif;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_user, $user_id, $user_name,$nb_notif)
    {
        $this->email_user = $email_user;
        $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->nb_notif = $nb_notif;
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