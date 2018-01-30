<?php

namespace App\Http\Controllers;

use App\DownloadSource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
        $tempFilename = $request->title;
        //// get extension
        $filename = $tempFilename . '-' . Carbon::now()->toDateString() . '.' . $extension;
        //// e.g. fileTIt-29012018.pdf
        
        $file->storeAs('source_files', $filename);

        $newFile = new DownloadSource();
        $newFile->title = $request->title;
        $newFile->desc = $request->desc;
        $newFile->file_name = $filename;
        $newFile->save();
        
        return redirect()->route('downloads.index');
    }

    public function downloadFile($filename)
    {
        return response()->download(public_path().'/storage/source_files/'.$filename);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DownloadSource  $downloadSource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $filename)
    {
        $filePath = public_path().'/storage/source_files/'.$filename;

        if (is_file($filePath)) {
           $delete = unlink($filePath);
            if (!$delete) {
                return redirect()->route('downloads.index')->with('status', 'Can\'t delete file');
            }
        } elseif(!$filePath) {
            return redirect()->route('downloads.index')->with('status', 'File not found!');
        }

        $deleteFromDb = DownloadSource::findOrFail($request->id);
        $deleteFromDb->delete();

        return redirect()->route('downloads.index')->with('status', 'File successfully deleted.');
    }
}
