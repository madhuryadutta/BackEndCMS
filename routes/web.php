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
Route::get('view_post', [ContentController::class, 'view_post'])->name('view_post');
Route::get('uploads3', [ContentController::class, 'upload'])->name('uploads3');

Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'viewCategory')->name('viewCategory');
    Route::post('/edit_category/{id?}', 'editCategory')->name('editCategory');
});
Route::controller(SettingController::class)->group(function () {
    Route::get('/admin', 'viewDashboard')->name('adminArea');
    // Route::post('/edit_category/{id?}', 'editCategory')->name('editCategory');
});
