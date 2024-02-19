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

        $content = new Content;
        $content->fk_category_id =$request['category'];
        $content->title = $request['title'];
        $content->content_text = $request['post_content'];
        $content->user_id = 1;
        $content->status = 'Published';
        $content->save();
        $resp_obj = array(
            'status' => "Success",
            'code' => 1,

        );
        echo json_encode($resp_obj);
    }

    public function upload()
    {

        $response = Http::get('https://meme-api.databytedigital.com/');
        $url = $response['random_meme'];

        $remote_image = Http::get($url, [
            'Content-Type' => 'image/jpeg',
        ]);

        $data = ($remote_image->body());

        $imageName = time() . '.png';
        $filePath = 'images/' . $imageName;
        Storage::disk('b3')->put($filePath, $data, 'public');

        Storage::disk('local')->put($filePath, $data);
    }
}
