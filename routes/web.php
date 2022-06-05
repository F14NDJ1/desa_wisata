<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContentKindController;
use App\Http\Controllers\ContentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| php artisan route:cache = jika controller tidak ditemukan
| php artisan optimize
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::group(['middleware' => ['auth']], function () {
    /* Edit profile */
    Route::get('/admin/edit_profile', function () {
        return view('admin/edit_profile');
    });
    Route::get('/admin/edit_profile/update_account/{id}', [UserController::class, 'update_account']);

    //Route for admin
    Route::get('/admin/home', [UserController::class, 'home']);
    /* User List  */
    Route::get('/admin/user_list', [UserController::class, 'list']);
    Route::get('/admin/read', [UserController::class, 'read']);
    Route::get('/admin/create', [UserController::class, 'create']);
    Route::post('/admin/store', [UserController::class, 'store']);
    Route::get('/admin/show/{id}', [UserController::class, 'show']);
    Route::post('/admin/update/{id}', [UserController::class, 'update']);
    Route::get('/admin/destroy/{id}', [UserController::class, 'destroy']);
    /* Route::get('/admin/edit/{id}', [UserController::class, 'show']); */

    //Route for user
    Route::get('/user/home', [ContentKindController::class, 'home']);
    /* Content Kind */
    Route::get('/user/contentKind/content_kind_list', [ContentKindController::class, 'content_kind_list']);
    Route::get('/user/contentKind/read', [ContentKindController::class, 'read']);
    Route::get('/user/contentKind/create', [ContentKindController::class, 'create']);
    Route::post('/user/contentKind/store', [ContentKindController::class, 'store']);
    Route::get('/user/contentKind/show/{id}', [ContentKindController::class, 'show']);
    Route::post('/user/contentKind/update/{id}', [ContentKindController::class, 'update']);
    Route::get('/user/contentKind/destroy/{id}', [ContentKindController::class, 'destroy']);

    /* Content */
    Route::get('/user/contentKind/{content_kind}/{content_kind_id}', [ContentController::class, 'content']);
    Route::get('/user/contentKind/read/{content_kind}/{content_kind_id}', [ContentController::class, 'read']);
    Route::get('/user/contentKind/create/{content_kind}/{id}', [ContentController::class, 'create']);
    Route::post('/user/contentKind/store/{content_kind}/{id}', [ContentController::class, 'store']);
    Route::get('/user/contentKind/show/{content_kind}/{id}', [ContentController::class, 'show']);
    Route::post('/user/contentKind/update/{content_kind_id}/{id}', [ContentController::class, 'update']);
    Route::get('/user/contentKind/destroy/{content_kind_id}/{id}', [ContentController::class, 'destroy']);
});

Route::get('/tes', function () {
    return view('editor');
});
