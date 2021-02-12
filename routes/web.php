<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('users/addNewUsers','UserController@addNewUsers');
Route::post('users/{id}/edituser','UserController@edituser');
Route::post('users/{id}/update','UserController@update');
Route::post('users/{id}/delete','UserController@delete');
Route::post('clearData/clear','ClearDataController@clearData');
Route::get('/commission','UserController@commission');
Route::get('/commission/subadmin','UserController@commissionSub');
Route::post('user/gamecommission','UserController@gamecommission');

Route::get('/subadminlogin','SubAdminLoginController@index');
Route::post('/subadminlogin/login','SubAdminLoginController@sub_admin_login');

Route::post('login/login','LoginUserController@login');
Route::get('/dashboard','AdminController@index');
Route::get('/walletuser','UserController@walletuser');

Route::get('/money','UserController@money_pending');
Route::get('/money/pending','UserController@money_pending');

Route::get('/money/done','UserController@money_done');
Route::get('/money/cancel','UserController@money_cancel');
Route::get('money_request_edit/{id}','UserController@money_request_edit');
Route::get('money_request_edit/{id}/approve','UserController@money_request_approve');
Route::get('money_request_edit/{id}/reject','UserController@money_request_reject');
Route::put('money_request_update/{id}','UserController@money_request_update');

Route::post('/subadmin_create','Sub_AdminController@AddNewSubadmin');
Route::get('/sub_admin_edit/{id}/edit','Sub_AdminController@sub_admin_edit');
Route::get('/sub_admin_delete/{id}/deleteSubadmin','Sub_AdminController@deleteSubadmin');
Route::put('/sub_admin_update/{id}','Sub_AdminController@sub_admin_update');
Route::get('/sub_admin/create','Sub_AdminController@create');
Route::get('/login','LoginUserController@index');
Route::get('/users','UserController@index');
Route::get('/users/create','UserController@create');
Route::get('/users/accounthistory','UserController@accounthistory');
Route::get('/users/commissionhistory','UserController@commissionhistory');
Route::get('/admin','AdminController@index');
Route::get('/sub_admin','Sub_AdminController@index');
Route::get('/tournament','TournamentController@index');
Route::get('/tournament/create','TournamentController@create');
Route::post('/tournament/store','TournamentController@store');
Route::get('/tournament/{id}/edit','TournamentController@edit');
Route::post('tournament/{id}/update','TournamentController@update');
Route::get('/bots','BotsController@index');
Route::get('/userWithdrawal','UserWithdrawalController@index');
Route::get('/clearData','ClearDataController@index');

/* Route::group(['middleware' => ['auth']], function () {
        Route::resources([
                'login'=>'LoginUserController',
                'users' => 'UserController',  
                'admin' => 'AdminController',
                'sub_admin' => 'Sub_AdminController',
                'tournament' => 'TournamentController',
                'bots' => 'BotsController',
                'userWithdrawal'=>"UserWithdrawalController",
                'clearData'=>'ClearDataController'
            ]);
            Route::post('login/login','LoginUserController@login');
            Route::get('/dashboard','AdminController@index');
            Route::get('/walletuser','UserController@walletuser');
           
            Route::get('/money','UserController@money_pending');
            Route::get('/money/pending','UserController@money_pending');
            
            Route::get('/money/done','UserController@money_done');
            Route::get('/money/cancel','UserController@money_cancel');
            Route::get('money_request_edit/{id}','UserController@money_request_edit');
            Route::put('money_request_update/{id}','UserController@money_request_update');
            
            Route::post('/subadmin_create','Sub_AdminController@AddNewSubadmin');
            Route::get('/sub_admin_edit/{id}/edit','Sub_AdminController@sub_admin_edit');
            Route::put('/sub_admin_update/{id}','Sub_AdminController@sub_admin_update');
           

}); */

