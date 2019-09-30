<?php

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
    return view('frontend.pages.front');
});

Auth::routes();

Route::get('/home', function() {
    $data['user'] = Auth::user();
    return view('backend.dashboard', $data);
})->name('home')->middleware('auth');
