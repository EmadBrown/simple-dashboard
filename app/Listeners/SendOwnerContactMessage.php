<?php

namespace App\Listeners;

use App\Events\ContactSent;
use App\Mail\SentOwnerContactMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendOwnerContactMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ContactSent  $event
     * @return void
     */
    public function handle(ContactSent $event)
    {
        Mail::to("info@VadaCorp.com")
            ->send(new SentOwnerContactMessage($event->contact));
    }
}
