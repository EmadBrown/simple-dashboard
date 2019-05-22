<?php

namespace App\Listeners;

use App\Events\ContactSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactSent as ContactSentMail;


class SendContactNotification
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
        Mail::to($event->contact->email)
                ->send(new ContactSentMail($event->contact));
    }
}
