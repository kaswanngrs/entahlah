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

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::post('password_resets', 'API\UserController@password_resets');
Route::post('check_code', 'API\UserController@check_code_Password');
Route::post('For_Get_Pasword', 'API\UserController@For_Get_Pasword');

// Route::get('x', function(){

//   return "essssssss3ad allh ";

// });
Route::group(['middleware' => 'auth:api','prefix'=>'auth'], function(){

    Route::post('details', 'API\UserController@details');
    Route::post('set_user_points', 'API\UserController@setUserPoint');
    Route::post('join-game','GamesController@joinGame')->name('game.join');
    Route::post('joinGame2','GamesController@joinGame2')->name('game.join2');
    Route::post('show_Ads','GamesController@showAds')->name('show.Ads');
    Route::get('GameSession','GamesController@GameSession')->name('GameSession.Ads');

    Route::post('view-adds','GamesController@viewAdds')->name('game.view-adds');
    Route::post('get-answer','GamesController@getAnswer')->name('game.get-answer');
    Route::post('wheel-of-fortune','GamesController@WheelOfFortune')->name('game.WheelOfFortune');
    Route::post('slot-machine','GamesController@slotMachine')->name('game.slotMachine');
    Route::post('referral_code','GamesController@referral')->name('game.referral');
    Route::get('referral/{code}','GamesController@referralLink');
    Route::get('showReferral','GamesController@show_referral');
    Route::get('TotalPoint','GamesController@TotalPoint')->name('game.TotalPoint');

    Route::get('Task','TaskController@show');
    Route::get('showTask','TaskController@indexApi');

    Route::get('ShowLink/{id}','TaskController@ShowLink');
    Route::get('addPointTask','TaskController@addPointTask');


    Route::get('Awards/show','AwardsController@indexApi');
    Route::get('Questions','QuestionsController@indexApi');


    Route::post('Winer/add','WinerController@storeApi');
    Route::get('get_All_Notifcation','notifctionController@getAllNotifcation');
    Route::get('showinformation','GamesController@showattent');
    Route::post('counterquestion','QuestionsController@counterquestion');

});
Route::get('reset_time_attimpte','GamesController@reset_time_attimpte');
Route::get('showTask','TaskController@indexApi');
