<?php

// SHARE VIEW NAME
View::composer('*', function($view){
    View::share('view_name', $view->getName());
});

// PUBLIC PRIMARY PAGES
Route::view('/', 'frontend.pages.primary.front')->name('front');
Route::view('produkt', 'frontend.pages.primary.produkt')->name('produkt');

// PUBLIC SECONDARY PAGES
Route::view('impressum', 'frontend.pages.secondary.impressum')->name('impressum');
Route::view('datenschutz', 'frontend.pages.secondary.datenschutz')->name('datenschutz');

// PUBLIC TESTING
Route::get('api/demo', 'Test\JsonDemoController@index')->name('json-demo');

// VERIFIED USERS

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['verified']], function () {

    Route::get('aktivierung', function() {
        $data['user'] = Auth::user();
        return view('frontend.pages.feedback.waiting_for_approval', $data);
    })->name('approval');

    // AUTHORIZED USERS

    Route::middleware(['approved'])->group(function () {

        Route::get('dashboard', function() {
            $data['user'] = Auth::user();
            return view('backend.dashboard', $data);
        })->name('dashboard');

        // ADMIN USERS

        Route::middleware(['admin'])->group(function () {

            // ns \Admin & prefix /admin
            Route::namespace('Admin')->prefix('admin')->group(function () {
                Route::resource('users', 'UsersController', ['except' => ['show', 'create', 'store']]);
            });

            // ns \Test & prefix /test
            Route::namespace('Test')->prefix('test')->group(function () {
                Route::get('email', 'TestFrontendController@email')->name('test-email');
            });


        });

    });

});
