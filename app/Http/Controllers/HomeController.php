<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function index()
    {
        return view('front.index');
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function sendMail(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'message' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'text' => $request->message
        ];

        Mail::send('emails.contact', $data, function($message){
            $message->to('madalin.gavrila13@yahoo.com', 'Madalin Gavrila')->subject('Contact');
        });

        $request->session()->flash('contact_mail', 'Your message was sent !');

        return redirect('/contact');
    }

}
