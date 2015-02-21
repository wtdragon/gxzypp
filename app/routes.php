<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*Route::get('/', function() {
//  return Redirect::to("home");
//});
 * 
 */
Route::get('/', 'HomeController@showHome');
/*
 * 

 Route::get('/', function() {
  return Redirect::to("home");
});
  */
  

Route::group(array('prefix' => '/', 'before' => 'auth'), function()
{
//return View::make('home');
});
Route::get('home', function() {
  return View::make('home');
});
//关于页面
Route::get('about', function(){
  return View::make('about');
});
//用户中心
Route::get('users', function(){
  return View::make('users/index')->with('userid', $_COOKIE['userid']);
});
//志愿匹配
Route::get('matches', function(){
  return View::make('matches/index')->with('userid', $_COOKIE['userid']);
});
//培训信息
Route::get('trainings', function(){
  return View::make('trainings/index')->with('userid', $_COOKIE['userid']);
});
//专业信息
Route::get('specialties ', function(){
  return View::make('specialties/index')->with('userid', $_COOKIE['userid']);
});
//院校资讯
/*
Route::get('colleges', function(){
  $colleges = College::all();
  return View::make('colleges/index')
    ->with('colleges', $colleges);
});
*/

Route::group(array('prefix' => 'colleges'), function()
{
Route::any('/', 'App\Controllers\College\ArticlesController@index');
Route::resource('articles', 'App\Controllers\College\ArticlesController');
Route::resource('search', 'App\Controllers\College\SearchController');
});


//通用搜索
Route::get('search ', function(){
  return View::make('search/index')->with('userid', $_COOKIE['userid']);
});
//管理端
Route::get('admin ', function(){
  return View::make('admin/index')->with('userid', $_COOKIE['userid']);
});