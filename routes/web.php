<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
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
Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'viewDashboard')->name('adminArea');
    // Route::post('/edit_category/{id?}', 'editCategory')->name('editCategory');
});

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
Route::get('delete_content/{id}', [ContentController::class, 'destroy'])->name('deleteContent');
Route::get('uploads3', [ContentController::class, 'upload'])->name('uploads3');

Route::prefix('admin')->group(
    function () {
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/category', 'viewCategory')->name('viewCategory');
            Route::get('/new_category_form', 'newCategoryForm')->name('newCategory');
            Route::post('/add_category', 'addCategory')->name('addCategory');
            Route::get('/edit_category/{id?}', 'editCategory')->name('editCategory');
            Route::post('/update_category/{id?}', 'updateCategory')->name('updateCategory');
            Route::get('/delete_category/{id?}', 'deleteCategory')->name('deleteCategory');
        });
        // Route::controller(ContentController::class)->group(function () {
        //     Route::get('/category', 'viewCategory')->name('viewCategory');
        //     Route::get('/new_category_form', 'newCategoryForm')->name('newCategory');
        //     Route::post('/add_category', 'addCategory')->name('addCategory');
        //     Route::get('/edit_category/{id?}', 'editCategory')->name('editCategory');
        //     Route::post('/update_category/{id?}', 'updateCategory')->name('updateCategory');
        //     Route::get('/delete_category/{id?}', 'deleteCategory')->name('deleteCategory');
        // });
        Route::get('content_editor', [ContentController::class, 'index'])->name('contentEditor');

        // Management related
        Route::get('/install', [SettingController::class, 'install'])->name('install');
        Route::get('/artisanCache', [SettingController::class, 'artisanCache'])->name('artisanCache');
        Route::get('/artisanCacheClear', [SettingController::class, 'artisanCacheClear'])->name('artisanCacheClear');
        Route::get('/cache-purge/{key?}', [SettingController::class, 'cachePurge'])->name('cachePurge');
        // Management related
    }

);

Route::get('/demo', function () {
    return view('demo');
});
