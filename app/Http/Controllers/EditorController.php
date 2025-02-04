<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class EditorController extends Controller
{
    public function upload(Request $request)
    {

        $request->validate([
            'file' => 'required|image|max:2048', // Validate image file
        ]);

        $file = $request->file('file');

        // Determine storage disk based on environment variable
        $storageType = 'local';  // Default to 'local' if not set in .env

        if ($storageType === 's3') {
            // Store the uploaded image to S3
            $path = $file->store('ap-northeast-1', 's3');
            // Get the full URL of the file stored on S3 (CloudFront or direct S3 URL)
            $url = Storage::disk('s3')->url($path);
        } else {
            // Store the uploaded image locally
            $path = $file->store('ap-northeast-1', 'public');  // Store in the "uploads" directory locally
            // Get the full URL of the file stored locally via the subdomain
            $url = asset('storage/'.$path);  // Use `asset` to generate the URL

        }

        // Return the URL to the client
        return response()->json(['location' => $url]);

        exit();

        $cdnEndpoint = config('custom.cdn');

        // var_dump($request);

        $this->validate($request, [
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:51200',
        ]);

        $image = $request->file('upload');
        $filename = time().'.'.$image->getClientOriginalExtension();

        // Resize the image
        $resizedImage = Image::make($image->path());
        $resizedImage->resize(720, 1280, function ($constraint) {
            $constraint->aspectRatio();
        });

        // Using Laravel's storage system to save the image
        $path = 'cdn/'.$filename; // Define path within the disk

        // Choose disk: local, public, or s3
        // $disk = 'public'; // Example: to use the "public" disk
        $disk = 'local'; // Example: to use the "public" disk

        // Save the image to disk
        Storage::disk($disk)->put($path, (string) $resizedImage->encode());

        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = $cdnEndpoint.$path;
        // echo $url;
        // $url = asset($path . $filenametostore);
        // $url = url($path . $filenametostore);
        // $url = $cdnEndpoint.$path . $filenametostore;

        $msg = 'Image successfully uploaded';
        $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        // Render HTML output
        @header('Content-type: text/html; charset=utf-8');
        echo $re;
        // Return success response
        // return back()->with('success', 'Image uploaded successfully')->with('imageName', $filename);
        // die();

        // if ($request->hasFile('upload')) {

        // get filename with extension
        // $filenamewithextension = $request->file('upload')->getClientOriginalName();

        // get filename without extension
        // $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        // get file extension
        // $extension = $request->file('upload')->getClientOriginalExtension();

        // filename to store
        // $filenametostore = str_replace(' ', '', $filename) . '_' . time() . '.' . $extension;
        // $filenametostore = str_replace(' ', '', $filename) . '_' . time() . '.' . $extension;

        $path = 'cdn/';
        // Upload File
        // $request->file('upload')->storeAs($path, $filenametostore);

        // temp
        // $i_m_file = $request->file('upload');
        // Storage::disk('b3')->put('/', $i_m_file);
        // $returned_file_name = Storage::disk('local')->put('/', $i_m_file);
        // $url = $subdomain+'/'+.$filenametostore);
        // temp

    }
}
// }
