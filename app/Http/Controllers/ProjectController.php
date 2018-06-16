<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\Facades\Image;

class ProjectController extends Controller
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
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $projectData = $request->all();

        $newProject = new Project();
        $newProject->name = $projectData['projectName'];
        $newProject->type = $projectData['type'];
        $newProject->company = $projectData['company'];
        $newProject->url = $projectData['url'];
        $newProject->technology = $projectData['technology'];
        $newProject->description = $projectData['desc'];
        /// storing image
        if($request->hasFile('logo'))
        {
            $image = $request->file('logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('project_logos/' . $filename);
            Image::make($image)->resize(345, 260, function($image) {
                $image->aspectRatio();
                $image->upsize();
            })->save($location, 100);

            $newProject->logo = $filename;
        }

        $store = $newProject->save();

        if(!$store)
        {
            return redirect()->route('projects.index')->with('status', 'New project NOT stored!');
        }

        return redirect()->route('projects.index')->with('status', 'New project stored!');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('projects.edit', compact('project'));
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
        $projectData = $request->all();

        $newProject = Project::findOrFail($id);
        $newProject->name = $projectData['projectName'];
        $newProject->type = $projectData['type'];
        $newProject->company = $projectData['company'];
        $newProject->url = $projectData['url'];
        $newProject->technology = $projectData['technology'];
        $newProject->description = $projectData['desc'];
        /// storing image
        if($request->hasFile('logo'))
        {
            $image = $request->file('logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('project_logos/' . $filename);
            Image::make($image)->resize(345, 260, function($image) {
                $image->aspectRatio();
                $image->upsize();
            })->save($location, 100);

            $newProject->logo = $filename;
        }

        $store = $newProject->save();

        if(!$store)
        {
            return redirect()->route('projects.index')->with('status', 'Project NOT updated!');
        }

        return redirect()->route('projects.index')->with('status', 'Project updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteProject = Project::findOrFail($id);
        $deleteProject->delete();

        return redirect()->route('projects.index')->with('status', 'Project deleted successfully!');
    }
}
