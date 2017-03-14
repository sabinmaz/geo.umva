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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->get('/list-countries', 'Geo\Http\Controllers\api\CountryController@getAllCountries');
    $api->get('/list-countries-min', 'Geo\Http\Controllers\api\CountryController@getAllCountriesMinData');
    $api->get('/{country}', 'Geo\Http\Controllers\api\CountryController@getCountryByName');
    $api->get('/list-province/{country}','Geo\Http\Controllers\api\LevelFirstController@getAllProvince');
    $api->get('/{country}/{state}', 'Geo\Http\Controllers\api\LevelFirstController@getProvinceByCountryAndName');
    $api->get('/list-commune/{country}/{state}', 'Geo\Http\Controllers\api\LevelFirstController@getCommuneByCountryAndState');
});
