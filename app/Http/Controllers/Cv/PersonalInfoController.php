<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Controller;
use App\Models\PersonalInfo;
use Illuminate\Http\Request;

class PersonalInfoController extends Controller
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
        $myself = PersonalInfo::all();

        return view('cv.personalInfo.index', compact('myself'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cv.personalInfo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $personalInfoData = $request->all();

        $newPersonalInfo = new OsobniPodaci;

        $newPersonalInfo->name = $personalInfoData['name'];
        $newPersonalInfo->surname = $personalInfoData['surname'];
        $newPersonalInfo->gender = $personalInfoData['gender'];
        $newPersonalInfo->key_skills = $personalInfoData['keySkills'];
        $newPersonalInfo->dob = $personalInfoData['dob'];
        $newPersonalInfo->pob = $personalInfoData['pob'];
        $newPersonalInfo->current_residence = $personalInfoData['currentResidence'];
        $newPersonalInfo->street = $personalInfoData['street'];
        $newPersonalInfo->house_no = $personalInfoData['houseNo'];
        $newPersonalInfo->postcode = $personalInfoData['postcode'];
        $newPersonalInfo->state = $personalInfoData['state'];
        $newPersonalInfo->tel = $personalInfoData['tel'];
        $newPersonalInfo->mob = $personalInfoData['mob'];
        $newPersonalInfo->email = $personalInfoData['email'];
        $newPersonalInfo->skype = $personalInfoData['skype'];
        $newPersonalInfo->nationality = $personalInfoData['nationality'];
        $newPersonalInfo->position = $personalInfoData['position'];
        $newPersonalInfo->summary = $personalInfoData['summary'];

        $newPersonalInfo->save();

        return redirect()->route('personal_info.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $myself = PersonalInfo::find($id);

        return view('cv.personalInfo.edit', compact('myself'));
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
        $personalInfoData = $request->all();

        $updatePersonalInfo = PersonalInfo::find($id);

        $updatePersonalInfo->name = $personalInfoData['name'];
        $updatePersonalInfo->surname = $personalInfoData['surname'];
        $updatePersonalInfo->gender = $personalInfoData['gender'];
        $updatePersonalInfo->key_skills = $personalInfoData['keySkills'];
        $updatePersonalInfo->dob = $personalInfoData['dob'];
        $updatePersonalInfo->pob = $personalInfoData['pob'];
        $updatePersonalInfo->current_residence = $personalInfoData['currentResidence'];
        $updatePersonalInfo->street = $personalInfoData['street'];
        $updatePersonalInfo->house_no = $personalInfoData['houseNo'];
        $updatePersonalInfo->postcode = $personalInfoData['postcode'];
        $updatePersonalInfo->state = $personalInfoData['state'];
        $updatePersonalInfo->tel = $personalInfoData['tel'];
        $updatePersonalInfo->mob = $personalInfoData['mob'];
        $updatePersonalInfo->email = $personalInfoData['email'];
        $updatePersonalInfo->skype = $personalInfoData['skype'];
        $updatePersonalInfo->nationality = $personalInfoData['nationality'];
        $updatePersonalInfo->position = $personalInfoData['position'];
        $updatePersonalInfo->summary = $personalInfoData['summary'];

        $updatePersonalInfo->save();

        return redirect()->route('personal_info.index')->with('status', 'Personal data edited!');
    }
}
