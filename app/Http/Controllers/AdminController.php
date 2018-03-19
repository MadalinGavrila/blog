<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
        $usersCount = User::count();
        $categoriesCount = Category::count();
        $postsCount = Post::count();
        $commentsCount = Comment::count();

        $user = Auth::user();

        return view('admin.index', compact('usersCount', 'categoriesCount', 'postsCount', 'commentsCount', 'user'));
    }

}
