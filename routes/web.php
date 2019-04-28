<?php

use Illuminate\Support\Facades\Route;
/*Client*/
Route::get('/', 'IndexController@index')->name('client.index');
Route::get('/search', 'IndexController@searchRoom')->name('client.search');
Route::get('introduction', 'IndexController@introduction')->name('client.introduction');
Route::get('contact', 'IndexController@contact')->name('client.contact');
Route::post('contact', 'IndexController@sendMail')->name('client.contact');
Route::get('promotions', 'IndexController@promotion')->name('client.promotions');
Route::group(['prefix' => 'booking'], function () {
    Route::get('/', 'IndexController@listTypeRoomBook')->name('client.booking');
    Route::post('/{typeRoom}/edit', 'IndexController@editTypeRoom')->name('client.booking.edit');
    Route::get('/{typeRoom}/delete', 'IndexController@deleteTypeRoom')->name('client.booking.delete');
    Route::get('/delete-all', 'IndexController@deleteTypeRooms')->name('client.booking.delete-all');
    Route::get('next', 'IndexController@infoCustomer')->name('client.booking.next');
    Route::post('next', 'IndexController@confirm')->name('client.booking.next');
    Route::get('finish', 'IndexController@finish')->name('client.booking.finish');
    Route::post('check', 'IndexController@checkCodePromotion')->name('client.booking.check');
    Route::get('/pusher', function (Illuminate\Http\Request $request) {
        event(new App\Events\BookingPusherEvent($request));
        return redirect()->route('client.booking.finish');
    });
});

Route::group(['prefix' => 'services'], function () {
    Route::get('/', 'IndexController@services')->name('client.services.index');
    Route::get('{service}', 'IndexController@detailService')->name('client.services.detail');
});

Route::group(['prefix' => 'typerooms'], function () {
    Route::get('/', 'IndexController@typeRoom')->name('client.typerooms.index');
    Route::get('{typeRoom}', 'IndexController@detailTypeRoom')->name('client.typerooms.detail');
    Route::post('{typeRoom}', 'IndexController@searchRoomOfDetailTypeRoom')->name('client.typerooms.detail');
    Route::get('{typeRoom}/booking/{startDate?}/{endDate?}/{number_people?}', 'IndexController@booking')
        ->name('client.typerooms.booking');
});
/*Admin*/
Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::get('/', 'IndexController@index')->name('index');

    Route::prefix('diagram')->name('diagram.')->group(function () {
        Route::get('/', 'DiagramController@index')->name('index');
    });

    Route::prefix('type-rooms')->name('type-rooms.')->group(function () {
        Route::get('/', 'TypeRoomController@index')->name('index');
        Route::get('/getListTypeRoom', 'TypeRoomController@getListTypeRoom')->name('getListTypeRoom');
        Route::get('/create', 'TypeRoomController@createTypeRoom')->name('create');
        Route::post('/create', 'TypeRoomController@actionCreateTypeRoom')->name('actionCreateTypeRoom');
        Route::get('/{typeRoom}/delete', 'TypeRoomController@delete')->name('delete');
        Route::get('/{typeRoom}/detail', 'TypeRoomController@detail')->name('detail');
        Route::get('/{typeRoom}/edit', 'TypeRoomController@edit')->name('edit');
        Route::post('/{typeRoom}/edit', 'TypeRoomController@actionEdit')->name('edit');
        Route::prefix('/{typeRoom}/rooms')->name('rooms.')->group(function () {
            Route::get('/', 'RoomController@getRoomByTypeRoom')->name('getRoomByTypeRoom');
            Route::get('/getListRoom', 'RoomController@getListRoomByTypeRoom')->name('getListRoomByTypeRoom');
            Route::get('/create', 'RoomController@create')->name('create');
            Route::post('/create', 'RoomController@actionCreate')->name('action-create');
            Route::get('{room}/edit', 'RoomController@edit')->name('edit');
            Route::post('{room}/edit', 'RoomController@actionEdit')->name('edit');
            Route::get('{room}/delete', 'RoomController@delete')->name('delete');
        });
    });

    Route::prefix('list-rooms')->name('rooms.')->group(function () {
        Route::get('/', 'RoomController@index')->name('index');
    });

    Route::prefix('library-images')->name('library-images.')->group(function () {
        Route::get('/', 'LibraryImageController@index')->name('index');
        Route::post('/', 'LibraryImageController@actionSaveImage')->name('index');
        Route::post('/{id?}', 'LibraryImageController@actionDeleteImage')->name('delete');
    });

    Route::prefix('diagrams')->name('diagrams.')->group(function () {
        Route::get('/', 'DiagramController@index')->name('index');
    });

    Route::prefix('devices')->name('devices.')->group(function () {
        Route::get('/', 'DeviceController@index')->name('index');
        Route::get('/export-pdf', 'DeviceController@exportPDF')->name('export-pdf');
        Route::get('/import-excel', 'DeviceController@importExcel')->name('import-excel');
        Route::get('/getList', 'DeviceController@getList')->name('get-list');
        Route::get('/create', 'DeviceController@create')->name('create');
        Route::post('/create', 'DeviceController@actionCreate')->name('create');
        Route::get('/{device}/edit', 'DeviceController@edit')->name('edit');
        Route::post('/{device}/edit', 'DeviceController@actionEdit')->name('edit');
        Route::get('/{device}/delete', 'DeviceController@delete')->name('delete');
        Route::get('/{device}/detail', 'DeviceController@detail')->name('detail');
    });

    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', 'ServiceController@index')->name('index');
        Route::get('/getList', 'ServiceController@getList')->name('getList');
        Route::get('/create', 'ServiceController@create')->name('create');
        Route::post('/create', 'ServiceController@actionCreate')->name('create');
        Route::get('/{service}/edit', 'ServiceController@edit')->name('edit');
        Route::post('/{service}/edit', 'ServiceController@actionEdit')->name('edit');
        Route::get('/{service}/delete', 'ServiceController@delete')->name('delete');
        Route::get('/{service}/detail', 'ServiceController@detail')->name('detail');
    });

    Route::prefix('promotions')->name('promotions.')->group(function () {
        Route::get('/', 'PromotionController@index')->name('index');
        Route::get('/getList', 'PromotionController@getList')->name('getList');
        Route::get('/create', 'PromotionController@create')->name('create');
        Route::post('/create', 'PromotionController@actionCreate')->name('create');
        Route::get('/{promotion}/edit', 'PromotionController@edit')->name('edit');
        Route::post('/{promotion}/edit', 'PromotionController@actionEdit')->name('edit');
        Route::get('/{promotion}/delete', 'PromotionController@delete')->name('delete');
        Route::post('/send-mail', 'PromotionController@sendMail')->name('sendMail');
    });

    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', 'ContactController@index')->name('index');
        Route::get('/getList', 'ContactController@getList')->name('getList');
        Route::post('/delete', 'ContactController@delete')->name('delete');
        Route::post('/send-mail', 'ContactController@sendMail')->name('sendMail');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', 'UserController@index')->name('index');
        Route::get('/export-excel', 'UserController@exportExcel')->name('export-excel');
        Route::get('/getList', 'UserController@getList')->name('getList');
        Route::get('/export-pdf', 'UserController@exportPDF')->name('export-pdf');
        Route::get('/create', 'UserController@create')->name('create');
        Route::post('/create', 'UserController@actionCreate')->name('create');
        Route::post('/sendMail', 'UserController@sendMail')->name('sendMail');
        Route::get('/{user}/detail', 'UserController@detail')->name('detail');
        Route::get('/{user}/edit', 'UserController@edit')->name('edit');
        Route::post('/{user}/edit', 'UserController@actionEdit')->name('edit');
        Route::get('/{user}/delete', 'UserController@delete')->name('delete');
    });

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', 'OrderController@index')->name('index');
        Route::get('/getList', 'OrderController@getList')->name('getList');
        Route::get('/export-pdf', 'OrderController@exportPDFs')->name('export-pdfs');
        Route::get('/export-pdf/{order}', 'OrderController@exportPDF')->name('export-pdf');
        Route::get('/wait', 'OrderController@orderWait')->name('wait');
        Route::get('/list-order-wait', 'OrderController@getOrderWait')->name('list-wait');
        Route::get('/handled', 'OrderController@orderHandles')->name('handled');
        Route::get('/list-order-handled', 'OrderController@getOrderHandled')->name('list-handled');
        Route::get('/create', 'OrderController@create')->name('create');
        Route::post('/create', 'OrderController@actionCreate')->name('create-post');
        Route::post('/confirm-booking', 'OrderController@deleteTypeRoomWhenBooking')->name('delete-booking');
        Route::get('/finish', 'OrderController@finishCreate')->name('finish');
//        Wait
        Route::get('/wait/{order}/edit', 'OrderController@editWait')->name('wait.edit');
        Route::post('/wait/{order}/edit', 'OrderController@actionEditWait')->name('wait.edit');
//        Handle
        Route::get('/handled/{order}/edit', 'OrderController@editHandled')->name('handled.edit');
        Route::post('/handled/{order}/edit', 'OrderController@confirm')->name('handled.edit');
        Route::get('/handled/finish', 'OrderController@finishEditHandled')->name('handled.finish');

        Route::get('/{order}/delete', 'OrderController@deleteOrder')->name('delete');
        Route::post('/select-user', 'OrderController@selectUser')->name('select-user');
        Route::post('/select-room', 'OrderController@searchRoom')->name('search-room');
        Route::post('/calculate', 'OrderController@calculate')->name('calculate');
        Route::post('/delete', 'OrderController@delete')->name('delete');
    });

    Route::prefix('revenues')->name('revenues.')->group(function () {
        Route::get('/', 'RevenueController@reports')->name('index');
        Route::get('/report-type-rooms', 'RevenueController@reportTypeRoom')->name('type-rooms');
    });

    Route::prefix('calendars')->name('calendars.')->group(function () {
        Route::get('/', 'CalendarController@index')->name('rooms');
    });
});

Auth::routes();
