<?php

namespace App\Http\Controllers;

use App\LoginHistory;
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

    public function userEditPassword($id)
    {
        return view('users.editPassword');
    }

    /**
     * 
     * @param  Request $request 
     * @param  $id     
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request, $id)
    {
        dd($request->all());
        $password = $request->all();

        $this->validate($password, [
            'password' => 'required|confirmed|min:8',
        ]);

        $changePass = User::find($id);
        $changePass->password = bcrypt($password['password']);
        $changePass->save();

        return redirect()->route('home');
    }
}
