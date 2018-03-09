<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        $usersCount = User::count();
        $categoriesCount = Category::count();
        $postsCount = Post::count();
        $commentsCount = Comment::count();

        return view('admin.index', compact('usersCount', 'categoriesCount', 'postsCount', 'commentsCount'));
    }

}
