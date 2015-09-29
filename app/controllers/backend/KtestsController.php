<?php
namespace App\Controllers\Backend;
 
use Area,City,College,Mschool,Province,UserProfile,Zylb,Specialty,Ctomajor,ProfileField,Ktest,Kresult,Kmajor,Kcareer,Teacher,Careermajors,Student;
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
	     $filters = array ('type'=>"asPortDWYAResult",'dwya_career_mode'=>8,'culture'=>'en_US');
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
			   //$career =  json_encode($de_json[$i]['Career']);
			  $str2=$result;
			 // $str2 = $hesClient-> unicode_decode($result, 'UTF-8', true, '\u', '');
//$str2 = iconv('GBK', 'UTF-8', $str2);
//var_dump($str2); 
			  //$text  = $hesClient->unicode_decode($result);
			 //$text=htmlspecialchars($result, ENT_NOQUOTES, "UTF-8");
			// $text=json_encode($text);
			
			  //$text = mb_convert_encoding($result, 'UTF-8', "auto");
			//$text=  current(json_decode(urldecode(json_encode([urlencode($result)]))));
              $finalresult2=json_decode($result);
              $czhuanye=array_keys(get_object_vars($finalresult2));
               foreach($finalresult2 as $mydata)
                {   
                 // $zhiye[]=array_keys(get_object_vars($mydata->Careers)); 
                 $zhiye[]=$mydata->Careers;
                   foreach($mydata as $key => $majors){
 	               $jstoarray=new JsonArrayHandle;
 	               $finalresult=$jstoarray->objectToArray($majors);
	                foreach($finalresult as $key => $value){
		                    $mayjors[]=json_encode($value['Majors']);
	                                                       }
	//$mayjors[] = $finalresult["Majors"];
 	//$mayjors[]=$finalresult['Majors'];
	 
                                                       }

                 }  
				
				
				 
				 $zhiye2=json_encode($zhiye);
               $czy=$hesClient-> unicode_decode(json_encode($czhuanye), 'UTF-8', true, '\u', '');
			   $ccn=$hesClient-> unicode_decode(json_encode($zhiye), 'UTF-8', true, '\u', '');
			   $mmn=$hesClient-> unicode_decode(json_encode($mayjors), 'UTF-8', true, '\u', '');
               
              
			 
			      $kresult = new Kresult;
                  $kresult->user_id = $userId;
                  $kresult->kuser_id=$kuserId;
                  $kresult->ktest_id=$ktest_id;
                  $kresult->type=$ktest_type;
                  $kresult->careerclusters=$str2;
				  $kresult->clustername=$czy;
				  //var_dump($career);
				 $kresult->careername=$zhiye2;
				  $kresult->majorsname=json_encode($mayjors);
				  $kresult->save();
			  
				  //foreach($mayjors as $mayjor)
				 // {
				  //	$mayjor=$hesClient-> unicode_decode($mayjor, 'UTF-8', true, '\u', '');
					//$specialties = Zylb::search($mayjor)->get();
				  //}
				 // var_dump($mayjors);
				 // var_dump($mayjor);
				 // var_dump($specialties);
                 // $kresult->save();
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
	 * Show the form for creating a new resource.
	 * GET /backend/backend/create
	 *
	 * @return Response
	 */
	public function getzylb()
	{
		//
		       $zylbs=Zylb::All();
		 
			   $ktest=\DB::table('ktests')->distinct()->lists('ktest_id');
			   
			   $kresults=Kresult::whereNotIn('ktest_id',$ktest)->get();
			   foreach($kresults as $kresult)
			   {   $engmajors=json_decode($kresult->majorsname);
			       $encareers=$kresult->careername;
			   $student=Student::where('user_id','=',$kresult->user_id)->first();
			 foreach($engmajors as $engmajor)
				   {	
				   	foreach(json_decode($engmajor) as $realmajor)
					{
						$kmajors=Kmajor::where('english_name','=',$realmajor)->get();
						foreach($kmajors as $kmajor)
						{
							 $ktests=new Ktest;
                             $ktests->kuser_id=$kresult->kuser_id;
		                     $ktests->kresult_id=$kresult->id;
		                     $ktests->ktest_id=$kresult->ktest_id;
		                     $ktests->user_id=$kresult->user_id;
		                     $ktests->stuid=$student->id;
							 $ylb=Zylb::where('zymingcheng','=',$kmajor->real_zymc)->first();
							 if($ylb and $ylb->coid !=0){
							  $ktests->co_id=$ylb->coid;
							  $ktests->zymc=$kmajor->real_zymc;  
							 }
                            
							  $ktests->save();
		                      $affectedRows = Ktest::where('zymc', '=', '')->delete();
			             }
			           }
			         }
				    $affectedRows = Ktest::where('co_id', '=', '0')->delete();

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
	 * Show the form for creating a new resource.
	 * GET /backend/backend/create
	 *
	 * @return Response
	 */
	public function getcareers()
	{
		//
		       
		 
			   $kcareer=\DB::table('careermajors')->distinct()->lists('kresult_id');
			   
			   $kresults=Kresult::whereNotIn('id',$kcareer)->get();
			   foreach($kresults as $kresult)
			   {    
			       $encareers=json_decode($kresult->careerclusters);
				   foreach($encareers as $encareer)
				   {
				   //$careers=array_keys(get_object_vars($encareer));
				    //  var_dump($career);
				   //$majors=$encareer->Majors;
				   
				 $careers=array_keys(get_object_vars($encareer->Careers));
				 //var_dump(array_keys(get_object_vars($encareer->Careers)));
		// $careers=$encareer->Career;
				   foreach($careers as $career)
				   {
				   	         
						   $careermajor=new Careermajors;
						   $careername=Ctomajor::where('career_name_english','=',$career)->first();
		                   $careermajor->careername=$careername->career_name_chinese;
		                
		                   $careermajor->userid=$kresult->user_id;
		                   $careermajor->kresult_id=$kresult->id;
						   $careermajor->save();
						   
						
					 
				   }
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
		$loggeduser=\App::make('authenticator')->getLoggedUser();
		$userinfo=\App::make('authenticator')->getUserById($loggeduser->id);
		$userprofile=UserProfile::find($loggeduser->id);
		return \View::make('backend.edit')->with('user',$userprofile)
		                                  ->with('college',null)
		                                  ->with('specialty', null)
										  ->with('carticle', null)
										  ->with('mschool', null)
										  ->with('ktests', Ktest::find($id));
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
			$ktest =Ktest::find($id);
$college = College::where('name','=',Input::get('collegename'))->first();
$ktest->co_id=$college->coid;
$ktest->zymc=Input::get('zymc');
$ktest->save();
//var_dump(Input::get('classname'));
Notification::success('更新成功！');
return Redirect::route('backend.ktests.index');	}

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