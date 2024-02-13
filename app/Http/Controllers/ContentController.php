<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function create_post(Request $request)
    {
        echo $request['post'];
    }
}
