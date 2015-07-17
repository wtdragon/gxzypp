<?php
namespace App\Controllers\Users;
 
use Area,City,College,Specialty,Province,UserProfile,Careersalay,Trend,Ctomajor,Kmajor,Kcresult,Careermajors,Careervideo,ProfileField,Zylb,Ktest,Kresult,Flzhuanye,Student,Career,Kcareer,Video,Collect;
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
		  
		  //$usercareers=Kcresult::where('userid','=',$loggeduser->id)->lists('careername');
		 // $collects=Ctomajor::whereIn('career_name_chinese', $usercareers)->paginate(20);
         
		   //$usercareers=Kcresult::where('userid','=',$loggeduser->id)->get();
		 //  $usercareers=Careermajors::distinct()->select('careername','id')->where('userid','=',$loggeduser->id)
                                      // ->groupBy('careername')->get(); 
		 //$collects=Ctomajor::distinct()->select('career_name_chinese,major_name_chinese,id')
		 //->whereraw('career_name_chinese = "$usercareers->careername"')
		 //->orderBy($usercareers->id)
		 //->paginate(20);
		  $collects=\DB::table(\DB::raw('ctomajors ,careermajors'))
           ->select('ctomajors.career_name_chinese', 'ctomajors.major_name_chinese', 'ctomajors.id')
           ->where('careermajors.userid',$loggeduser->id)
           ->whereraw('ctomajors.career_name_chinese=careermajors.careername')
           ->orderBy('careermajors.id')
           ->distinct()
           ->paginate(20);
          //$collects=Ctomajor::distinct()->select('career_name_chinese,major_name_chinese')->where('career_name_chinese','=', $usercareers->careername)->orderBy('$usercareers->id')->paginate(20);
          // $collects=\DB::select('SELECT DISTINCT a.career_name_chinese,a.major_name_chinese,a.id  FROM ctomajors a, (SELECT careername,id  FROM careermajors ORDER BY  id ) AS b WHERE  a.career_name_chinese=b.careername ORDER  BY b.id')->paginate(20);
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
		    $collects=Ctomajor::find($id);
          $kurl=$kclass->getkLsiUrl($kuserId);
		  $videoname=Kcareer::where('chinese_name','=',$collects->chinese_name)->first();
		  if($videoname){
			$video=Careervideo::where('ktitle','=',$videoname->kcvideo)->first();
		  }
else {
	$video=null;
}
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
	public function video($careername)
	      
{
	 
              
	            $loggeduser=\App::make('authenticator')->getLoggedUser();
		  if (array_key_exists('_student',$loggeduser->permissions))
		  { //var_dump($loginstudent);
	      $student=Student::whereraw("user_id = $loggeduser->id")->first();  
		  $ktest=Kresult::where('kuser_id','=',$student->kuser_id); 
		  $kclass=new Kclasses("singapore");
          $kuserId=$student->kuser_id;
		    $collects=Ctomajor::where('CAREER_NAME_CHINESE','=',$careername)->first();
		  $videoname=Kcareer::where('chinese_name','=',$careername)->first();
		  
			$video=Careervideo::where('ktitle','=',$videoname->kcvideo)->first();
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
		  // $kclass=new Kclasses("singapore");
          $kuserId=$student->kuser_id;
		   $area=Careersalay::distinct()->orderBy('chengshi', 'DESC')->lists('chengshi'); 
		    $collects=Ctomajor::where('career_name_chinese','=',$careername)
		                       ->first();
			$salary=Careersalay::search($careername)  
			 ->first();
			if($salary)
			{
			 preg_match_all("/(\d+|\d+[.,]\d{1,2})(?=\s*%)/",$salary->srsptu,$matches);
			 foreach(array_values(array_unique(array_flatten($matches))) as $salary2)
	      	 {
			 	if($salary2 < 100)
				{
					$sal[]=$salary2;
				}
			 }
			 preg_match_all('!\d+!',$salary->gzjygztj,$m2);
			 preg_match_all('!\d+!',$salary->lngzbh,$m3);
			
			 $exgzs=explode(',',$salary->gzjygztj);
			 foreach($exgzs as $exgz)
			 {
			 	if(strpos($exgz,"工资"))
				{
				  $awithkey[]=str_replace("工资","=>",$exgz);
				}
			 }
			 
			 $salary->gzjson=substr(json_encode($m2),1,-1);
			 $salary->lnjson=substr(json_encode($m3),1,-1);
    $salary->josn=json_encode($sal);
	// preg_match_all("/(\d+|\d+[.,]\d{1,2})(?=\s*%)/",$salary->srsptu,$m2);
			 
         
			}
			else {
				$salary=null;
			}
		return \View::make('users.career.salary')->with('user',$student)
		                                 ->with('area',$area)
										 ->with('collects',$collects)
										  ->with('salary',$salary);
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
public function trends($filter)
	      
{
	 
              
	       $loggeduser=\App::make('authenticator')->getLoggedUser();
		  if (array_key_exists('_student',$loggeduser->permissions))
		  { //var_dump($loginstudent);
	      $student=Student::whereraw("user_id = $loggeduser->id")->first();  
		  $ktest=Kresult::where('kuser_id','=',$student->kuser_id); 
		  // $kclass=new Kclasses("singapore");
          
	         $ktests=Ktest::where('user_id','=',$loggeduser->id)->get();
		$ktest1st=Ktest::where('user_id','=',$loggeduser->id)->first();
		$majorname=Kmajor::where('chinese_name','=',$filter)->first();    
		$zyjs=Flzhuanye::where('zymc','=',$majorname->real_zymc)->first();
        $careername=Ctomajor::where('major_name_chinese','=',$filter)->first();
		$real_career=Kcareer::where('chinese_name','=',$careername->career_name_chinese)->first();
		$trend=Trend::where('careername','=',$real_career->kcvideo)->first();
		if($trend)
		 {
		 	$trends=$trend;
		 }
		else
			{
				$trends=null;
			}
		$mzyjs= preg_replace("/。/", "。</p><p>", $zyjs->zyjs);
		$ktest1st->zyjs=$mzyjs;
 
		$ktest1st->zymc=$zyjs->zymc;
		$ktest1st->ezymc=$filter;
	     $configId = 104;  //lsi
         $accountId = 1000001;
         $yourDomain = "http://localhost:8000/users/ktest"; //change this to your server domain
         $bounceUrl = "https://api.keystosucceed.cn/setCookieAndBounce.php?returnUrl=$yourDomain";
         $kuserId=$student->kuser_id;
         $kurl = $bounceUrl . urlencode('?accountId='.$accountId.'&userId='.$kuserId.'&configId='.$configId);
		
		return \View::make('users.specialties.trends')->with('ktests',$ktests)
	                                                	->with('user',$student)
		                                                ->with('trends',$trends)
		                                               ->with('ktest1st',$ktest1st)
													      ->with('career',$careername) ;
						                 }
elseif(array_key_exists('_teacher',$loggeduser->permissions)){
	return Redirect::to('gxadmin');
}
else{
	return "not have permissions ";
}

 
		
	}
public function dis($filter)
	      
{
	 
              
	       $loggeduser=\App::make('authenticator')->getLoggedUser();
		  if (array_key_exists('_student',$loggeduser->permissions))
		  { //var_dump($loginstudent);
	      $student=Student::whereraw("user_id = $loggeduser->id")->first();  
		  $ktest=Kresult::where('kuser_id','=',$student->kuser_id); 
		  // $kclass=new Kclasses("singapore");
          
	         $ktests=Ktest::where('user_id','=',$loggeduser->id)->get();
		$ktest1st=Ktest::where('user_id','=',$loggeduser->id)->first();
		$majorname=Kmajor::where('chinese_name','=',$filter)->first();    
		$zyjs=Flzhuanye::where('zymc','=',$majorname->real_zymc)->first();
        $careername=Ctomajor::where('major_name_chinese','=',$filter)->first();
		$mzyjs= preg_replace("/。/", "。</p><p>", $zyjs->zyjs);
		$ktest1st->zyjs=$mzyjs;
 
		$ktest1st->zymc=$zyjs->zymc;
		$ktest1st->ezymc=$filter;
	     $configId = 104;  //lsi
         $accountId = 1000001;
         $yourDomain = "http://localhost:8000/users/ktest"; //change this to your server domain
         $bounceUrl = "https://api.keystosucceed.cn/setCookieAndBounce.php?returnUrl=$yourDomain";
         $kuserId=$student->kuser_id;
         $kurl = $bounceUrl . urlencode('?accountId='.$accountId.'&userId='.$kuserId.'&configId='.$configId);
		
		return \View::make('users.specialties.dis')->with('ktests',$ktests)
		->with('user',$student)
		                                               ->with('ktest1st',$ktest1st)
													      ->with('career',$careername) ;
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
	public function ajaxjson()
	{
		//  
		 header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
		header('Access-Control-Allow-Origin: *');
		$city= Input::get('City');
		$careername=Input::get('Careername');
		 
			$salary=Careersalay::search($careername)
			                     ->where('chengshi','=',$city)
			                     ->first();
	 
			if($salary)
			{
			 preg_match_all("/(\d+|\d+[.,]\d{1,2})(?=\s*%)/",$salary->srsptu,$matches);
			 foreach(array_values(array_unique(array_flatten($matches))) as $salary2)
	      	 {
			 	if($salary2 < 100)
				{
					 $sal[]=$salary2;
				}
			 }
			 preg_match_all('!\d+!',$salary->gzjygztj,$m2);
			 preg_match_all('!\d+!',$salary->lngzbh,$m3);
			
			 $exgzs=explode(',',$salary->gzjygztj);
			 foreach($exgzs as $exgz)
			 {
			 	if(strpos($exgz,"工资"))
				{
				  $awithkey[]=str_replace("工资","=>",$exgz);
				}
			 }
			 
			 $salary->gzjson=substr(json_encode($m2),1,-1);
			 $salary->lnjson=substr(json_encode($m3),1,-1);
			 if($sal){
    $salary->josn=json_encode($sal);
			 }
			 else {
				$salary->josn =null;
			 }
	// preg_match_all("/(\d+|\d+[.,]\d{1,2})(?=\s*%)/",$salary->srsptu,$m2);
			 
         
			}
			else {
				$salary=null;
			}
			 return \View::make('ajaxcharts')  ->with('salary',$salary);
	// preg_match_all("/(\d+|\d+[.,]\d{1,2})(?=\s*%)/",$salary->srsptu,$m2);
			 
 
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