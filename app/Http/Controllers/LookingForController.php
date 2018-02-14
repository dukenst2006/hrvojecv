<?php

namespace App\Http\Controllers;

use App\LookingFor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LookingForController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lookingFor = LookingFor::all();

        return view('jobs.lookingFor.index', compact('lookingFor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs.lookingFor.create');
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
            'description' => 'required|min:3|max:10000'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newLookingFor = new LookingFor();
        $newLookingFor->desc = $request->description;
        $newLookingFor->save();

        return redirect()->route('looking_for.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lookingFor = LookingFor::findOrFail($id);

        return view('jobs.lookingFor.edit', compact('lookingFor'));
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
        $validator = Validator::make($request->all(), [
            'description' => 'required|min:3|max:10000'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $updateLookingFor = LookingFor::findOrFail($id);
        $updateLookingFor->desc = $request->description;
        $updateLookingFor->save();

        return redirect()->route('looking_for.index');
    }
}
