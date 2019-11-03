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
Route::get('api/demo', 'Test\JsonDemoController@index')->name('demo.api.json');

// PUBLIC WEB API, TOKEN VERIFICATION

Route::middleware('auth:api')->group(function() {
    Route::namespace('Web')->name('web.')->prefix('web/v1')->group(function () {
        Route::get('{user}/{device}', 'WebAccessController@respond_v1')->name('access_v1');
    });
});

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
            Route::get('registrations', 'UsersController@indexRegistrations')->name('users.unverified');
        });
    });

    // gate: manage signage
    Route::middleware('can:manage-signage')->group(function () {
        Route::get('devices/{device}/pdf/', 'DeviceController@streamPdf')->name('devices.pdf');
        Route::resource('devices', 'DeviceController', ['except' => ['show']]);
        Route::resource('channels', 'ChannelController', ['except' => ['show']]);
        Route::resource('channels.screens', 'ScreenController', ['except' => ['show']]);
        // custom routes for screen content types
        Route::get('channels/{channel}/screens/{screen}/content/edit', 'ScreenController@editContent')->name('channels.screens.content.edit');
        Route::get('channels/{channel}/screens/{screen}/content/update', 'ScreenController@updateContent')->name('channels.screens.content.update');
    });

    // gate: run tests
    Route::middleware('can:run-tests')->group(function () {
        // ns \Test & prefix /test
        Route::namespace('Test')->name('test.')->prefix('test')->group(function () {
            // playground
            Route::get('playground', 'TestFrontendController@playground')->name('playground');
            // test sending of email
            Route::get('email', 'TestFrontendController@email')->name('email');
            // test QR-Codes
            Route::prefix('qrcode')->group(function () {
                Route::get('email', 'TestQRCodeController@email')->name('qr-email');
                Route::get('link', 'TestQRCodeController@link')->name('qr-link');
                Route::get('phone', 'TestQRCodeController@phone')->name('qr-phone');
            });
        });
    });

});
