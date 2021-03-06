<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentReply;
use App\Notifications\ReplyPosted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->back();
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

    public function storeReply(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
            'comment_id' => 'required'
        ]);

        $user = Auth::user();

        $data = [
            'user_id' => $user->id,
            'comment_id' => $request->comment_id,
            'body' => $request->body
        ];

        $commentReply = CommentReply::create($data);

        $commentReply->comment->post->user->notify(new ReplyPosted($commentReply));

        $request->session()->flash('comment_message', 'Your reply has been submitted and is waiting moderation');

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
            $comment = Comment::findOrFail($id);
        } else {
            $comment = $user->postComments()->findOrFail($id);
        }

        $replies = $comment->replies()->orderBy('created_at', 'desc')->paginate(8);

        return view('admin.comments.replies.show', compact('replies'));
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
        CommentReply::findOrFail($id)->update($request->all());

        $request->session()->flash('replies_status', 'Reply has been updated !');

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
        CommentReply::findOrFail($id)->delete();

        $request->session()->flash('replies_status', 'Reply has been deleted !');

        return redirect()->back();
    }
}
