<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostsRequest;
use App\Notifications\PostPublished;
use App\Photo;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->checkRole('admin')) {
            $posts = Post::orderBy('created_at', 'desc')->paginate(8);
        } else {
            $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(8);
        }

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        $input = $request->all();

        $user = Auth::user();

        if($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $post = $user->posts()->create($input);

        $users = User::where('is_active', 1)->get();

        foreach($users as $admin){
            if($admin->checkRole('admin')) {
                $admin->notify(new PostPublished($post));
            }
        }

        $request->session()->flash('posts_status', 'A post has been created !');

        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        if($user->checkRole('admin')){
            $post = Post::findOrFail($id);
        } else {
            $post = $user->posts()->findOrFail($id);
        }

        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsRequest $request, $id)
    {
        $user = Auth::user();

        if($user->checkRole('admin')){
            $post = Post::findOrFail($id);
        } else {
            $post = $user->posts()->findOrFail($id);
        }

        $input = $request->all();

        if($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $post->update($input);

        $request->session()->flash('posts_status', 'Post has been updated !');

        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = Auth::user();

        if($user->checkRole('admin')) {
            $post = Post::findOrFail($id);
        } else {
            $post = $user->posts()->findOrFail($id);
        }

        if($post->photo){
            unlink(public_path() . $post->photo->file);

            $post->photo()->delete();
        }

        $post->delete();

        $request->session()->flash('posts_status', 'Post has been deleted !');

        return redirect('/admin/posts');
    }
}
