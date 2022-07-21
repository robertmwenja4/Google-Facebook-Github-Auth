<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Github
Route::get('/auth/redirect/github', [LoginController::class, 'redirectToGithub'])->name('login.github');
Route::get('/auth/github/callback', [LoginController::class, 'redirectToGithubCallback']);

//Facebook
Route::get('/auth/redirect/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/auth/facebook/callback', [LoginController::class, 'redirectToFacebookCallback']);
//Google
Route::get('/auth/redirect', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [LoginController::class, 'redirectToGoogleCallback']);
