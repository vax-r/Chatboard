<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
    return view('welcome');
});


Route::get("/",["as" => "index", "uses" => "FeedbackController@index"]);//訪問入口
Route::post("/store",["as" => "store", "uses" => "FeedbackController@store"]);//儲存留言
Route::delete("/{id}",["as" => "destroy", "uses" => "FeedbackController@destroy"]);//刪除留言
Route::get("/{id}/edit", ["as" => "edit", "uses" => "FeedbackController@edit"]);//編輯留言
Route::put("/{id}", ["as" => "update", "uses" => "FeedbackController@update"]);//更新留言紀錄