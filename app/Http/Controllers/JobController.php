<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MessageController;
use App\Models\Job;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::all();

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hasJob = Job::where('user_id', \Auth::id())->get();

        if (count($hasJob) > 0) {
            return redirect()->route('userJobShow', $hasJob[0]->id)->with('status', 'You already have a job posting in progress!');
        }

        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:30',
            'mainLanguage' => 'required|min:2|max:30',
            'requiredFw' => 'required|min:2|max:50',
            'yearsExp' => 'required',
            'contract' => 'required',
            'salaryRange' => 'required',
            'remote' => 'required',
            'location' => 'required|min:2|max:30'
        ]);

        if($validator->fails()){
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $newJob = Job::create($request->all());

        if(!$newJob){
            return redirect()
                    ->back()
                    ->withErrors()
                    ->withInput();
        }

        return redirect()
                ->route('home')
                ->with('status', 'Job offer posted successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::findOrFail($id);

        $type = 'job';
        $recieverId = $job->user_id;

        $messages = new MessageController();
        $getMessages = $messages->jobMessages($id, $type);


        return view('jobs.show', compact('job', 'getMessages'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->responded = 1;
        $job->save();

        return redirect()->route('job_offer.index')->with('status', 'Marked responded!');
    }

    public function userJobShow($id)
    {
        $job = Job::findOrFail($id);

        $userId = \Auth::id();
        $type = 'job';

        $messages = new MessageController();
        $getMessages = $messages->jobMessages($userId, $type);

        return view('jobs.userJobShow', compact('job', 'getMessages'));
    }

    /**
     * If Admin changes Job stats, send Authed user notification via Messages
     * that is has been changed.
     *
     * @param  Request $request
     * @param  $id
     * @return Response
     */
    public function toggleStatus(Request $request, $id)
    {
        $changeStatus = Job::find($id);
        $changeStatus->status = $request->status;
        $changeStatus->save();

        $message = new Message();
        $message->sender_id = \Auth::id();
        $message->reciever_id = $changeStatus->user->id;
        $message->type = 'job';
        $message->message = 'Your job status has been changed to '.$changeStatus->status;
        $message->save();

        return redirect()->route('job_offer.index')->with('status', 'Job status changed.');
    }
}
