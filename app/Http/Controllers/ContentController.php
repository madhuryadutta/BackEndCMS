<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    // public function view_post()
    // {
    //     // $trackers = DB::table('page_view_count_link_creations')->where('user_id', $current_user_id);
    //     // $trackers = DB::select('select * from contents where user_id=? and soft_del=? order by created_at desc', [$current_user_id, 0]);
    //     $trackers = DB::select('select * from contents');

    //     // $trackers = $trackers->get();
    //     return view('welcome', ['trackers' => $trackers]);
    // }

    public function index()
    {
        $categoryOption = DB::select('select * from categories');

        return view('contentEdit', ['categoryOption' => $categoryOption]);

    }

    public function create_post(Request $request)
    {
        var_dump($request->all());
        // echo $request['_token'];
        // echo $request['post'];
        $content = new Content;

        $content->category_id = 1;
        $content->title = $request['_token'];
        $content->content_text = $request['post'];
        $content->user_id = 1;
        $content->user_id = 1;
        $content->status = 'Published';
        $content->save();
    }

    public function upload()
    {

        $response = Http::get('https://meme-api.databytedigital.com/');
        $url = $response['random_meme'];

        $remote_image = Http::get($url, [
            'Content-Type' => 'image/jpeg',
        ]);

        $data = ($remote_image->body());

        $imageName = time().'.png';
        $filePath = 'images/'.$imageName;
        Storage::disk('b3')->put($filePath, $data, 'public');

        Storage::disk('local')->put($filePath, $data);
    }
}
