<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Quote extends Mailable
{
    use Queueable, SerializesModels;

    public $admin_name;
    public $datas;
    public $user_name;
    public $url_redirection;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin_name, $user_name, array $datas, $url_redirection)
    {
        $this->admin_name = $admin_name;
        $this->datas = $datas;
        $this->user_name = $user_name;
        $this->url_redirection = $url_redirection;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.quote');
    }
}
