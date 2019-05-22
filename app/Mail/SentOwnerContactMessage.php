<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SentOwnerContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;


    /**
     * SentOwnerContactMessage constructor.
     * @param $contact
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@VadaCorp.com')
            ->subject('VadaCorp contact Form')
            ->markdown('emails.contact-owner');
    }
}
