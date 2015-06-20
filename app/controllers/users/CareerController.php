<?php
namespace App\Controllers\Users;
 
use Area,City,College,Specialty,Province,UserProfile,Careermajors,Careervideo,ProfileField,Zylb,Ktest,Kresult,Flzhuanye,Student,Career,Video,Collect;
use Input, Notification, Redirect, Sentry, Str;

use App\Services\Validators\PageValidator;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;
use App\Services\Ktest\Kclasses;
use App\Services\Sclass\JsonArrayHandle;
use SoapBox\Formatter\Formatter;

class CareerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /users/career
	 *
	 * @return Response
	 */

	public function index()
{         
	      $loggeduser=\App::make('authenticator')->getLoggedUser();
		  if (array_key_exists('_student',$loggeduser->permissions))
		  { //var_dump($loginstudent);
	      $student=Student::whereraw("user_id = $loggeduser->id")->first();  
		  $ktest=Kresult::where('kuser_id','=',$student->kuser_id); 
		  $kclass=new Kclasses("singapore");
          $kuserId=$student->kuser_id;
		  
				   $collects=Careermajors::where('userid','=',$loggeduser->id)->take(200)->paginate(20);
			 
          $kurl=$kclass->getkLsiUrl($kuserId);
         if ($ktest->count())
	       {
	       	 
          $kresult=$kclass->getkResultUrl($kuserId);
		 
			
			 }   
		else {
			$kresult="你还没做过测试";
		 
		}
       	
		return \View::make('users.career.index')->with('user',$student)
		                                 ->with('kurl',$kurl)
										 ->with('collects',$collects)
						                 ->with('kresult',$kresult);
						                 }
elseif(array_key_exists('_teacher',$loggeduser->permissions)){
	return Redirect::to('gxadmin');
}
else{
	return "not have permissions ";
}

 
		
	}

/**
	 * Display a listing of the resource.
	 * GET /users/career
	 *
	 * @return Response
	 */
	public function show($id)
	      
{
	 
              
	            $loggeduser=\App::make('authenticator')->getLoggedUser();
		  if (array_key_exists('_student',$loggeduser->permissions))
		  { //var_dump($loginstudent);
	      $student=Student::whereraw("user_id = $loggeduser->id")->first();  
		  $ktest=Kresult::where('kuser_id','=',$student->kuser_id); 
		  $kclass=new Kclasses("singapore");
          $kuserId=$student->kuser_id;
		    $collects=Careermajors::find($id);
          $kurl=$kclass->getkLsiUrl($kuserId);
         if ($ktest->count())
	       {
	       	 
          $kresult=$kclass->getkResultUrl($kuserId);
		 
			
			 }   
		else {
			$kresult="你还没做过测试";
		 
		}
       	
		return \View::make('users.career.show')->with('user',$student)
		                                 ->with('kurl',$kurl)
										 ->with('collects',$collects)
						                 ->with('kresult',$kresult);
						                 }
elseif(array_key_exists('_teacher',$loggeduser->permissions)){
	return Redirect::to('gxadmin');
}
else{
	return "not have permissions ";
}

 
		
	}

/**
	 * Display a listing of the resource.
	 * GET /users/career
	 *
	 * @return Response
	 */
	public function video($careername)
	      
{
	 
              
	            $loggeduser=\App::make('authenticator')->getLoggedUser();
		  if (array_key_exists('_student',$loggeduser->permissions))
		  { //var_dump($loginstudent);
	      $student=Student::whereraw("user_id = $loggeduser->id")->first();  
		  $ktest=Kresult::where('kuser_id','=',$student->kuser_id); 
		  $kclass=new Kclasses("singapore");
          $kuserId=$student->kuser_id;
		    $collects=Careermajors::where('careername','=',$careername)->first();
			$video=Careervideo::where('ktitle','=',$careername)->first();
          $kurl=$kclass->getkLsiUrl($kuserId);
         if ($ktest->count())
	       {
	       	 
          $kresult=$kclass->getkResultUrl($kuserId);
		 
			
			 }   
		else {
			$kresult="你还没做过测试";
		 
		}
       	
		return \View::make('users.career.video')->with('user',$student)
		                                 ->with('kurl',$kurl)
										 ->with('collects',$collects)
										  ->with('video',$video)
						                 ->with('kresult',$kresult);
						                 }
elseif(array_key_exists('_teacher',$loggeduser->permissions)){
	return Redirect::to('gxadmin');
}
else{
	return "not have permissions ";
}

 
		
	}
/**
	 * Display a listing of the resource.
	 * GET /users/career
	 *
	 * @return Response
	 */
	public function salary($careername)
	      
{
	 
              
	            $loggeduser=\App::make('authenticator')->getLoggedUser();
		  if (array_key_exists('_student',$loggeduser->permissions))
		  { //var_dump($loginstudent);
	      $student=Student::whereraw("user_id = $loggeduser->id")->first();  
		  $ktest=Kresult::where('kuser_id','=',$student->kuser_id); 
		  $kclass=new Kclasses("singapore");
          $kuserId=$student->kuser_id;
		    $collects=Careermajors::where('careername','=',$careername)->first();
			$video=Careervideo::where('ktitle','=',$careername)->first();
          $kurl=$kclass->getkLsiUrl($kuserId);
         if ($ktest->count())
	       {
	       	 
          $kresult=$kclass->getkResultUrl($kuserId);
		 
			
			 }   
		else {
			$kresult="你还没做过测试";
		 
		}
       	
		return \View::make('users.career.salary')->with('user',$student)
		                                 ->with('kurl',$kurl)
										 ->with('collects',$collects)
										  ->with('video',$video)
						                 ->with('kresult',$kresult);
						                 }
elseif(array_key_exists('_teacher',$loggeduser->permissions)){
	return Redirect::to('gxadmin');
}
else{
	return "not have permissions ";
}

 
		
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/career/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users/career
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	 
	/**
	 * Show the form for editing the specified resource.
	 * GET /users/career/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/career/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/career/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}