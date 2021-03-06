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
  

Route::get('home', function() {
  return View::make('home');
});
//关于页面
Route::get('about', function(){
  return View::make('about');
});
//用户中心

//Route::get('users', 'App\Controllers\Users\UsersController@index');
Route::group(array('prefix' => 'users','before' => 'logged'), function ()
{

Route::any('/', 'App\Controllers\Users\UsersController@index');
Route::get('collects', 'App\Controllers\Users\UsersController@collects');
Route::get('editprofile', 'App\Controllers\Users\UsersController@editprofile');
Route::get('ccolleges', 'App\Controllers\Users\CollectsController@colleges');
//Route::get('/collects/others', 'App\Controllers\Users\UsersController@others');
//Route::get('/collects/specialites', 'App\Controllers\Users\UsersController@specialites');
Route::resource('matches', 'App\Controllers\Users\UsersController@matches');
Route::get('college', 'App\Controllers\Users\UsersController@college');
Route::resource('specialties', 'App\Controllers\Users\UsersController@specialties');
Route::resource('ktest', 'App\Controllers\Users\KtestController');
Route::resource('career', 'App\Controllers\Users\CareerController');
Route::resource('collects', 'App\Controllers\Users\CollectsController');
Route::post('collegesearch',[
		'as'=>'PostSpecialtiysearch',
		'uses'=>'App\Controllers\College\SearchController@collegesearch'
	]);
Route::post('collegelist',[
		'as'=>'collegelist',
		'uses'=>'App\Controllers\College\SearchController@collegelist'
	]);	
Route::get('spefilter/{filter}',[
		'as'=>'Specfilter',
		'uses'=>'App\Controllers\Users\UsersController@specfilter'
	]);
Route::get('colfilter/{filter}',[
		'as'=>'Colfilter',
		'uses'=>'App\Controllers\Users\UsersController@colfilter'
	]);
Route::get('colfreal/{filter}',[
		'as'=>'colfreal',
		'uses'=>'App\Controllers\Users\UsersController@colfreal'
	]);	
Route::get('careersearch/{id}',[
		'as'=>'careersearch',
		'uses'=>'App\Controllers\Users\CareerController@show'
	]); 
Route::get('cdestroy/{id}/delete',[
		'as'=>'cdestroy',
		'uses'=>'App\Controllers\Users\CollectsController@delete'
	]); 
Route::delete('cdestroy/{id}',[
		'as'=>'cdestroy',
		'uses'=>'App\Controllers\Users\CollectsController@cdestroy'
	]); 		
Route::get('videosearch/{careername}',[
		'as'=>'videosearch',
		'uses'=>'App\Controllers\Users\CareerController@video'
	]); 
Route::get('salarysearch/{careername}',[
		'as'=>'salarysearch',
		'uses'=>'App\Controllers\Users\CareerController@salary'
	]); 
Route::get('trendssearch/{careername}',[
		'as'=>'trendssearch',
		'uses'=>'App\Controllers\Users\CareerController@trends'
	]); 
Route::get('disssearch/{careername}',[
		'as'=>'disssearch',
		'uses'=>'App\Controllers\Users\CareerController@dis'
	]); 				
//ajax: add collect for college and career
Route::post( 'ajaxcollect', array(
    'as' => 'ajaxcollect',
    'uses' => 'App\Controllers\Users\CollectsController@ajaxcollect'
) );
//ajax: filter for the page
Route::post( 'ajaxfilter', array(
    'as' => 'ajaxfilter',
    'uses' => 'App\Controllers\Users\UsersController@ajaxfilter'
) );
//ajax: career filter for the page
Route::post( 'ajaxcareer', array(
    'as' => 'ajaxcareer',
    'uses' => 'App\Controllers\Users\UsersController@ajaxcareer'
) );	
//ajax: school filter for the page
Route::post( 'ajaxschool', array(
    'as' => 'ajaxcareer',
    'uses' => 'App\Controllers\Users\UsersController@ajaxschool'
) );	
//ajax: salary  for the page
Route::post( 'ajaxjson', array(
    'as' => 'ajaxjson',
    'uses' => 'App\Controllers\Users\CareerController@ajaxjson'
) );	
});	

 
//受管学校管理中心
//Route::get('gxadmin', 'App\Controllers\Gxadmin\GxadminController@index');

Route::group(array('prefix' => 'gxadmin'), function()
{
Route::any('/', 'App\Controllers\Gxadmin\GxadminController@index');
Route::resource('classes', 'App\Controllers\Gxadmin\ClassesController');
Route::resource('teachers', 'App\Controllers\Gxadmin\TeachersController');
Route::resource('grades', 'App\Controllers\Gxadmin\GradesController');
Route::resource('history', 'App\Controllers\Gxadmin\HistoryController');
Route::post('gradestore',[
		'as'=>'Gradestore',
		'uses'=>'App\Controllers\Gxadmin\GradesController@store'
	]);
Route::post('classestore',[
		'as'=>'Classestore',
		'uses'=>'App\Controllers\Gxadmin\ClassesController@store'
	]);	
Route::post('filestore',[
		'as'=>'Filestore',
		'uses'=>'App\Controllers\Gxadmin\StudentsController@excel'
	]);
});	


//教师管理中心

Route::group(array('prefix' => 'tcadmin'), function()
{
Route::any('/', 'App\Controllers\Tcadmin\TcadminController@index');
Route::resource('classes', 'App\Controllers\Tcadmin\ClassesController');
Route::resource('students', 'App\Controllers\Tcadmin\StudentsController');

Route::post('filestore',[
		'as'=>'Filestore',
		'uses'=>'App\Controllers\Tcadmin\StudentsController@excel'
	]);

//ajax: return student ktest
Route::post( 'ajaxktest', array(
    'as' => 'ajaxktest',
    'uses' => 'App\Controllers\Tcadmin\StudentsController@ajaxktest'
) );	
});	
  
 
//后台管理中心
//Route::get('gxadmin', 'App\Controllers\Gxadmin\GxadminController@index');

Route::group(array('prefix' => 'backend'), function()
{
//Route::any('/', 'App\Controllers\Gxadmin\GxadminController@index');
//Route::resource('classes', 'App\Controllers\Gxadmin\GxadminController');
//Route::resource('students', 'App\Controllers\Gxadmin\GxadminController');
Route::get('/', 'App\Controllers\Backend\BackendController@index');

Route::get('/dashboard/','App\Controllers\Backend\BackendController@index');
//{
	//return View::make('backend.dashboard');
//});
Route::resource('colleges','App\Controllers\Backend\CollegesController');
Route::resource('carticles','App\Controllers\Backend\BackendController@carticles');
Route::resource('specialties','App\Controllers\Backend\SpecialtiesController');
Route::resource('mschools','App\Controllers\Backend\MschoolesController');
Route::resource('ktests','App\Controllers\Backend\KtestsController');
Route::resource('careers','App\Controllers\Backend\CareersController');
Route::resource('zyjs','App\Controllers\Backend\FlzhuanyeController');
Route::post('syncktest',[
		'as'=>'Syncktest',
		'uses'=>'App\Controllers\Backend\KtestsController@syncktest'
	]);
	Route::post('getzylb',[
		'as'=>'SyncCoinfo',
		'uses'=>'App\Controllers\Backend\KtestsController@getzylb'
	]);
	Route::post('getcareers',[
		'as'=>'SyncCareerinfo',
		'uses'=>'App\Controllers\Backend\KtestsController@getcareers'
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
Route::post('specseach',[
		'as'=>'PostSpecialtiysearch',
		'uses'=>'App\Controllers\Specialtiy\SearchController@specsearch'
	]);
Route::get('showsspec/{specname}',[
		'as'=>'Showsspec',
		'uses'=>'App\Controllers\Specialtiy\SearchController@showsspec'
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
Route::get('cofilter/{filter}',[
		'as'=>'Cofilter',
		'uses'=>'App\Controllers\College\SearchController@cofilter'
	]);
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