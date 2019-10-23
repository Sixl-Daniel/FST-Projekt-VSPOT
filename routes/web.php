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

    // gate: administer vspot
    Route::middleware('can:manage-vspot')->group(function () {
        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs');
    });

    // gate: manage users
    Route::middleware('can:manage-users')->group(function () {
        // ns \Admin & prefix /admin
        Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function () {
            Route::resource('users', 'UsersController', ['except' => ['show', 'create', 'store']]);
            Route::get('registrations', 'UsersController@indexRegistrations')->name('unverified-users');
        });
    });

    // gate: manage signage
    Route::middleware('can:manage-signage')->group(function () {
        Route::resource('devices', 'DeviceController', ['except' => ['show']]);
        Route::resource('channels', 'ChannelController', ['except' => ['show']]);
        Route::resource('channels.screens', 'ScreenController', ['except' => ['show']]);
    });

    // gate: run tests
    Route::middleware('can:run-tests')->group(function () {
        // ns \Test & prefix /test
        Route::namespace('Test')->name('test.')->prefix('test')->group(function () {
            // test sending of email
            Route::get('email', 'TestFrontendController@email')->name('test-email');
            // test QR-Codes
            Route::prefix('qrcode')->group(function () {
                Route::get('email', 'TestQRCodeController@email')->name('test-qr-email');
                Route::get('link', 'TestQRCodeController@link')->name('test-qr-link');
                Route::get('phone', 'TestQRCodeController@phone')->name('test-qr-phone');
            });
        });
    });

});
