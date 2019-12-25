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


//All routes for user API
Route::resource('subscriber', 'SubscriberController');

//All routes for task API
Route::resource('Field', 'FieldController');

/*
+--------+-----------+----------------------------------+--------------------+------------------------------------------------------------------------+--------------+
| Domain | Method    | URI                              | Name               | Action                                                                 | Middleware   |
+--------+-----------+----------------------------------+--------------------+------------------------------------------------------------------------+--------------+
|        | GET|HEAD  | /                                |                    | Closure                                                                | web          |
|        | GET|HEAD  | api/Field                        | Field.index        | App\Http\Controllers\FieldController@index                             | api          |
|        | POST      | api/Field                        | Field.store        | App\Http\Controllers\FieldController@store                             | api          |
|        | GET|HEAD  | api/Field/create                 | Field.create       | App\Http\Controllers\FieldController@create                            | api          |
|        | DELETE    | api/Field/{Field}                | Field.destroy      | App\Http\Controllers\FieldController@destroy                           | api          |
|        | GET|HEAD  | api/Field/{Field}                | Field.show         | App\Http\Controllers\FieldController@show                              | api          |
|        | PUT|PATCH | api/Field/{Field}                | Field.update       | App\Http\Controllers\FieldController@update                            | api          |
|        | GET|HEAD  | api/Field/{Field}/edit           | Field.edit         | App\Http\Controllers\FieldController@edit                              | api          |
|        | POST      | api/subscriber                   | subscriber.store   | App\Http\Controllers\SubscriberController@store                        | api          |
|        | GET|HEAD  | api/subscriber                   | subscriber.index   | App\Http\Controllers\SubscriberController@index                        | api          |
|        | GET|HEAD  | api/subscriber/create            | subscriber.create  | App\Http\Controllers\SubscriberController@create                       | api          |
|        | DELETE    | api/subscriber/{subscriber}      | subscriber.destroy | App\Http\Controllers\SubscriberController@destroy                      | api          |
|        | PUT|PATCH | api/subscriber/{subscriber}      | subscriber.update  | App\Http\Controllers\SubscriberController@update                       | api          |
|        | GET|HEAD  | api/subscriber/{subscriber}      | subscriber.show    | App\Http\Controllers\SubscriberController@show                         | api          |
|        | GET|HEAD  | api/subscriber/{subscriber}/edit | subscriber.edit    | App\Http\Controllers\SubscriberController@edit                         | api          |
|        | GET|HEAD  | api/user                         |                    | Closure                                                                | api,auth:api |
|        | POST      | login                            |                    | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
|        | GET|HEAD  | login                            | login              | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
|        | POST      | logout                           | logout             | App\Http\Controllers\Auth\LoginController@logout                       | web          |
|        | GET|HEAD  | password/confirm                 | password.confirm   | App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm    | web,auth     |
|        | POST      | password/confirm                 |                    | App\Http\Controllers\Auth\ConfirmPasswordController@confirm            | web,auth     |
|        | POST      | password/email                   | password.email     | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web          |
|        | GET|HEAD  | password/reset                   | password.request   | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web          |
|        | POST      | password/reset                   | password.update    | App\Http\Controllers\Auth\ResetPasswordController@reset                | web          |
|        | GET|HEAD  | password/reset/{token}           | password.reset     | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web          |
|        | GET|HEAD  | register                         | register           | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |
|        | POST      | register                         |                    | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    |
+--------+-----------+----------------------------------+--------------------+------------------------------------------------------------------------+--------------+
*/
