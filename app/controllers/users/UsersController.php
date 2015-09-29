<?php

namespace App\Controllers\Users;
 
use Area,City,College,Specialty,Province,Kcresult,Ctomajor,Kmajor,UserProfile,ProfileField,Zylb,Ktest,Kresult,Flzhuanye,Careermajors,Student,Collect;
use Input, Notification, Redirect, Sentry, Str;

use App\Services\Validators\PageValidator;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;
use App\Services\Ktest\Kclasses;
use App\Services\Sclass\JsonArrayHandle;
use SoapBox\Formatter\Formatter;

class UsersController extends \BaseController {
		
	
 

	public function index()
{
        	  $loggeduser=\App::make('authenticator')->getLoggedUser();
		  if (array_key_exists('_student',$loggeduser->permissions))
		  { //var_dump($loginstudent);
	      $student=Student::whereraw("user_id = $loggeduser->id")->first();  
		  $ktest=Kresult::where('kuser_id','=',$student->kuser_id); 
		  //$configId = 104;  //lsi
          //$accountId = 1000001;
          //$yourDomain = "http://localhost:8000/users/ktest"; //change this to your server domain
          //$bounceUrl = "https://api.keystosucceed.cn/setCookieAndBounce.php?returnUrl=$yourDomain";
          $kclass=new Kclasses("singapore");
          $kuserId=$student->kuser_id;
          //$kurl = $bounceUrl . urlencode('?accountId='.$accountId.'&userId='.$kuserId.'&configId='.$configId);
		 $kurl=$kclass->getkLsiUrl($kuserId);
         if ($ktest->count())
	       {
	       	
			//$accountId = 1000001;
	//	$accountId = $_GET['accountId'];
       // $userId = $student->kuser_id;
        // $configId = 104;  //lsi

       // $accountKey = "deI%2BKwrnkhenLX"; 
       // $accountPassword = "d1SLnDVAbxKxOid5"; 

       // $environment = "singapore";

       // $hesClient = new HesClient($environment);
       // $nonce = $hesClient->handshake($accountId, $accountPassword, $accountKey);
 
       // $userId = $hesClient->encryptMe($userId, $accountKey);
        //$fullLoginUrl = $hesClient->getLoginUrl($accountId, $configId, $userId, $nonce);
        //$kresult = $hesClient->getLoginUrl($accountId, $configId, $userId, $nonce); 
          $kresult=$kclass->getkResultUrl($kuserId);
		//$ch = curl_init();
//$timeout = 5;
//curl_setopt ($ch, CURLOPT_URL, $kurl);
//curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  
			 
			
			 }   
		else {
			$kresult="你还没做过测试";
		  //change this to the humanesources userId you have created with the api
		}
       	
		return \View::make('users.index')->with('user',$student)
		                                 ->with('kurl',$kurl)
						                 ->with('kresult',$kresult);
						                 }
elseif(array_key_exists('_teacher',$loggeduser->permissions)){
	return Redirect::to('gxadmin');
}
else{
	return "not have permissions ";
}

		 //  }
	//	else {
		 //	$logged='not login';
		   //	return \View::make('users.login');
		//}//
		
	}
 
	/**
	 * Store a newly created resource in storage.
	 * POST /college/articles
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}
    public function collects()
	{
		//
		//
		$inputData = Input::get('specialty'); 
		$specialty = $inputData;
		$provinces=Province::All();
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $pre_page = 20;//每页显示页数
		$schools = Specialty::search($specialty)->paginate(20);
		$provinces=Province::All();
		return \View::make('users.collects.index');
	}
	 public function colleges()
	{
		//
		//
		$inputData = Input::get('specialty'); 
		$specialty = $inputData;
		$provinces=Province::All();
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $pre_page = 20;//每页显示页数
		$schools = Specialty::search($specialty)->paginate(20);
		$provinces=Province::All();
		return \View::make('users.collects.colleges');
	}
	 public function others()
	{
		//
		//
		$inputData = Input::get('specialty'); 
		$specialty = $inputData;
		$provinces=Province::All();
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $pre_page = 20;//每页显示页数
		$schools = Specialty::search($specialty)->paginate(20);
		$provinces=Province::All();
		return \View::make('users.collects.others');
	}
	 public function specialites()
	{
		$inputData = Input::get('specialty'); 
		$specialty = $inputData;
		$provinces=Province::All();
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $pre_page = 20;//每页显示页数
		$schools = Specialty::search($specialty)->paginate(20);
		$provinces=Province::All();
		return \View::make('users.collects.specialites');
		
	}
	 public function training()
	{
		//
		//
		$inputData = Input::get('specialty'); 
		$specialty = $inputData;
		$provinces=Province::All();
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $pre_page = 20;//每页显示页数
		$schools = Specialty::search($specialty)->paginate(20);
		$provinces=Province::All();
		return \View::make('users.collects.training');
	}
    // for colleges use ktest
	  public function matches()
	{
		//
		//
		 $loggeduser=\App::make('authenticator')->getLoggedUser();
		
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
   		$student=Student::whereraw("user_id = $loggeduser->id")->first();  
         
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $ktests=Ktest::distinct()->select('co_id','id')->where('user_id','=',$loggeduser->id)
                                                       ->groupBy('co_id')->get();
        foreach($ktests as $ktest)
		{
			$colleges=College::where('coid','=',$ktest->co_id)->get();
		}
	   // $areaid=College::distinct()->select('provinceID')->whereIN('coid','=',$ktests->co_id->toArray())->get();
	    $student=Student::whereraw("user_id = $loggeduser->id")->first();  
		$ktest1st=Ktest::whereraw("user_id = $loggeduser->id")->first();
		$usercareers=Careermajors::where('userid','=',$loggeduser->id)->lists('careername');
       $taketf=Careermajors::where('userid','=',$loggeduser->id)->take(25)->lists('careername');
		$careername=Ctomajor::whereIn('career_name_chinese', $usercareers)->paginate(20);
                                                
		//var_dump($cama);
		//$ca=array_unique($cama->careername);
	    $kclass=new Kclasses("singapore");
		$area=Province::distinct()->lists('pname');
          $kuserId=$student->kuser_id;
          //$kurl = $bounceUrl . urlencode('?accountId='.$accountId.'&userId='.$kuserId.'&configId='.$configId);
		 $kurl=$kclass->getkLsiUrl($kuserId);
			if(!$ktest1st)
		{
			$kresult="你还没做过测试";
				return \View::make('users.index')->with('user',$student)
		                                 ->with('kurl',$kurl)
										 ->with('area',$area)
						                 ->with('kresult',$kresult);
						                 } 
else{
		
		
		$cname=Careermajors::where('userid','=',$loggeduser->id)->first();
	    $major=Ctomajor::where('career_name_chinese','=',$cname->careername)->lists('major_name_chinese');
	 
		$realmajor=Kmajor::whereIn('chinese_name',$major)->lists('real_zymc');
	 
		$collegename=Zylb::where('coid','=',$ktest1st->coid)->distinct()->first();
        $zylbs =Zylb::search($ktest1st->co_id)->distinct()->paginate(10);
        $usezylbs = Zylb::whereIn('zymingcheng',$realmajor)->paginate(10);
	 
		return \View::make('users.matches.index')->with('ktests',$ktests)
		->with('user',$student)
		->with('area',$area)
		 ->with('careers',$careername)
		 		 ->with('cname',$cname)
		 ->with('usercareer',$taketf)
		                                             ->with('ktest1st',$ktest1st)
		                                             ->with('zylbs',$usezylbs);
	}
	}
   	  public function college()
	{
		  $loggeduser=\App::make('authenticator')->getLoggedUser();
		
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
   		$student=Student::whereraw("user_id = $loggeduser->id")->first();  
         
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $ktests=Ktest::distinct()->select('co_id','id')->where('user_id','=',$loggeduser->id)
                                                       ->groupBy('co_id')->get();
        foreach($ktests as $ktest)
		{
			$areaid[]=College::distinct()->select('pid')->where('coid','=',$ktest->co_id)->pluck('pid');
		}
	   // $areaid=College::distinct()->select('provinceID')->whereIN('coid','=',$ktests->co_id->toArray())->get();
	    $student=Student::whereraw("user_id = $loggeduser->id")->first();  
		$ktest1st=Ktest::whereraw("user_id = $loggeduser->id")->first();
		$usercareers=Kcresult::where('userid','=',$loggeduser->id)->lists('careername');
 
		$careername=Ctomajor::whereIn('career_name_chinese', $usercareers)->paginate(20);;
                                                
		//var_dump($cama);
		//$ca=array_unique($cama->careername);
	    $kclass=new Kclasses("singapore");
		$area=Province::whereIn('pid',$areaid)->lists('pname');
          $kuserId=$student->kuser_id;
          //$kurl = $bounceUrl . urlencode('?accountId='.$accountId.'&userId='.$kuserId.'&configId='.$configId);
		 $kurl=$kclass->getkLsiUrl($kuserId);
			if(!$ktest1st)
		{
			$kresult="你还没做过测试";
				return \View::make('users.index')->with('user',$student)
		                                 ->with('kurl',$kurl)
										 ->with('area',$area)
						                 ->with('kresult',$kresult);
						                 } 
else{
		
		
		
		$collegename=Zylb::where('coid','=',$ktest1st->coid)->distinct()->first();
	    
         $zylbs = \DB::table('zylb')
    ->join('kmajors', 'zylb.zymingcheng', '=', 'kmajors.real_zymc')
    ->join('ctomajors', 'kmajors.english_name', '=', 'ctomajors.major_name_english')
    ->where('zylb.coid', '=', $ktest1st->co_id)
    ->whereraw('english_name IS NOT NULL')
	->groupBy('career_name_chinese')
      ->distinct()->paginate(10);
        
		return \View::make('users.college.index')->with('ktests',$ktests)
		->with('user',$student)
		->with('area',$area)
		 ->with('careers',$careername)
		                                             ->with('ktest1st',$ktest1st)
		                                             ->with('zylbs',$zylbs);
	}
    }

   // college search use spec name for filter
      public function specfilter($filter)
	{
		//
		//
			 
		 $loggeduser=\App::make('authenticator')->getLoggedUser();
			$collegename=$filter;
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
   		$student=Student::whereraw("user_id = $loggeduser->id")->first();  
         
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //     
         $area=Province::distinct()->lists('pname');                                   
       $ktests=Ktest::distinct()->select('co_id','id')->where('user_id','=',$loggeduser->id)->groupBy('co_id')->get();
	    $configId = 104;  //lsi
        $accountId = 1000001;
        $yourDomain = "http://localhost:8000/users/ktest"; //change this to your server domain
        $bounceUrl = "https://api.keystosucceed.cn/setCookieAndBounce.php?returnUrl=$yourDomain";
        $kuserId=$student->kuser_id;
		//$ktest1st=Zylb::where('coid','=',$collegename)->first();
		  
        //$zylbs =Zylb::where('coid','=',$collegename)->distinct()->paginate(10);
        $ktest1st=Zylb::where('yxmc','=',$collegename)->first();
		  
        $zylbs =Zylb::where('yxmc','=',$collegename)->distinct()->paginate(10);
        
		return \View::make('users.matches.show') 
		                                              ->with('user',$student) 
		                                             ->with('ktest1st',$ktest1st)
		                                             ->with('zylbs',$zylbs) 
		                                             ->with('area',$area);
	 
	}
   // get spec use ktest
	  public function colfilter($filter)
	{
		//
		//
		 $loggeduser=\App::make('authenticator')->getLoggedUser();
		 $student=Student::whereraw("user_id = $loggeduser->id")->first();  
         
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $ktests=Ktest::where('user_id','=',$loggeduser->id)->get();
		$ktest1st=Ktest::where('user_id','=',$loggeduser->id)->first();
		$majorname=Kmajor::where('chinese_name','=',$filter)->first(); 
	 
		$zyjs=Flzhuanye::where('zymc','=',$majorname->real_zymc)->first();
		$careername=Ctomajor::where('major_name_chinese','=',$filter)->first();
		$mzyjs= preg_replace("/。/", "。</p><p>", $zyjs->zyjs);
		$ktest1st->zyjs=$mzyjs;
          $area=Province::distinct()->lists('pname');   
		$ktest1st->zymc=$zyjs->zymc;
		$ktest1st->ezymc=$filter;
		 
    
	     $configId = 104;  //lsi
         $accountId = 1000001;
         $yourDomain = "http://localhost:8000/users/ktest"; //change this to your server domain
         $bounceUrl = "https://api.keystosucceed.cn/setCookieAndBounce.php?returnUrl=$yourDomain";
         $kuserId=$student->kuser_id;
         $kurl = $bounceUrl . urlencode('?accountId='.$accountId.'&userId='.$kuserId.'&configId='.$configId);
		
		if(!$ktest1st)
		{
			$kresult="你还没做过测试";
				return \View::make('users.index')->with('user',$student)
		                                 ->with('kurl',$kurl)
						                 ->with('kresult',$kresult);
						                 } 
else{
	     
        $colleges =Zylb::search($ktest1st->zymc)->distinct()->paginate(10);
        
		return \View::make('users.specialties.show')->with('ktests',$ktests)
		->with('user',$student)
		                                               ->with('ktest1st',$ktest1st)
													      ->with('career',$careername)
														  ->with('area',$area)
                                            ->with('colleges',$colleges);
	} 
	}
 // get spec use ktest
	  public function colfreal($filter)
	{
		//
		//
		 $loggeduser=\App::make('authenticator')->getLoggedUser();
		 $student=Student::whereraw("user_id = $loggeduser->id")->first();  
         
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $ktests=Ktest::where('user_id','=',$loggeduser->id)->get();
		$ktest1st=Ktest::where('user_id','=',$loggeduser->id)->first();
		$majorname=Kmajor::where('real_zymc','=',$filter)->first(); 
	 
		$zyjs=Flzhuanye::where('zymc','=',$filter)->first();
		$careername=Ctomajor::where('major_name_chinese','=',$majorname->chinese_name)->first();
		$mzyjs= preg_replace("/。/", "。</p><p>", $zyjs->zyjs);
		$ktest1st->zyjs=$mzyjs;
 
		$ktest1st->zymc=$zyjs->zymc;
		$ktest1st->ezymc=$majorname->chinese_name;
		   $area=Province::distinct()->lists('pname'); 
    
	     $configId = 104;  //lsi
         $accountId = 1000001;
         $yourDomain = "http://localhost:8000/users/ktest"; //change this to your server domain
         $bounceUrl = "https://api.keystosucceed.cn/setCookieAndBounce.php?returnUrl=$yourDomain";
         $kuserId=$student->kuser_id;
         $kurl = $bounceUrl . urlencode('?accountId='.$accountId.'&userId='.$kuserId.'&configId='.$configId);
		
		if(!$ktest1st)
		{
			$kresult="你还没做过测试";
				return \View::make('users.index')->with('user',$student)
		                                 ->with('kurl',$kurl)
						                 ->with('kresult',$kresult);
						                 } 
else{
	     
        $colleges =Zylb::search($ktest1st->zymc)->distinct()->paginate(10);
        
		return \View::make('users.specialties.show')->with('ktests',$ktests)
			->with('user',$student)
		                                               ->with('ktest1st',$ktest1st)
													      ->with('career',$careername)
														  ->with('area',$area)
                                            ->with('colleges',$colleges);
	} 
	}
 
/**
	 *  ajax ktest data.
	 * GET /tcadmin/tcadmin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function ajaxfilter()
	{   header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
		header('Access-Control-Allow-Origin: *');
		$loggeduser=\App::make('authenticator')->getLoggedUser();
		$student=Student::whereraw("user_id = $loggeduser->id")->first();  
		$city= Input::get('City');
		$klfilter= Input::get('Klfilter');
		$lxfiler= Input::get('Lxfilter');
		$lcurl=Input::get('Url');
		$zymc=Input::get('Zymc');
	    $areaid=Province::where('pname','=',$city)->pluck('pid');
	 
        //$area=Province::where('province')->where('pname', 'LIKE BINARY', '%'.$city.'%')->first();
        //
        $pcolleges=College::distinct()->where('pid','=',$areaid)
		                                 ->lists('coid');
		if(strstr($lcurl,"colfilter"))
		{
			  
			$colleges=Zylb::distinct()->search($zymc)
			->where('provinceid','=',$areaid)->distinct()
			->paginate(10);
			return \View::make('ajax_spec_show')->with('colleges',$colleges)
	                                              ;
		}
		else{
		if($lxfiler=="211")
		{
			if($klfilter=="本科")
			{
				$kcolleges=Zylb::whereIn('coid',$pcolleges)
				              ->where('pici','like','%本科%') 
				              ->lists('coid');		
				$colleges=College::distinct()->whereIn('coid',$kcolleges)
		                                 ->where('is211','=',1)
		                                 ->lists('coid');	
			}
			elseif($klfilter=="专科")
			{
				$kcolleges=Zylb::whereIn('coid',$pcolleges)
				              ->where('pici','like','%专科%') 
				              ->lists('coid');		
				$colleges=College::distinct()->whereIn('coid',$kcolleges)
		                                 ->where('is211','=',1)
		                                 ->lists('coid');	
			}
			else 
			{
			$colleges=College::distinct()->where('pid','=',$areaid)
		                                 ->where('is211','=',1)
		                                 ->lists('coid');
			}
		}
		elseif($lxfiler=="985")
		{
			if($klfilter=="本科")
			{
				$kcolleges=Zylb::whereIn('coid',$pcolleges)
				              ->where('pici','like','%本科%') 
				              ->lists('coid');		
				$colleges=College::distinct()->whereIn('coid',$kcolleges)
		                                 ->where('is985','=',1)
		                                 ->lists('coid');			  	  
			}
			elseif($klfilter=="专科")
			{
				$kcolleges=Zylb::whereIn('coid',$pcolleges)
				              ->where('pici','like','%专科%') 
				              ->lists('coid');	 
				$colleges=College::distinct()->whereIn('coid',$kcolleges)
		                                 ->where('is985','=',1)
		                                 ->lists('coid');			   
			}
			else 
			{
			 $colleges=College::distinct()->where('pid','=',$areaid)
		                                 ->where('is985','=',1)
		                                 ->lists('coid');
			}
			
		}
		else{
			if($klfilter=="本科")
			{
				$kcolleges=Zylb::whereIn('coid',$pcolleges)
				              ->where('pici','like','%本科%') 
				              ->lists('coid');	
				$colleges=$kcolleges;			  
			}
			elseif($klfilter=="专科")
			{
				$kcolleges=Zylb::whereIn('coid',$pcolleges)
				              ->where('pici','like','%专科%') 
				              ->lists('coid');	
				$colleges=$kcolleges;
			}
			else 
			{
			 $colleges=College::distinct()->where('pid','=',$areaid)
		                                 ->lists('coid');
			}
		}
		
        $ktests=Ktest::distinct()->select('co_id','id')->where('user_id','=',$loggeduser->id)
		                                       ->whereIn('co_id',$colleges)
                                               ->groupBy('co_id')->get();

        $ktest1st=$ktests->first();
        $usercareers=Kcresult::where('userid','=',$loggeduser->id)->lists('careername');
        $careername=Ctomajor::whereIn('career_name_chinese', $usercareers)->paginate(20);;
        $zylbs =Zylb::search($ktest1st->co_id)->distinct()->paginate(10);



return \View::make('ajaxproject')->with('ktests',$ktests)
		 ->with('careers',$careername)
		                                             ->with('ktest1st',$ktest1st)
		                                             ->with('zylbs',$zylbs);
		
		}
            
		}
		
// ajax career return
		 
public function ajaxcareer()
	{   header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
		header('Access-Control-Allow-Origin: *');
		 $loggeduser=\App::make('authenticator')->getLoggedUser();
		 $student=Student::whereraw("user_id = $loggeduser->id")->first();  
	  
		 $area=Province::distinct()->lists('pname');     
        $cname=Input::get('Careername');
			 $cid=Input::get('Cid');
		$collect=Collect::where('careerid',$cid)->first();
		
	
		 $str = preg_replace('/[^\d]/','',$cid);
		  $lcurl=Input::get('Url');
	    $major=Ctomajor::where('career_name_chinese','=',$cname)->lists('major_name_chinese');
	 
		$realmajor=Kmajor::whereIn('chinese_name',$major)->lists('real_zymc');
	 
	 
        $usezylbs = Zylb::whereIn('zymingcheng',$realmajor)->paginate(10);
	 
	 
 if(strstr($lcurl,"collect"))
{
	return \View::make('ajaxcollectcareer') 
		->with('user',$student)
		->with('area',$area) 
		  ->with('cname',$cname)
		    ->with('collect',$collect)
	 
		                                        
		                                             ->with('zylbs',$usezylbs);
		
}
else {
return \View::make('ajaxcareer') 
		->with('user',$student)
		->with('area',$area) 
		  ->with('cname',$cname)
	 
		                                        
		                                             ->with('zylbs',$usezylbs);
		
}
            
		}
		
// ajax career return
		 
public function ajaxschool()
	{   header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
		header('Access-Control-Allow-Origin: *');
		 $loggeduser=\App::make('authenticator')->getLoggedUser();
		 $student=Student::whereraw("user_id = $loggeduser->id")->first();  
	 
	$collegeid=ltrim(Input::get('Schoolid'),"#");
    $lcurl=Input::get('Url');
	$collegename=Zylb::where('coid','=',$collegeid)->first();
    $zylbs = \DB::table('zylb')
    ->join('kmajors', 'zylb.zymingcheng', '=', 'kmajors.real_zymc')
    ->join('ctomajors', 'kmajors.english_name', '=', 'ctomajors.major_name_english')
    ->where('zylb.coid', '=', $collegeid)
    ->whereraw('english_name IS NOT NULL')
	->groupBy('career_name_chinese')
      ->distinct()->paginate(10);
        
	 

if(strstr($lcurl,"ccolleges"))

{
	return \View::make('ajaxcollectschool') 
			->with('user',$student) 
	        ->with('collegename',$collegename) 
	        ->with('zylbs',$zylbs); 
}
else {
	return \View::make('ajaxschool') 
			->with('user',$student) 
	        ->with('collegename',$collegename) 
	        ->with('zylbs',$zylbs); 
}

		
	   
            
		}		 		 
// use filter to get the colleges
    public function specialties()
	{
		//
		//
		 $loggeduser=\App::make('authenticator')->getLoggedUser();
		 $student=Student::whereraw("user_id = $loggeduser->id")->first();  
         
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $ktests=Ktest::where('user_id','=',$loggeduser->id)->get();
		$ktest1st=Ktest::where('user_id','=',$loggeduser->id)->first();
		 $configId = 104;  //lsi
         $accountId = 1000001;
         $yourDomain = "http://localhost:8000/users/ktest"; //change this to your server domain
         $bounceUrl = "https://api.keystosucceed.cn/setCookieAndBounce.php?returnUrl=$yourDomain";
         $kuserId=$student->kuser_id;
         $kurl = $bounceUrl . urlencode('?accountId='.$accountId.'&userId='.$kuserId.'&configId='.$configId);
		
		if(!$ktest1st)
		{
			$kresult="你还没做过测试";
				return \View::make('users.index')->with('user',$student)
		                                 ->with('kurl',$kurl)
						                 ->with('kresult',$kresult);
						                 } 
else{   $zyjs=Flzhuanye::where('zymc','=',$ktest1st->zymc)->first();
			$mzyjs= preg_replace("/(。)/", "。</p><p>", $zyjs->zyjs);
		$ktest1st->zyjs=$mzyjs;
	   
        $colleges =Zylb::search($ktest1st->zymc)->distinct()->paginate(10);
        
		return \View::make('users.specialties.index')->with('ktests',$ktests)
		->with('user',$student)
		                                               ->with('ktest1st',$ktest1st)
                                            ->with('colleges',$colleges);
	} 
	}
	/**
	 * Display the specified resource.
	 * GET /college/articles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$authentication = \App::make('authenticator');
		return \View::make('colleges.articles.show')->with('article', Article::find($id))->withAuthor($authentication->getUserById(Article::find($id)->user_id)->name);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET  userid to do profileedit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editprofile()
	{
		//
		$size=1000;
		 $loggeduser=\App::make('authenticator')->getLoggedUser();
		 $user_profile=$loggeduser->user_profile()->first();
		 $use_gravatar=$loggeduser->user_profile()->first()->presenter()->avatar($size);
		 return \View::make('users.editprofile')->with('user_profile',$user_profile)
		                                       ->with('use_gravatar','$use_gravatar');
	}
     	/**
	 * Show the form for editing the specified resource.
	 * GET /college/articles/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		return \View::make('colleges.articles.edit')->with('article', article::find($id));
	}
  
	/**
	 * Update the specified resource in storage.
	 * PUT /college/articles/{id}
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
	 * DELETE /college/articles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		$article = article::find($id);
$article->delete();
Notification::success('删除成功！');
return Redirect::route('colleges.articles.index');
	}

}