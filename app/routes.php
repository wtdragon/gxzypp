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

Route::get('about', function(){
  return View::make('about')->with('number_of_cats', 9000);
});


Route::get('colleges', function(){
  $colleges = College::all();
  return View::make('colleges/index')
    ->with('colleges', $colleges);
});

Route::get('colleges/{id}', function($id) {
	$college = College::find($id);
  return View::make('colleges.single')
    ->with('college', $college);
});