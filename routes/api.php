<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('/event/{user_id?}', function($user_id) {

    $checkindescs = \App\Models\Checkindesc::where('user_id', $user_id)
    ->where('check', '1')
    ->get();

    $data = [];

    foreach ($checkindescs as $checkindesc) {
        $data[] = [
            'title' => $checkindesc->checkin->checkin_desc,
            'start' => thaidate('Y-m-d 22:00:00', $checkindesc->checkin->checkin_date, false),
            'end' => thaidate('Y-m-d 22:10:01', $checkindesc->checkin->checkin_date, false),
        ];
    }

    return response()->json($data);

    
});