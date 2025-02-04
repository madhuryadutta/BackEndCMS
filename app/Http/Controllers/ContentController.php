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
        // $single_content = DB::select('select id, title, user_id, status, updated_at from contents where id=? and user_id=? and (status=? or status=?) order by updated_at desc', [$id, $current_user_id, 'Draft', 'Published']);
        $single_content = DB::select('select * from contents where id=? and (status=? or status=?) order by updated_at desc', [$id, 'Draft', 'Published']);

        return view('public_views.postDetails', ['single_content' => $single_content]);
    }

    // ------------------------- Under development

    public function listContent()
    {
        // $current_user_id = 9999;
        // $contents = DB::select('select id, title, user_id, status, updated_at from contents where user_id=? and (status=? or status=?) order by updated_at desc ', [$current_user_id, 'Draft', 'Published']);
        $contents = DB::select('select id, title, user_id, status,content_text, updated_at from contents where (status=? or status=?) order by updated_at desc ', ['Draft', 'Published']);

        // $trackers = $trackers->get();
        // return view('listContent', ['contents' => $contents]);
        return view('post', ['contents' => $contents]);
    }

    public function index()
    {
        $categoryOption = DB::select('select * from categories');

        // return view('contentEdit', ['categoryOption' => $categoryOption]);
        return view('contentEditor', ['categoryOption' => $categoryOption]);
    }

    public function create_post(Request $request, $id = null)
    {
        $post = $request['post_content'];
        // temporary fix to image height width issue
        // $updated_content_text = str_replace('<img', '<img class="my-responsive-image" ', $request['post_content']);
        $updated_content_text = $request['contentToSave'];
        if ($id == null) {
            $content = new Content;
        } else {
            $content = Content::find($id);
        }
        $content->fk_category_id = $request['category'];
        $content->title = $request['title'];
        $content->content_text = $updated_content_text;
        $content->user_id = 1;
        $content->status = 'Published';
        $content->save();
        // $resp_obj = [
        //     'status' => 'Success',
        //     'code' => 1

        // ];

        return redirect('list_content');
    }

    public function edit_post(Request $request, $id)
    {
        $SingleContent = Content::find($id);
        $categoryOption = DB::select('select * from categories');

        // return view('formCategoryUpdate', ['categoryList' => $categoryOption, 'currentCategory' => $currentCategory]);
        // return view('categoryEdit', ['categoryList' => $categoryOption, 'SingleContent' => $SingleContent]);
        return view('contentEditor', ['categoryOption' => $categoryOption, 'SingleContent' => $SingleContent]);
    }
    // public function upload()
    // {

    //     $response = Http::get('https://meme-api.databytedigital.com/');
    //     $url = $response['random_meme'];

    //     $remote_image = Http::get($url, [
    //         'Content-Type' => 'image/jpeg',
    //     ]);

    //     $data = ($remote_image->body());

    //     $imageName = time() . '.png';
    //     $filePath = 'images/' . $imageName;
    //     Storage::disk('b3')->put($filePath, $data, 'public');

    //     Storage::disk('local')->put($filePath, $data);
    // }

    // public function view_post()
    // {
    //     // $trackers = DB::table('page_view_count_link_creations')->where('user_id', $current_user_id);
    //     // $trackers = DB::select('select * from contents where user_id=? and soft_del=? order by created_at desc', [$current_user_id, 0]);
    //     $trackers = DB::select('select * from contents');

    //     // $trackers = $trackers->get();
    //     return view('welcome', ['trackers' => $trackers]);
    // }
    public function destroy($id)
    {
        $content = Content::find($id);
        if (! empty($content)) {
            $content->status = 'Deleted';
            $content->save();
        }

        return redirect()->route('listContent');
    }
}
