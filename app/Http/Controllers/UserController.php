<?php

namespace App\Http\Controllers;

use App\LoginHistory;
use Validator;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        //$this->middleware('user', ['only' => ['show', 'changePassword', 'userEditPassword']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        AccessController::giveHash();
        $allUsers = LoginHistory::getAllUsersWithLastLogin();

        return view('admin.users.index', compact('allUsers'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:35',
            'email' => 'required|email',
            'address' => 'required|min:3|max:35',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $updateUser = User::find($id);
        $updateUser->name = $request->name;
        $updateUser->email = $request->email;
        $updateUser->address = $request->address;
        $updateUser->company = $request->company;
        $save = $updateUser->save();

        if(!$save)
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        return redirect()->route('home')->with('status', 'Profile updated!');
    }

    public function userEditPassword($id)
    {
        return view('users.editPassword');
    }

    /**
     * Change Authed user password
     *
     * @param  Request $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request, $id)
    {
        $password = $request->all();

        $validator = Validator::make($password, [
            'password' => 'required|confirmed|min:8',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $changePass = User::find($id);
        $changePass->password = bcrypt($password['password']);
        $changePass->save();

        return redirect()->route('home');
    }
}
