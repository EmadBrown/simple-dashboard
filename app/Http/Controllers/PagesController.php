<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $title = 'Welcome To My Salon';
        return view('pages.index')->with('title',$title);
    }

    public function services()
    {
        $data = array
        (
            'title' => 'services',
            'services' => ['Haircuts', 'washing and setting' , 'Dyeing and colouration', 'weave fixing']
        );
        $title = 'Services';
        return view('pages.services')->with($data);
    }

}
