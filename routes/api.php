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

// Route::post('event', 'EventController@store');
// Route::get('event', 'EventController@index');
// Route::get('event/{event}', 'EventController@show');
Route::resource('events', 'EventController');
Route::get('events/{event}/count', 'EventController@eventTicketCount');
Route::get('events/{event}/add/{ticketcount}', 'EventController@addTickets');
Route::get('redeem/{ticketnumber}', 'TicketController@checkTicketStatus');