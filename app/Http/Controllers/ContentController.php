<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    // ------------------------- Under development

    public function singleContent($id)
    {
        $current_user_id = 9999;
        $single_content = DB::select('select id, title, user_id, status, updated_at from contents where id=? and user_id=? and (status=? or status=?) order by updated_at desc', [$id, $current_user_id, 'Draft', 'Published']);
        $categoryOption = DB::select('select * from categories');
        // return view('contentEdit', ['single_content' => $single_content, 'categoryOption' => $categoryOption]);
    }

    // ------------------------- Under development

    public function listContent()
    {
        $current_user_id = 9999;
        $contents = DB::select('select id, title, user_id, status, updated_at from contents where user_id=? and (status=? or status=?) order by updated_at desc ', [$current_user_id, 'Draft', 'Published']);

        // $trackers = $trackers->get();
        return view('listContent', ['contents' => $contents]);
    }

    public function index()
    {
        $categoryOption = DB::select('select * from categories');

        return view('contentEdit', ['categoryOption' => $categoryOption]);
    }

    public function create_post(Request $request)
    {
        $post = $request['post_content'];
        $post = "The worst home improvement decision I made in 40+yrs. of home ownership was my choice of Retro Foam.

        Now I own a house that has not passed inspection due to their 'work'.
        
        I'd like to say 'thank you' to Brandon and Joey at the franchise in Pittsburgh for rutting up my lawn, crushing my driveway pipe, destroying my joist support beams, leaving the jobsite filthy, spraying foam on my foundation shrubs, plants and hardscape, for not cleaning up the uncured foam that still reeks like a dead animal 6mos. later, and finally for spraying foam all over the HVAC system after I told them not to. But, most of all, I give a big 'thank you' to Eric Garcia, expert in Dickensian circumlocution (the art of the runaround), diversion, delay and gaslighting, who made it all a reality I will have to live with the rest of my life.
        
        Choose your contractor wisely, watch the movie 'Tin Men'.
        
        Don't make the mistake I made.";
        // Execute the Python script
        $command = escapeshellcmd("python ./keyword_extraction.py " . escapeshellarg($post));
        $output = shell_exec($command);

        // Convert the output string to an array
        $data['keywords'] = explode("\n", trim($output));
        // $keywords = explode("\n", trim($output));
        // echo implode(", ", $keywords);
        // return view('keyword_view', $data);
        return $data;
        die();
        # temporary fix to image height width issue
        $updated_content_text = str_replace('<img', '<img class="my-responsive-image" ', $request['post_content']);
        $content = new Content;
        $content->fk_category_id = $request['category'];
        $content->title = $request['title'];
        $content->content_text = $updated_content_text;
        $content->user_id = 1;
        $content->status = 'Published';
        $content->save();
        $resp_obj = [
            'status' => 'Success',
            'code' => 1,

        ];
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

    // public function view_post()
    // {
    //     // $trackers = DB::table('page_view_count_link_creations')->where('user_id', $current_user_id);
    //     // $trackers = DB::select('select * from contents where user_id=? and soft_del=? order by created_at desc', [$current_user_id, 0]);
    //     $trackers = DB::select('select * from contents');

    //     // $trackers = $trackers->get();
    //     return view('welcome', ['trackers' => $trackers]);
    // }
}
