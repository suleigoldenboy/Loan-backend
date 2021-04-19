<?php

namespace App\Mail\System;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendLogMessage extends Mailable
{
    use Queueable, SerializesModels;
    protected $requestPayLoad;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->requestPayLoad = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.logger', ['log' => $this->requestPayLoad]);
    }
}
