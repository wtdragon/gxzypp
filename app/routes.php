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
//Route::get('users', 'App\Controllers\Users\UsersController@index');

Route::group(array('prefix' => 'users'), function()
{

Route::any('/', 'App\Controllers\Users\UsersController@index');
Route::get('collects', 'App\Controllers\Users\UsersController@collects');
Route::get('/collects/traing', 'App\Controllers\Users\UsersController@traing');
Route::get('/collects/colleges', 'App\Controllers\Users\UsersController@colleges');
Route::get('/collects/others', 'App\Controllers\Users\UsersController@others');
Route::get('/collects/specialites', 'App\Controllers\Users\UsersController@specialites');
Route::resource('matches', 'App\Controllers\Users\UsersController@matches');
Route::resource('specialties', 'App\Controllers\Users\UsersController@specialties');
Route::resource('ktest', 'App\Controllers\Users\KtestController');
Route::post('collegesearch',[
		'as'=>'PostSpecialtiysearch',
		'uses'=>'App\Controllers\College\SearchController@collegesearch'
	]);
});	

 
//志愿匹配
Route::get('matches', 'App\Controllers\Matches\MatchesController@index');

//培训信息
Route::get('trainings', function(){
  return View::make('trainings/index')->with('userid', $_COOKIE['userid']);
});
//专业信息

Route::group(array('prefix' => 'specialties'), function()
{

Route::any('/', 'App\Controllers\Specialtiy\SearchController@index');
Route::resource('search', 'App\Controllers\Specialtiy\SearchController');
Route::post('collegesearch',[
		'as'=>'PostSpecialtiysearch',
		'uses'=>'App\Controllers\College\SearchController@collegesearch'
	]);
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
Route::post('collegesearch',[
		'as'=>'Postcollegesearch',
		'uses'=>'App\Controllers\College\SearchController@collegesearch'
	]);
Route::get('cosearch/{id}',[
		'as'=>'Getcosearch',
		'uses'=>'App\Controllers\College\SearchController@showco'
	]);});	
 
//通用搜索
Route::get('search ', function(){
  return View::make('search/index')->with('userid', $_COOKIE['userid']);
});
//管理端
Route::get('gxadmin ', function(){
  return View::make('gxadmin/index')->with('userid', $_COOKIE['userid']);
});