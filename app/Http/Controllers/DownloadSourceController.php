<?php

namespace App\Http\Controllers;

use App\Models\DownloadSource;
use App\Models\PersonalInfo;
use App\Models\WorkExperience;
use App\Models\Project;
use App\Models\Language;
use App\Models\Education;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use PDF;

class DownloadSourceController extends Controller
{
    /**
     * Display a listing of the source files.
     *
     * @return \Illuminate\Http\Response
     */
    public function sourceFilesIndex()
    {
        $type = 'sourceFile';
        $sourceFiles = DownloadSource::where('type', $type)->get();

        return view('downloads.index', compact('sourceFiles'));
    }

    /**
     * Display a listing of screenshots.
     *
     * @return \Illuminate\Http\Response
     */
    public function screenshotsIndex()
    {
        $type = 'screenshot';
        $screenshots = DownloadSource::where('type', $type)->get();

        return view('screenshots.index', compact('screenshots'));
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
            'desc' => 'required|min:3|max:50',
            'file' => 'required|max:10000'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file;
        $type = $request->type;

        $extension = $request->file->getClientOriginalExtension();
        $tempFilename = str_replace(' ', '', $request->title);
        //// get extension
        $filename = $tempFilename . '-' . Carbon::now()->toDateString() . '.' . $extension;
        //// e.g. fileTIt-29012018.pdf

        $file->storeAs($type, $filename);

        $newFile = new DownloadSource();
        $newFile->title = $request->title;
        $newFile->desc = $request->desc;
        $newFile->file_name = $filename;
        $newFile->type = $type;
        $newFile->save();

        if($type == 'sourceFile'){
            return redirect()->route('files.index');
        }

        return redirect()->route('screenshots.index');
    }

    public function downloadFile($filename, $type)
    {
        return response()->download(public_path().'/storage'.'/'.$type.'/'.$filename);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DownloadSource  $downloadSource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $filename)
    {
        $type = $request->type;
        $filePath = public_path().'/storage'.'/'.$type.'/'.$filename;

        if (is_file($filePath)) {
           $delete = unlink($filePath);
            if (!$delete && $type == 'sourceFile') {
                return redirect()->route('files.index')->with('status', 'Can\'t delete file');
            } elseif(!$delete && $type == 'screenshot') {
                return redirect()->route('screenshots.index')->with('status', 'Can\'t delete file');
            }
        } elseif(!$filePath && $type == 'sourceFile') {
            return redirect()->route('files.index')->with('status', 'File not found!');
        } elseif (!$filePath && $type == 'screenshot') {
            return redirect()->route('screenshots.index')->with('status', 'File not found!');
        }

        $deleteFromDb = DownloadSource::findOrFail($request->id);
        $deleteFromDb->delete();

        if($type == 'sourceFile') {
            return redirect()->route('files.index')->with('status', 'File successfully deleted.');
        }
        return redirect()->route('screenshots.index')->with('status', 'File successfully deleted.');
    }


    public function downloadPdfCv()
    {
        $personalInfo = PersonalInfo::all();
        $education = Education::all()->sortByDesc('created_at');
        $workExperience = WorkExperience::all()->sortByDesc('created_at');
        $language = Language::all();
        $projects = Project::all()->sortByDesc('created_at');

        $data = [
            ['personalInfo' => $personalInfo],
            ['education' => $education],
            ['workExperience' => $workExperience],
            ['language' => $language],
            ['projects' => $projects],
        ];

        $pdf = PDF::loadView('cvPdf', compact('data'));
        return $pdf->download('hrvojeZubcicCv.pdf');
    }
}
