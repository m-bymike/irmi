<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(
    [
        'middleware' => ['json-api:v1', 'auth:api'],
        'namespace' => '\\Api',
        'prefix' => '/v1',
    ],
    function () {
        \JsonApi::resource(Irma\JsonApi\Members\Schema::RESOURCE_TYPE, 'MembersController');
        \JsonApi::resource(Irma\JsonApi\Aircraft\Schema::RESOURCE_TYPE, 'AircraftController');
        \JsonApi::resource(Irma\JsonApi\Reservations\Schema::RESOURCE_TYPE, 'ReservationsController');
    }
);
