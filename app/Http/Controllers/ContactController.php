<?php

namespace App\Http\Controllers;

use function App\flash;
use App\Http\Requests\ContactRequest;
use App\Contact;

class ContactController extends Controller
{

    public function index()
    {
        $title = 'Contact Us';
        return view('pages.contact')->with('title', $title);
    }


    public function store(ContactRequest $request)
    {
        $contact = new Contact();
        $contact->fill($request->validated());
        $contact->save();


        flash('Your message has been successfully sent');
        return redirect()->route('contact');
    }
}
