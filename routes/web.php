<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
    return Blade::render('{{ $greeting }}, @if (false) World @else Folks @endif', ['greeting' => 'Hello']);

    //throw new \Exception('Whooops');

    //return Str::of('hello world')->upper()->append(' and everyone else');

    //return view('welcome');
})->name('home');

Route::get('/endpoint', function () {
    return to_route('home');
    //return redirect()->route('home');
});

Route::controller(\App\Http\Controllers\PostsController::class)->group(function () {
    Route::get('/posts', 'index');
    Route::get('/posts/{post}', 'show');
    Route::post('/posts', 'store');
});

Route::get('/users/{user}/posts/{post}', function (User $user, Post $post) {
    return $post;
})->scopeBindings();
