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


/*For publications*/
Route::get('/publication/show',[App\Http\Controllers\PublicationController::class , 'show'])->name('publication-show');
Route::get('/publication/create',[App\Http\Controllers\PublicationController::class , 'create'])->name('publication-create');
Route::post('/publication/save',[App\Http\Controllers\PublicationController::class , 'save'])->name('publication-save');
