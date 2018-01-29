<?php

namespace App\Http\Controllers;

use App\DownloadSource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DownloadSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = DownloadSource::all();

        return view('downloads.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('downloads.create');
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
            'title' => 'required|min:3',
            'desc' => 'required|min:3|max:30',
            'file' => 'required|max:10000'

        ]);

        if($validator->fails())
        {
            return redirect()->back()->with($errors)->withInput();
        }

        $file = $request->file;

        $extension = $request->file->getClientOriginalExtension();
        //// get extension
        $filename = $request->title . '-' . Carbon::now()->toDateString() . '.' . $extension;
        //// e.g. Data-29012018.pdf
        $path = 'source_download';
        //path, project/public/source_download
    
        $file->move($path, $filename);


        $newFile = new DownloadSource();
        $newFile->title = $request->title;
        $newFile->desc = $request->desc;
        $newFile->file_name = $filename;
        $newFile->save();


        
        return redirect()->route('downloads.index');


    }

    public function downloadFile($filename)
    {
        $file = 'source_download/'.$filename;

        return response()->download($file);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DownloadSource  $downloadSource
     * @return \Illuminate\Http\Response
     */
    public function destroy($filename)
    {
        $file = public_path() . '\\' . 'source_download\\' . $filename;
        $a = File::delete($file);

        dd($a);

        return redirect()->route('downloads.index');
    }
}
