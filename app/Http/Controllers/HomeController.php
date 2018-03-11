<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(4);

        $categories = Category::all();

        return view('front.index', compact('posts', 'categories'));
    }

    public function contact()
    {
        $categories = Category::all();

        return view('front.contact', compact('categories'));
    }

    public function post($slug)
    {
        $post = Post::findBySlugOrFail($slug);

        $categories = Category::all();

        return view('front.post', compact('post', 'categories'));
    }

    public function postsCategory($category_slug)
    {
        $posts = Category::findBySlugOrFail($category_slug)->posts()->orderBy('created_at', 'desc')->paginate(4);

        $categories = Category::all();

        return view('front.index', compact('posts', 'categories'));
    }

    public function postsUser($user_slug)
    {
        $posts = User::findBySlugOrFail($user_slug)->posts()->orderBy('created_at', 'desc')->paginate(4);

        $categories = Category::all();

        return view('front.index', compact('posts', 'categories'));
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
