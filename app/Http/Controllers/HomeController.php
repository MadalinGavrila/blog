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

        $recent_posts = Post::orderBy('created_at', 'desc')->take(5)->get();

        return view('front.index', compact('posts', 'categories', 'recent_posts'));
    }

    public function contact()
    {
        $categories = Category::all();

        $recent_posts = Post::orderBy('created_at', 'desc')->take(5)->get();

        return view('front.contact', compact('categories', 'recent_posts'));
    }

    public function post($slug)
    {
        $post = Post::findBySlugOrFail($slug);

        $categories = Category::all();

        $recent_posts = Post::orderBy('created_at', 'desc')->take(5)->get();

        return view('front.post', compact('post', 'categories', 'recent_posts'));
    }

    public function postsCategory($category_slug)
    {
        $posts = Category::findBySlugOrFail($category_slug)->posts()->orderBy('created_at', 'desc')->paginate(4);

        $categories = Category::all();

        $recent_posts = Post::orderBy('created_at', 'desc')->take(5)->get();

        return view('front.index', compact('posts', 'categories', 'recent_posts'));
    }

    public function postsUser($user_slug)
    {
        $posts = User::findBySlugOrFail($user_slug)->posts()->orderBy('created_at', 'desc')->paginate(4);

        $categories = Category::all();

        $recent_posts = Post::orderBy('created_at', 'desc')->take(5)->get();

        return view('front.index', compact('posts', 'categories', 'recent_posts'));
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required'
        ]);

        $posts = Post::where('title', 'LIKE', '%' . $request->search . '%')->orderBy('created_at', 'desc')->paginate(4);

        $categories = Category::all();

        $recent_posts = Post::orderBy('created_at', 'desc')->take(5)->get();

        return view('front.search', compact('posts', 'categories', 'recent_posts'));
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
