<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\EditorController;
use Illuminate\Support\Facades\Route;

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
Route::post('ckeditor/image_upload', [EditorController::class, 'upload'])->name('upload');
Route::post('create_post', [ContentController::class, 'create_post'])->name('create_post');
