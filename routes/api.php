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

#Auth
Route::post('login', 'AuthController@login')->name('api.login');
Route::post('register', 'AuthController@register')->name('api.register');
Route::post('fetch/user', 'AuthController@fetchUser');

#Dashboard
Route::post('dashboard', 'DashboardController@index');
Route::post('row/status', 'DashboardController@rowStatus');

#Meetings
Route::post('meetings', 'MeetingController@index');
Route::post('meeting/edit', 'MeetingController@edit');
Route::post('meeting/create', 'MeetingController@store');
Route::put('meeting/update', 'MeetingController@store');
Route::delete('meeting/destroy', 'MeetingController@destroy');
Route::post('meeting/invite/member', 'MeetingController@inviteMember');
Route::post('meeting/remove/member', 'MeetingController@removeMember');

#Calls
Route::post('calls', 'CallController@index');
Route::post('call/edit', 'CallController@edit');
Route::post('call/create', 'CallController@store');
Route::put('call/update', 'CallController@store');
Route::delete('call/destroy', 'CallController@destroy');
Route::post('call/invite/member', 'CallController@inviteMember');
Route::post('call/remove/member', 'CallController@removeMember');

#Members
Route::post('list/members', 'MemberController@list');
Route::post('members', 'MemberController@index');
Route::post('member/meetings', 'MemberController@meetings');
Route::post('member/calls', 'MemberController@calls');
Route::post('member/suspend', 'MemberController@suspend');
Route::delete('member/destroy', 'MemberController@destroy');

#Settings
Route::get('settings', 'SettingController@index');
Route::post('settings', 'SettingController@update');
