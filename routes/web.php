<?php

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

/*Models*/
use App\Models\Publication;



Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*For user configs*/
Route::get('/config',[App\Http\Controllers\UserController::class , 'config'])->name('config');
Route::post('/config/update',[App\Http\Controllers\UserController::class , 'update'])->name('config-update');
Route::get('/profile/{id}',[App\Http\Controllers\UserController::class , 'profile'])->name('profile')->where(['id'=>'[0-9]+']);
Route::get('/avatar/{img}',[App\Http\Controllers\UserController::class , 'getAvatar'])->name('avatar');
Route::get('/avatar-default',[App\Http\Controllers\UserController::class , 'getAvatarDefault'])->name('avatar-default');

/*For publications*/
Route::get('/publication/create',[App\Http\Controllers\PublicationController::class , 'create'])->name('publication-create');
Route::post('/publication/save',[App\Http\Controllers\PublicationController::class , 'save'])->name('publication-save');
Route::get('/publication/remove/{id}',[App\Http\Controllers\PublicationController::class , 'remove'])->name('publication-remove')->where(['id'=>'[0-9]+']);

/*For likes*/
Route::get('/like/add/{publication}',[App\Http\Controllers\LikeController::class , 'giveLike'])->name('like-add')->where(['publication'=>'[0-9]+']);
Route::get('/like/remove/{publication}',[App\Http\Controllers\LikeController::class , 'removeLike'])->name('like-remove')->where(['publication'=>'[0-9]+']);
Route::get('/liked-Publications',[App\Http\Controllers\LikeController::class , 'getLikedPublications'])->name('liked-Publications');

/*For Comments*/
Route::get('/comments/add/{publication}/{comment}',[App\Http\Controllers\CommentController::class , 'addComment'])->name('comment-add')->where(['publication'=>'[0-9]+']);
Route::get('/comments/delete/{publication}',[App\Http\Controllers\CommentController::class , 'removeComment'])->name('comment-remove')->where(['publication'=>'[0-9]+']);
