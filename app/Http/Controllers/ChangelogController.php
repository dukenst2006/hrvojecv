<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Changelog;
use Validator;

class ChangelogController extends Controller
{
    public function index()
    {
    	$changelog = Changelog::all();

    	return view('changelog', compact('changelog'));
    }

    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'title' => 'required|min:3|max:25',
    		'desc' => 'required|min:3|max:150',
    		'changes' => 'required|min:3|max:255'
    	]);

    	if($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	}

    	$newChangelog = new Changelog();
    	$newChangelog->title = $request->title;
    	$newChangelog->description = $request->desc;
    	$newChangelog->changes = $request->changes;
    	$saved = $newChangelog->save();

    	if(!$saved) {
    		return redirect()->route('changelog.index')->with('status', 'Entry not stored!');
    	}

    	return redirect()->route('changelog.index')->with('status', 'Entry successfully stored!');
    }

    public function destroy($id)
    {
    	$changelog = Changelog::findOrFail($id);
    	$changelog->delete();

    	return redirect()->route('changelog.index');
    }

    public function edit($id)
    {
    	$changelog = Changelog::findOrFail($id);

    	return view('changelogEdit', compact('changelog'));
    }

    public function update(Request $request, $id)
    {
    	$validator = Validator::make($request->all(), [
    		'title' => 'required|min:3|max:25',
    		'desc' => 'required|min:3|max:150',
    		'changes' => 'required|min:3|max:255'
    	]);

    	if($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	}

    	$newChangelog = Changelog::findOrFail($id);
    	$newChangelog->title = $request->title;
    	$newChangelog->description = $request->desc;
    	$newChangelog->changes = $request->changes;
    	$saved = $newChangelog->save();

    	if(!$saved) {
    		return redirect()->route('changelog.index')->with('status', 'Entry not stored!');
    	}

    	return redirect()->route('changelog.index')->with('status', 'Entry successfully stored!');
    }
}
