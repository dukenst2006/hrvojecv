<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Controller;
use App\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{

    /*public function __construct()
    {
        $this->middleware('user', ['only' => 'index']);
    }*/


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $educationData = Education::all();
        
        return view('cv.education.index', compact('educationData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cv.education.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $educationData = $request->all();

        $newEducation = new Education();

        $newEducation->institution = $educationData['institute'];
        $newEducation->title = $educationData['title'];
        $newEducation->period = $educationData['period'];
        $newEducation->add_info = $educationData['addInfo'];
        $newEducation->accomplishments = $educationData['accomplishments'];

        $newEducation->save();


        return redirect()->route('education.index')->with('status', 'Education added!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $educationData = Education::find($id);
        return view('cv.education.edit', compact('educationData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $educationData = $request->all();

        $education = Education::find($id);
        $education->institute = $educationData['institute'];
        $education->title = $educationData['title'];
        $education->period = $educationData['period'];
        $education->add_info = $educationData['addInfo'];
        $education->accomplishments = $educationData['accomplishments'];

        $education->save();

        return redirect()->route('education.index')->with('status', 'Education edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eeducationDelete = Education::find($id);
        $educationDelete->delete();

        return redirect()->route('education.index')->with('status', 'Education deleted!');
    }
}
