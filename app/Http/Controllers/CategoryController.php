<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function viewCategory()
    {
        $categoryList = DB::select('select * from categories');

        return view('categoryList', ['categoryList' => $categoryList]);
    }

    public function editCategory(Request $request)
    {
        // var_dump($request->all());
        // // echo $request['_token'];
        // // echo $request['post'];
        // $content = new Content;

        // $content->category_id = 1;
        // $content->title = $request['_token'];
        // $content->content_text = $request['post'];
        // $content->user_id = 1;
        // $content->user_id = 1;
        // $content->status = 'Published';
        // $content->save();
    }
}
