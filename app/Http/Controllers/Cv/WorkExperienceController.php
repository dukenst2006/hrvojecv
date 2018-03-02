<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Controller;
use App\WorkExperience;
use Illuminate\Http\Request;

class WorkExperienceController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('user', ['only' => ['index', 'show']]);
    }*/


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allJobs = WorkExperience::all()->orderByDesc('work_from');

        return view('cv.workExperience.index', compact('allJobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cv.workExperience.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $workExpData = $request->all();

        $newWorkExp = new WorkExperience();

        $newWorkExp->company = $workExpData['company'];
        $newWorkExp->sector = $workExpData['sector'];
        $newWorkExp->address = $workExpData['address'];
        $newWorkExp->work_from = $workExpData['workFrom'];
        $newWorkExp->work_to = $workExpData['workTo'];
        $newWorkExp->position = $workExpData['position'];
        $newWorkExp->desc  = $workExpData['desc'];
        $newWorkExp->currently_employed = $workExpData['currentlyEmployed'];

        $newWorkExp->save();


        return redirect()->route('work_experience.index')->with('status', 'Job added!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RadnoIskustvo  $radnoIskustvo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workExpData = WorkExperience::find($id);

        return view('cv.workExperience.edit', compact('workExpData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $workExpData = $request->all();

        $updateJob = WorkExperience::find($id);

        $updateJob->company = $workExpData['company'];
        $updateJob->sector = $workExpData['sector'];
        $updateJob->address = $workExpData['address'];
        $updateJob->work_from = $workExpData['workFrom'];
        $updateJob->work_to = $workExpData['workTo'];
        $updateJob->position = $workExpData['position'];
        $updateJob->desc  = $workExpData['desc'];
        $updateJob->currently_employed = $workExpData['currentlyEmployed'];

        $updateJob->save();

        return redirect()->route('work_experience.index')->with('status', 'Job edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkExperience  $workExperience
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroyJob = WorkExperience::findOrFail($id);
        $destroyJob->delete();

        return redirect()->route('work_experience.index')->with('status', 'Job deleted!');
    }
}
