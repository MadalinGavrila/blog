<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPhotosController extends Controller
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
            $photos = Photo::orderBy('created_at', 'desc')->paginate(8);

            return view('admin.photos.index', compact('photos'));
        } else {
            $posts_photo = $user->posts()->has('photo')->orderBy('created_at', 'desc')->paginate(8);

            return view('admin.photos.other_index', compact('posts_photo'));
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
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->back();
    }

    public function deletePhoto(Request $request)
    {
        if(isset($request->submit) && !empty($request->checkBoxArray)){
            if($request->options == 'delete') {
                $photos = Photo::findOrFail($request->checkBoxArray);

                foreach($photos as $photo){
                    unlink(public_path() . $photo->file);

                    $photo->delete();
                }

                return redirect()->back();
            }
        }

        return redirect()->back();
    }

}
