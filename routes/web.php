<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\EditorController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/get_image', function () {
    $contents = Storage::disk('b3')->get('aaa.png');
    return $contents;
});
Route::get('/101', function () {
    $files = Storage::files('/');
    return $files;
});


Route::post('ckeditor/image_upload', [EditorController::class, 'upload'])->name('upload');
Route::post('create_post', [ContentController::class, 'create_post'])->name('create_post');
Route::get('view_post', [ContentController::class, 'view_post'])->name('view_post');
Route::get('uploads3', [ContentController::class, 'upload'])->name('uploads3');
