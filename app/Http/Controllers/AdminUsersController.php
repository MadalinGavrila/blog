<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->checkRole('admin')){
            $users = User::orderBy('created_at', 'desc')->paginate(8);

            return view('admin.users.index', compact('users'));
        }

        return view('admin.users.index');
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
        if(Auth::user()->checkRole('admin')){
            $user = User::findOrFail($id);

            $roles = Role::pluck('name', 'id')->all();

            return view('admin.users.edit', compact('user', 'roles'));
        }

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
        if(Auth::user()->checkRole('admin')){
            $this->validate($request, [
                'name' => 'required|string|max:50',
                'role_id' => 'required',
                'is_active' => 'required',
                'photo_id' => 'mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $user = User::findOrFail($id);

            $input = $request->all();

            if($file = $request->file('photo_id')) {
                $name = time() . $file->getClientOriginalName();

                $file->move('images', $name);

                $photo = Photo::create(['file'=>$name]);

                $input['photo_id'] = $photo->id;
            }

            $user->update($input);

            $request->session()->flash('users_status', 'User has been updated !');

            return redirect('/admin/users');
        }

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
        if(Auth::user()->checkRole('admin')){
            $user = User::findOrFail($id);

            if($user->photo){
                unlink(public_path() . $user->photo->file);

                $user->photo()->delete();
            }

            $user->delete();

            $request->session()->flash('users_status', 'User has been deleted !');

            return redirect('/admin/users');
        }

        return redirect()->back();
    }
}
