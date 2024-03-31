<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicAccessController extends Controller
{
    public function index()
    {
        // $trackers = DB::table('page_view_count_link_creations')->where('user_id', $current_user_id);
        // $trackers = DB::select('select * from contents where user_id=? and soft_del=? order by created_at desc', [$current_user_id, 0]);
        $contents = DB::select('select * from contents where status="Published" order by updated_at desc');

        // $trackers = $trackers->get();
        return view('welcome', ['contents' => $contents]);
    }

    public function future(Request $request)
    {
        echo 'future reference';
    }
}
