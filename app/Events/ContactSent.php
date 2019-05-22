<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;


class ContactSent
{
    use Dispatchable, SerializesModels;

    public  $contact;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        $this->contact =  $contact;
    }

}
