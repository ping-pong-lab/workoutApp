<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/phpinfo', function () {
    return view('phpinfo');
});


//----ログイン処理-------------
Route::get('/', 'logincontroller@showLoginPage');   // ログインページ表示
Route::post('/', 'logincontroller@login');    //ログイン処理
Route::get('/logout', 'logincontroller@logout')->middleware('login');    //ログアウト処理

Route::get('/signUp', 'logincontroller@showSignUpPage');    //新規登録ページ表示
Route::post('/signUp', 'logincontroller@signUp');    //登録フォームチェックとDB登録

Route::get('/forgetPass', 'logincontroller@forgetPass'); //パス再登録ページ メール入力
Route::post('/forgetPass', 'logincontroller@sendMail');  //メール送信
Route::get('/forgetPass/registration','logincontroller@registration');//パス再登録ページ
Route::post('/forgetPass/registration', 'logincontroller@passUpdate');  //メール送信

//----ユーザーページ-------------
Route::get('/user','usercontoroller@userHome')->middleware('login'); //ユーザーホーム表示
Route::get('/user/getLog','usercontoroller@getLog');    //表示用Log取得
Route::get('/user/getEditLog','usercontoroller@getEditLog');    //編集用Log取得
Route::get('/user/clender/{ym}','usercontoroller@calender');    //カレンダー用作成
Route::post('/user/log','usercontoroller@calender');    //Logカレンダー表示
Route::post('/user/upLog','usercontoroller@upLog');    //Log更新
Route::post('/user/delLog','usercontoroller@delLog');    //Log削除

Route::post('/user/addHabit','usercontoroller@addHabit');    //フォームcheck＋新規Habit登録
Route::post('/user/addLog','usercontoroller@addLog');    //Logに記録
Route::post('/user/upHabbit','usercontoroller@updateHabbit');    //Habbit更新
Route::post('/user/delHabbit','usercontoroller@deleteHabbit');    //Habbit削除

//----ユーザ－情報ページ-------------
Route::get('/userInfo','userInfocontroller@page')->middleware('login'); //ユーザー情報ページ表示
Route::get('/userInfo/updateUserInfo','userInfocontroller@updatepage')->middleware('login'); //ユーザー情報更新ページ表示
Route::post('/userInfo/update','userInfocontroller@update'); //ユーザー情報更新
Route::get('/userInfo/deleteUserInfo','userInfocontroller@deletepage')->middleware('login'); //退会確認ページ表示
Route::post('/userInfo/delete','userInfocontroller@delete'); //ユーザー情報削除
