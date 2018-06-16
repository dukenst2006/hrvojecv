<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Mail\LoginDetailsEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class AccessController extends Controller
{
    /**
     * Intercept incoming request and handle it. If success, store new user and
     * send him email with login details
     *
     * @return \Illuminate\Http\Response
     */
    public function incomingRequest(Request $request)
    {
        $accessRequestData = $request->all();

        $validatedData = Validator::make($accessRequestData, [
            'name' => 'required|min:3|max:35',
            'email' => 'required|email|unique:users',
            'address' => 'required|min:3|max:50',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $password = str_random(8);

        $newUser = new User();
        $newUser->name = $accessRequestData['name'];
        $newUser->email = $accessRequestData['email'];
        $newUser->address = $accessRequestData['address'];
        $newUser->company = $accessRequestData['company'];
        $newUser->password = bcrypt($password);
        $newUser->role = 'user';
        $newUser->hash = $this->giveHash();
        $store = $newUser->save();

        if(!$store){
            Session::flash('message', 'failure');
            return view('accessResponse');
        }

        $dataForEmail = User::find($newUser->id);
        $this->sendRegistrationEmail($dataForEmail, $password);

        Session::flash('message', 'success');
        return view('accessResponse');

    }

    /**
     *  Give each user unique hash string for the login
     *
     * @return var $hash
     */
    public static function giveHash()
    {
        // toggle new hash if generated exists
        do{
            $hash = md5(str_random(20));
            $compareHash = User::where('hash', $hash)->count();
        }
        while ($compareHash != 0);

        return $hash;
    }

    /**
     *  Send newly registered user email with login credentials
     *  Note: Resolve this the proper way!
     *
     * @param  $dataForEmail
     * @param  $password
     * @return HTTP_STATUS_CODE
     */
    public function sendRegistrationEmail($dataForEmail, $password)
    {
        Mail::to($dataForEmail->email)->send(new LoginDetailsEmail($dataForEmail, $password));

        return 200;
    }

    /**
     *  Send "forgotten login details" email
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function sendForgottenLoginData(Request $request)
    {
        // Validate entered email
        $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

        if($validator->fails())
        {
            return redirect('/')->withErrors($validator);
        }

        // querry user if found by email
        $dataForEmail = User::where('email', $request->email)->first();

        // if querry returns no data, return fail
        if($dataForEmail == NULL)
        {
            Session::flash('message', 'failure');
            return redirect('/');
        }

        // Generate new password
        $password = str_random(8);

        // store new password
        $dataForEmail->password = bcrypt($password);
        $dataForEmail->save();

        // Send email with the new data
        $this->sendRegistrationEmail($dataForEmail, $password);

        Session::flash('message', 'success');

        return view('lostLoginData');
    }
}
