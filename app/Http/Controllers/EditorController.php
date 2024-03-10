<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\VarDumper\VarDumper;
use Intervention\Image\Facades\Image;

class EditorController extends Controller
{
    public function upload(Request $request)
    {
        // var_dump($request);

        $this->validate($request, [
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:51200',
        ]);

        $image = $request->file('upload');
        $filename = time() . '.' . $image->getClientOriginalExtension();

        // Resize the image
        $resizedImage = Image::make($image->path());
        $resizedImage->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        // Using Laravel's storage system to save the image
        $path = 'images/' . $filename; // Define path within the disk

        // Choose disk: local, public, or s3
        $disk = 'public'; // Example: to use the "public" disk

        // Save the image to disk
        Storage::disk($disk)->put($path, (string) $resizedImage->encode());

        // Return success response
        return back()->with('success', 'Image uploaded successfully')->with('imageName', $filename);
        die();

        // if ($request->hasFile('upload')) {
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
// }
