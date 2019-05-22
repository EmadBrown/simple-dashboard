<?php

namespace App;

use App\Events\ContactSent;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $dispatchesEvents = [
        'created' => ContactSent::class
    ];

    protected  $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'message'
        ];

}
