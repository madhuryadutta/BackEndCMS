<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\PublicAccessController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/install', [SettingController::class, 'install'])->name('install');
Route::get('/', [PublicAccessController::class, 'index'])->name('welcome');

Route::get('/get_image', function () {
    // $contents = Storage::disk('b3')->get('aaa.png');
    $contents = Storage::get('aaa.png');
    header('Content-type: image/png');
    echo $contents;
});
Route::get('/101', function () {
    $files = Storage::files('/');

    return $files;
});

Route::post('ckeditor/image_upload', [EditorController::class, 'upload'])->name('upload');
Route::get('content_editor', [ContentController::class, 'index'])->name('contentEditor');
Route::post('create_content', [ContentController::class, 'create_post'])->name('createContent');
// Route::get('view_post', [ContentController::class, 'view_post'])->name('view_post');
Route::get('single_content/{id}', [ContentController::class, 'singleContent'])->name('singleContent');
Route::get('list_content', [ContentController::class, 'listContent'])->name('listContent');
Route::get('uploads3', [ContentController::class, 'upload'])->name('uploads3');

Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'viewCategory')->name('viewCategory');
    Route::get('/add_category', 'addCategory')->name('addCategory');
    Route::post('/edit_category/{id?}', 'editCategory')->name('editCategory');
});
Route::controller(SettingController::class)->group(function () {
    Route::get('/admin', 'viewDashboard')->name('adminArea');
    // Route::post('/edit_category/{id?}', 'editCategory')->name('editCategory');
});


Route::get('/demo', function () {
    return view('demo');
});

Route::get('/nltk', function () {
    set_time_limit(60);
    $post = "The worst home improvement decision I made in 40+yrs. of home ownership was my choice of Retro Foam.

Now I own a house that has not passed inspection due to their 'work'.

I'd like to say 'thank you' to Brandon and Joey at the franchise in Pittsburgh for rutting up my lawn, crushing my driveway pipe, destroying my joist support beams, leaving the jobsite filthy, spraying foam on my foundation shrubs, plants and hardscape, for not cleaning up the uncured foam that still reeks like a dead animal 6mos. later, and finally for spraying foam all over the HVAC system after I told them not to. But, most of all, I give a big 'thank you' to Eric Garcia, expert in Dickensian circumlocution (the art of the runaround), diversion, delay and gaslighting, who made it all a reality I will have to live with the rest of my life.

Choose your contractor wisely, watch the movie 'Tin Men'.

Don't make the mistake I made.";
    $post = trim($post);
    // Execute the Python script
    $command = escapeshellcmd("python ./keyword_extraction.py " . escapeshellarg($post));
    $output = shell_exec($command);
    echo $output;
});
