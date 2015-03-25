<?php
namespace App\Controllers\Backend;
 
use Area,City,College,Mschool,Province,UserProfile,ProfileField,Ktest,Kresult,Teacher,Student;
use Input, Notification, Redirect, Sentry, Str;

use App\Services\Validators\PageValidator;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;
use App\Services\Sclass\JsonArrayHandle;
use SoapBox\Formatter\Formatter;

class KtestsController extends \BaseController {

	
	/**
	 * Display a listing of the resource.
	 * GET /backend/backend
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$loggeduser=\App::make('authenticator')->getLoggedUser();
		
		//var_dump($userinfo);
		//var_dump($userprofile->first_name);
		    if($loggeduser)
			{
		     $userinfo=\App::make('authenticator')->getUserById($loggeduser->id);
		     $userprofile=UserProfile::find($loggeduser->id);
			 $pre_page = 20;//每页显示页数
		     $ktests = Ktest::paginate($pre_page);
			 
		     return \View::make('backend.ktests')->with('user',$userprofile)
			                                       ->with('ktests',$ktests);
			}
			else{
		 	$logged='not login';
		   	return \View::make('users.login');
		}
	}
			/**
	 * Display a listing of the resource.
	 * GET /backend/backend
	 *
	 * @return Response
	 */
	public function carticles()
	{
		//
		$loggeduser=\App::make('authenticator')->getLoggedUser();
		
		//var_dump($userinfo);
		//var_dump($userprofile->first_name);
		    if($loggeduser)
			{
				$userinfo=\App::make('authenticator')->getUserById($loggeduser->id);
		$userprofile=UserProfile::find($loggeduser->id);
		return \View::make('backend.carticles')->with('user',$userprofile);
			}
			else{
		 	$logged='not login';
		   	return \View::make('users.login');
		}
	}
				/**
	 * Display a listing of the resource.
	 * GET /backend/backend
	 *
	 * @return Response
	 */
	public function syncktest()
	{
		 $students=Student::ALL();
		 $accountId = 1000001;
	     $accountKey = "deI%2BKwrnkhenLX"; 
         $accountPassword = "d1SLnDVAbxKxOid5"; 
         $environment = "singapore";
		 foreach($students  as $student)
		 {
		 $hesClient = new HesClient($environment);
	     $filters = array ('type'=>"asPortDWYAResult",'dwya_career_mode'=>8);
         $nonce=$hesClient->handshake($accountId,$accountPassword,$accountKey);
		 $kuserId = $student->kuser_id;
		 $userId= $student->user_id;
		 $kresult=$hesClient->listResults($accountId, $kuserId, $nonce, $filters);
         $de_json = json_decode($kresult,true);
	     $count_json = count($de_json);
		    for ($i = 0; $i < $count_json; $i++)
             {      
	          $ktest_id = $de_json[$i]['id'];
              $ktest_type = $de_json[$i]['type'];
	          $ktest_userid = $de_json[$i]['user_id'];
              $result =  json_encode($de_json[$i]['CareerClusters']);
			   $kresult = new Kresult;
                  $kresult->user_id = $userId;
                   $kresult->kuser_id=$kuserId;
                  $kresult->ktest_id=$ktest_id;
                  $kresult->type=$ktest_type;
                  $kresult->careerclusters=$result;
                   $kresult->save();
			 }	   
				   
		 }
		
	   Notification::success('成功！');
		 $loggeduser=\App::make('authenticator')->getLoggedUser();
		    $userinfo=\App::make('authenticator')->getUserById($loggeduser->id);
		     $userprofile=UserProfile::find($loggeduser->id);
			 $pre_page = 20;//每页显示页数
		     $ktests = Ktest::paginate($pre_page);
			 
		     return \View::make('backend.ktests')->with('user',$userprofile)
			                                       ->with('ktests',$ktests);
			 
        
	}
			/**
	 * Display a listing of the resource.
	 * GET /backend/backend
	 *
	 * @return Response
	 */
	public function specialties()
	{
		//
		$loggeduser=\App::make('authenticator')->getLoggedUser();
		
		//var_dump($userinfo);
		//var_dump($userprofile->first_name);
		    if($loggeduser)
			{
				$userinfo=\App::make('authenticator')->getUserById($loggeduser->id);
		$userprofile=UserProfile::find($loggeduser->id);
		return \View::make('backend.specialties')->with('user',$userprofile);
			}
			else{
		 	$logged='not login';
		   	return \View::make('users.login');
		}
	}
	/**
	 * Show the form for creating a new resource.
	 * GET /backend/backend/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /backend/backend
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		
	}

	/**
	 * Display the specified resource.
	 * GET /backend/backend/{id}
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
	 * GET /backend/backend/{id}/edit
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
	 * PUT /backend/backend/{id}
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
	 * DELETE /backend/backend/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}