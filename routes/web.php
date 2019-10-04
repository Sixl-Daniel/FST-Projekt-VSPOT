<?php

// SHARE VIEW NAME

View::composer('*', function($view){
    View::share('view_name', $view->getName());
});

// PUBLIC PRIMARY PAGES

Route::get('/', function () {
    return view('frontend.pages.primary.front');
});

Route::get('/produkt', function () {
    return view('frontend.pages.primary.produkt');
});

// PUBLIC SECONDARY PAGES

Route::get('/impressum', function () {
    return view('frontend.pages.secondary.impressum');
});

Route::get('/datenschutz', function () {
    return view('frontend.pages.secondary.datenschutz');
});

// VERIFIED USERS

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['verified']], function () {

    Route::view('/freischaltung', 'frontend.pages.feedback.waiting_for_approval');

    Route::get('/dashboard', function() {
        $data['user'] = Auth::user();
        return view('backend.dashboard', $data);
    })->name('dashboard');

});
