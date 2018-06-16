<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Changelog;
use Validator;

class ChangelogController extends Controller
{
    /**
     * list all records
     * @return view
     */
    public function index()
    {
        // get all changelog data from DB to list in view
    	$changelog = Changelog::all();

    	return view('changelog', compact('changelog'));
    }

    /**
     * Store new record
     * @param  Request $request
     * @return redirect
     */
    public function store(Request $request)
    {
        // Validate input data (desc and changes not required as it may be blank)
    	$validator = Validator::make($request->all(), [
    		'title' => 'required|min:3|max:25'
    	]);

        // If validation fails, return validation errors with pre-entered inputs
    	if($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	}

        // If validation passes, store new record in DB
    	$newChangelog = new Changelog();
    	$newChangelog->title = $request->title;
    	$newChangelog->description = $request->desc;
    	$newChangelog->changes = $request->changes;
    	$saved = $newChangelog->save();

        // If saving failed, return error to admin
    	if(!$saved) {
    		return redirect()->route('changelog.index')->with('status', 'Entry not stored!');
    	}

        // else return redirect to index with status OK
    	return redirect()->route('changelog.index')->with('status', 'Entry successfully stored!');
    }

    /**
     * Delete record
     * @param  $id
     * @return redirect
     */
    public function destroy($id)
    {
        // Find changelog record in DB by id and delete if found
    	$changelog = Changelog::findOrFail($id);
    	$changelog->delete();

    	return redirect()->route('changelog.index');
    }

    /**
     * Edit record
     * @param  $id
     * @return view
     */
    public function edit($id)
    {
        // Find changelog record in DB by id and return edit form with pre-entered inputs from model
    	$changelog = Changelog::findOrFail($id);

    	return view('changelogEdit', compact('changelog'));
    }

    /**
     * Update record
     * @param  Request $request
     * @param  $id
     * @return redirect
     */
    public function update(Request $request, $id)
    {
        // Validate input from form (also, desc and changes not required as they may be blank)
    	$validator = Validator::make($request->all(), [
    		'title' => 'required|min:3|max:25'
    	]);

        // If validation fails, return validation errors with pre-entered inputs
    	if($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	}

        // else update changelog record by id
    	$newChangelog = Changelog::findOrFail($id);
    	$newChangelog->title = $request->title;
    	$newChangelog->description = $request->desc;
    	$newChangelog->changes = $request->changes;
    	$saved = $newChangelog->save();

        // If there's a problem with DB update, return error to admin
    	if(!$saved) {
    		return redirect()->route('changelog.index')->with('status', 'Entry not stored!');
    	}

        // else, store and redirect to index with status OK
    	return redirect()->route('changelog.index')->with('status', 'Entry successfully stored!');
    }
}
