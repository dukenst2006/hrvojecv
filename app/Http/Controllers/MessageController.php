<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * GET ALL USER-TO-USER JOB MESSAGES
     * @param  $id
     * @return $messages
     */
    public function jobMessages($userId, $type)
    {
        // Find messages in job postings, display all messages between job poster and admin
        $messages = Message::where('type', $type)
                            ->where(function($query) use ($userId){
                                $query->where('sender_id', $userId)
                                        ->orWhere('reciever_id', $userId);
                                    })
                            ->orderBy('created_at', 'desc')
                            ->get();

        return $messages;
    }

    /**
     * STORE ADMIN JOB MESSAGE
     *
     * @param  Request $request
     * @param  $id
     * @return \Illuminate\Http\Redirect
     */
    public function storeAdminJobMessage(Request $request, $id)
    {
        // function to store admin messages in DB
        $myRole = 'admin';
        $myId = User::where('role', $myRole)->pluck('id')->get(0);

        $newJobMessage = new Message();
        $newJobMessage->type = $request->type;
        $newJobMessage->message = $request->message;
        $newJobMessage->sender_id = $id;
        $newJobMessage->reciever_id = $request->reciever;
        $newJobMessage->save();

        return redirect()->route('job_offer.show', $request->jobId)->with('status', 'Message has been sent.');
    }

    /**
     * STORE USER JOB MESSAGE
     *
     * @param  Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function storeJobMessage(Request $request, $id)
    {
        // function to stor
        $myRole = 'admin';
        $myId = User::where('role', $myRole)->pluck('id')->get(0);

        $newJobMessage = new Message();
        $newJobMessage->type = $request->type;
        $newJobMessage->message = $request->message;
        $newJobMessage->sender_id = $id;
        $newJobMessage->reciever_id = $myId;
        $newJobMessage->save();

        return redirect()->route('userJobShow', $request->jobId);
    }

    /**
     *  SHOW CONTACT PAGE WITH MESSAGE HISTORY
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showContactForm($id)
    {
        // Show messages in contact page only between logged user and Admin
        $messages = Message::where('type', 'contact')
                            ->where(function($query) use ($id){
                                $query->where('sender_id', $id)
                                        ->orWhere('reciever_id', $id);
                                    })
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('contactPage', compact('messages'));
    }


    /**
     * STORE MESSAGE FROM CONTACT FORM
     * @param  int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $myRole = 'admin';
        $myId = User::where('role', $myRole)->pluck('id')->get(0);

        $newMessage = new Message();
        $newMessage->subject = $request->subject;
        $newMessage->sender_id = $id;
        $newMessage->reciever_id = $myId;
        $newMessage->message = $request->message;
        $newMessage->subject = $request->subject;
        $newMessage->type = $request->type;
        $newMessage->save();

        return redirect()->route('contact.create', \Auth::id());
    }

    /**
     * ADMIN INDEX CONTACT MESSAGES
     *
     * @return \Illuminate\Http\Response
     */
    public function adminIndex()
    {
        $type = 'contact';
        $messages = Message::where('type', $type)->get();

        return view('admin.contactMessages', compact('messages'));
    }

    /**
     * ADMIN SEND MESSAGE
     *
     * @param  Request $requst
     * @return \Illuminate\Http\Redirect
     */
    public function adminSend(Request $request)
    {
        $newMessage = new Message();
        $newMessage->subject = $request->subject;
        $newMessage->sender_id = \Auth::id();
        $newMessage->reciever_id = $request->reciever;
        $newMessage->message = $request->message;
        $newMessage->subject = $request->subject;
        $newMessage->type = $request->type;
        $newMessage->save();

        return redirect()->route('contact.msg.index');
    }
}
