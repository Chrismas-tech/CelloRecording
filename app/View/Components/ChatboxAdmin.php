<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ChatboxAdmin extends Component
{
    public $messages;
    public $adminname;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($messages, $adminname)
    {
        $this->messages = $messages;
        $this->adminname = $adminname;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.chatbox-admin');
    }
}
