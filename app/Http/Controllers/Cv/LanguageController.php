<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Controller;
use App\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
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
        $langData = Language::all();

        return view('cv.languages.index', compact('langData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cv.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $langData = $request->all();

        $newLang = new Language();

        $newLang->title = $langData['langTitle'];
        $newLang->writing = $langData['langWriting'];
        $newLang->understanding = $langData['langUnderstanding'];
        $newLang->speach = $langData['langSpeaking'];

        $newLang->save();


        return redirect()->route('language.index')->with('status', 'Language added!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $langData = Language::find($id);

        return view('cv.languages.edit', compact('langData'));
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
        $langData = $request->all();

        $lang = Language::find($id);
        $lang->title = $langData['langTitle'];
        $lang->writing = $langData['langWriting'];
        $lang->understanding = $langData['langUnderstanding'];
        $lang->speach = $langData['langSpeaking'];

        $lang->save();

        return redirect()->route('language.index')->with('status', 'Language edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroyLang = Language::find($id);
        $destroyLang->delete();

        return redirect()->route('language.index')->with('status', 'Language deleted!');
    }
}
