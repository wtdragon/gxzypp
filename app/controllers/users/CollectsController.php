<?php
namespace App\Controllers\Users;
 
use Area,City,College,Specialty,Province,UserProfile,Ctomajor,ProfileField,Zylb,Careermajors,Ktest,Kresult,Flzhuanye,Student,Career,Collect;
use Input, Notification, Redirect, Sentry, Str;

use App\Services\Validators\PageValidator;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;
use App\Services\Ktest\Kclasses;
use App\Services\Sclass\JsonArrayHandle;
use SoapBox\Formatter\Formatter;

class CollectsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /users/career
	 *
	 * @return Response
	 */
	public function index()
{            $loggeduser=\App::make('authenticator')->getLoggedUser();
		  if (array_key_exists('_student',$loggeduser->permissions))
		  { //var_dump($loginstudent);
	      $student=Student::whereraw("user_id = $loggeduser->id")->first();  
		  $ktest=Kresult::where('kuser_id','=',$student->kuser_id); 
		  $kclass=new Kclasses("singapore");
          $kuserId=$student->kuser_id;
		  $collects=Collect::where('userid','=',$loggeduser->id)->paginate(20);
		  $area=Province::distinct()->lists('pname');
		  $careerid=Collect::where('userid','=',$loggeduser->id)
		                     ->where('careerid','!=',0)->lists('careerid');
		  $coid=Collect::where('userid','=',$loggeduser->id)
		                     ->where('coid','!=',0)->lists('coid');
		  $fcareer=Ctomajor::whereIn('career_id', $careerid)->first();
	      $careers=Ctomajor::whereIn('career_id', $careerid)->paginate(20);
          
		  $fcollge=Zylb::whereIn('coid',$coid)->first();
	      $colleges=Zylb::whereIn('coid',$coid)->paginate(20);
		
          $kurl=$kclass->getkLsiUrl($kuserId);
         if ($ktest->count())
	       {
	       	 
          $kresult=$kclass->getkResultUrl($kuserId);
		 
			
			 }   
		else {
			$kresult="你还没做过测试";
		 
		}
       	
		return \View::make('users.collects.index')->with('user',$student)
		                                 ->with('kurl',$kurl)
										 ->with('collects',$collects)
										  ->with('careers',$careers)
										  ->with('area',$area)
										   ->with('fcareer',$fcareer)
										    ->with('fcollge',$fcollge)
											 ->with('zylbs',$colleges)
						                 ->with('kresult',$kresult);
						                 }
elseif(array_key_exists('_teacher',$loggeduser->permissions)){
	return Redirect::to('gxadmin');
}
else{
	return "not have permissions ";
}

 
		
	}
public function colleges()
{            $loggeduser=\App::make('authenticator')->getLoggedUser();
		  if (array_key_exists('_student',$loggeduser->permissions))
		  { //var_dump($loginstudent);
	      $student=Student::whereraw("user_id = $loggeduser->id")->first();  
		  $ktest=Kresult::where('kuser_id','=',$student->kuser_id); 
		  $kclass=new Kclasses("singapore");
          $kuserId=$student->kuser_id;
		  $collects=Collect::where('userid','=',$loggeduser->id)->paginate(20);
		  $area=Province::distinct()->lists('pname');
		  $careerid=Collect::where('userid','=',$loggeduser->id)
		                     ->where('careerid','!=',0)->lists('careerid');
		  $coid=Collect::where('userid','=',$loggeduser->id)
		                     ->where('coid','!=',0)->lists('coid');
		  					 
		  $ffcoid=Collect::where('userid','=',$loggeduser->id)
		                     ->where('coid','!=',0)->first();
		  $fcareer=Ctomajor::whereIn('career_id', $careerid)->first();
	      $careers=Ctomajor::whereIn('career_id', $careerid)->paginate(20);
          
		  $fcollge=Zylb::whereIn('coid',$coid)->first();
	      $colleges=Zylb::whereIn('coid',$coid)->paginate(20);
		  $collegenames=Zylb::distinct()->select('yxmc', 'coid')->whereIn('coid',$coid)->get();
		  
		 
 
    $zylbs = \DB::table('zylb')
    ->join('kmajors', 'zylb.zymingcheng', '=', 'kmajors.real_zymc')
    ->join('ctomajors', 'kmajors.english_name', '=', 'ctomajors.major_name_english')
    ->where('zylb.coid', '=', $ffcoid->coid)
    ->whereraw('english_name IS NOT NULL')
	->groupBy('career_name_chinese')
      ->distinct()->paginate(10);
		  
          $kurl=$kclass->getkLsiUrl($kuserId);
         if ($ktest->count())
	       {
	       	 
          $kresult=$kclass->getkResultUrl($kuserId);
		 
			
			 }   
		else {
			$kresult="你还没做过测试";
		 
		}
       	
		return \View::make('users.collects.colleges')->with('user',$student)
		                                 ->with('kurl',$kurl)
										 ->with('collects',$collects)
										  ->with('careers',$careers)
										  ->with('area',$area)
										   ->with('zylbs',$zylbs)
										    ->with('collegenames',$collegenames)
										   ->with('fcareer',$fcareer)
										    ->with('fcollge',$fcollge) 
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
	 *  ajax ktest data.
	 * GET /tcadmin/tcadmin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function ajaxcollect()
	{
		header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
		$coid= Input::get('coid');
		$realcoid=strstr($coid,'c');
		if($realcoid)
		{
	     $coid2=substr($coid, 1);    
		$collect=Collect::where('coid','=',$coid2)->get();
	    if($collect->count())
		 {
	       	 $kurl='收藏过了';
			 	return $kurl;
			 }
          else {
	            $loggeduser=\App::make('authenticator')->getLoggedUser();
				$newcollect=new Collect;
				$newcollect->userid=$loggeduser->id;
				$newcollect->coid=$coid2;
				$newcollect->save();
				$kurl='收藏成功';
					return $kurl;
			    
                }
		}
		else {
			$careerid= Input::get('coid');
			$collect=Collect::where('careerid','=',$careerid)->get();
			if($collect->count())
		      {
	       	 $kurl='收藏过了';
			 return $kurl;
			 }
               else {
	            $loggeduser=\App::make('authenticator')->getLoggedUser();
				$newcollect=new Collect;
				$newcollect->userid=$loggeduser->id;
				$newcollect->careerid=$careerid;
				$newcollect->save();
				$kurl='收藏成功';
				return $kurl;
			    
}
		}
		
		 
		 
        
	   
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
	 * Display the specified resource.
	 * GET /users/career/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
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