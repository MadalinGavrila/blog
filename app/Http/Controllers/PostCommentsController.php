<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notifications\CommentPosted;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->checkRole('admin')){
            $comments = Comment::orderBy('created_at', 'desc')->paginate(8);

            return view('admin.comments.index', compact('comments'));
        } else {
            $comments = $user->postComments()->orderBy('created_at', 'desc')->paginate(8);

            $posts = $user->posts;

            return view('admin.comments.other_index', compact('comments', 'posts'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->back();
    }

    public function storeComment(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
            'post_id' => 'required'
        ]);

        $user = Auth::user();

        $data = [
            'user_id' => $user->id,
            'post_id' => $request->post_id,
            'body' => $request->body
        ];

        $comment = Comment::create($data);

        $comment->post->user->notify(new CommentPosted($comment));

        $request->session()->flash('comment_message', 'Your comment has been submitted and is waiting moderation');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        if($user->checkRole('admin')){
            $post = Post::findOrFail($id);
        } else {
            $post = $user->posts()->findOrFail($id);
        }

        $comments = $post->comments()->orderBy('created_at', 'desc')->paginate(8);

        return view('admin.comments.show', compact('comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if($user->checkRole('admin')){
            Comment::findOrFail($id)->update($request->all());
        } else {
            $user->postComments()->findOrFail($id)->update($request->all());
        }

        $request->session()->flash('comments_status', 'Comment has been updated !');

        return redirect()->back();
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

        if($user->checkRole('admin')){
            Comment::findOrFail($id)->delete();
        } else {
            $user->postComments()->findOrFail($id)->delete();
        }

        $request->session()->flash('comments_status', 'Comment has been deleted !');

        return redirect()->back();
    }
}
