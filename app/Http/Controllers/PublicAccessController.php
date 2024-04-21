<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PublicAccessController extends Controller
{
    public function decodeAndFormat($string)
    {
        $string = str_replace('\n', '<br>', $string);

        return html_entity_decode($string);
    }

    public function index()
    {

        // if (Cache::has('contents')) {
        //     // If it does, retrieve it from the cache
        //     $contents = Cache::get('contents');
        // } else {
        // If it doesn't, fetch it from the database and store it in the cache
        // $trackers = DB::table('page_view_count_link_creations')->where('user_id', $current_user_id);
        // $trackers = DB::select('select * from contents where user_id=? and soft_del=? order by created_at desc', [$current_user_id, 0]);
        $contents = DB::select('select * from contents where status=? order by updated_at desc', ['Published']);

        //     Cache::put('contents', $contents, now()->addMinutes(1)); // Cache for 1 minutes
        // }

        // $trackers = $trackers->get();
        return view('welcome', ['contents' => $contents]);
    }

    public function future(Request $request)
    {
        echo 'future reference';
    }
}
