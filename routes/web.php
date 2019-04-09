<?php

use Illuminate\Support\Facades\Route;
/*Client*/
Route::get('/', 'IndexController@index')->name('client.index');
Route::post('/', 'IndexController@searchRoom')->name('client.index');
Route::get('introduction', 'IndexController@introduction')->name('client.introduction');
Route::get('contact', 'IndexController@contact')->name('client.contact');
Route::post('contact', 'IndexController@sendMail')->name('client.contact');
Route::get('promotions', 'IndexController@promotion')->name('client.promotions');


Route::group(['prefix' => 'services'], function () {
    Route::get('/', 'IndexController@services')->name('client.services.index');
    Route::get('{service}', 'IndexController@detailService')->name('client.services.detail');
});

Route::group(['prefix' => 'typerooms'], function () {
    Route::get('/', 'IndexController@typeRoom')->name('client.typerooms.index');
    Route::get('{typeRoom}', 'IndexController@detailTypeRoom')->name('client.typerooms.detail');
    Route::post('{typeRoom}', 'IndexController@searchRoomOfDetailTypeRoom')->name('client.typerooms.detail');
    Route::post('{typeRoom}/booking', 'IndexController@booking')->name('client.typerooms.booking');
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
        Route::get('/getList', 'UserController@getList')->name('getList');
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
        Route::get('/create', 'OrderController@create')->name('create');
        Route::get('/{order}/edit', 'OrderController@edit')->name('edit');
        Route::post('/{order}/edit', 'OrderController@actionEdit')->name('edit');
        Route::get('/{order}/delete', 'OrderController@delete')->name('delete');
        Route::post('/select-user', 'OrderController@selectUser')->name('select-user');
        Route::post('/select-room', 'OrderController@searchRoom')->name('search-room');
    });
});
