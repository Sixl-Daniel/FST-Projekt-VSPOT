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

    // Route::view('dashboard', 'backend.dashboard')->name('dashboard');
    Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');

    // gate: manage users
    Route::middleware('can:manage-users')->group(function () {
        // ns \Admin & prefix /admin
        Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function () {
            Route::resource('users', 'UsersController', ['except' => ['show', 'create', 'store']]);
            Route::get('registrations', 'UsersController@indexRegistrations');
        });
    });

    // gate: manage signage
    Route::middleware('can:manage-signage')->group(function () {
        // ns \Signage & prefix /signage
        Route::namespace('Signage')->name('signage.')->prefix('signage')->group(function () {
            //
        });
    });

    // gate: run tests
    Route::middleware('can:run-tests')->group(function () {
        // ns \Test & prefix /test
        Route::namespace('Test')->name('test.')->prefix('test')->group(function () {
            Route::get('email', 'TestFrontendController@email')->name('test-email');
        });
    });

});
