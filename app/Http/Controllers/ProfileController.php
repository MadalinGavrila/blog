<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Rules\OldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        return view('profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    public function change_password()
    {
        $user = Auth::user();

        return view('profile.change_password', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if(trim($request->email) == $user->email){
            $this->validate($request, [
                'name' => 'required|string|max:50',
                'photo_id' => 'mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $input = $request->except('email');
        } else {
            $this->validate($request, [
                'name' => 'required|string|max:50',
                'photo_id' => 'mimes:jpeg,png,jpg,gif|max:2048',
                'email' => 'required|string|email|max:255|unique:users'
            ]);

            $input = $request->all();
        }

        if($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $user->update($input);

        $request->session()->flash('profile_status', 'Profile has been updated !');

        return redirect('/profile');
    }

    public function update_password(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'old_password' => ['required', new OldPassword],
            'password' => 'required|string|min:6|confirmed'
        ]);

        $input = $request->all();

        $input['password'] = Hash::make($request->password);

        $user->update($input);

        $request->session()->flash('profile_status', 'Password has been changed !');

        return redirect('/profile');
    }

}
