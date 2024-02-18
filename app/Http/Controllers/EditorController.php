<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditorController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $cdnEndpoint = config('custom.cdn');
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = str_replace(' ', '', $filename) . '_' . time() . '.' . $extension;

            $path = 'cdn/';
            //Upload File
            $request->file('upload')->storeAs($path, $filenametostore);

            // temp
            // $i_m_file = $request->file('upload');
            // Storage::disk('b3')->put('/', $i_m_file);
            // $returned_file_name = Storage::disk('local')->put('/', $i_m_file);
            // $url = $subdomain+'/'+.$filenametostore);
            // temp

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset($path . $filenametostore);
            // $url = url($path . $filenametostore);
            // $url = $cdnEndpoint.$path . $filenametostore;

            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
}
