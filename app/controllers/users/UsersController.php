<?php

namespace App\Controllers\Users;
 
use Area,City,College,Specialty,Province,UserProfile,ProfileField,Ktest,Kresult,Student;
use Input, Notification, Redirect, Sentry, Str;

use App\Services\Validators\PageValidator;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;
use App\Services\Sclass\JsonArrayHandle;
use SoapBox\Formatter\Formatter;

class UsersController extends \BaseController {
		
	
 

	public function index()
{
    // $loggeduser=\App::make('authenticator')->getLoggedUser();
    // $authentication = \App::make('authenticator');
	// var_dump($loggeduser->permissions);
	// var_dump(array_key_exists('_teacher',$loggeduser->permissions));
	// var_dump(array_key_exists('_student',$loggeduser->permissions));
   //  if($loggeduser)
   //   {
      	  $loggeduser=\App::make('authenticator')->getLoggedUser();
		  if (array_key_exists('_student',$loggeduser->permissions))
		  { //var_dump($loginstudent);
	      $student=Student::whereraw("user_id = $loggeduser->id")->first();  
          //$xuehao=ProfileField::whereRaw("profile_id = '$userprofile->id' and profile_field_type_id = 2")->pluck('value');
	      //$xihao=ProfileField::whereRaw("profile_id = '$userprofile->id' and profile_field_type_id = 3")->pluck('value');
          //$xuehao=$student->stuno;
		  //$name=$student->stuname;
          //$userprofile->xuehao=$xuehao;
	     // $userprofile->xihao=$xihao;
	     //var_dump($student);
	     //$kuserId=Ktest::whereraw("user_id = $loggeduser->id");  
		 $ktest=Kresult::where('kuser_id','=',$student->kuser_id); 
		 $configId = 104;  //lsi
         $accountId = 1000001;
         $yourDomain = "http://localhost:8000/users/ktest"; //change this to your server domain
         $bounceUrl = "https://api.cn.keystosucceed.com/setCookieAndBounce.php?returnUrl=$yourDomain";
         $kuserId=$student->kuser_id;
         $kurl = $bounceUrl . urlencode('?accountId='.$accountId.'&userId='.$kuserId.'&configId='.$configId);
		 
         if ($ktest->count())
	       {
	       	
			$accountId = 1000001;
	//	$accountId = $_GET['accountId'];
        $userId = $student->kuser_id;
         $configId = 104;  //lsi

        $accountKey = "deI%2BKwrnkhenLX"; 
        $accountPassword = "d1SLnDVAbxKxOid5"; 

        $environment = "singapore";

        $hesClient = new HesClient($environment);
        $nonce = $hesClient->handshake($accountId, $accountPassword, $accountKey);
 
        $userId = $hesClient->encryptMe($userId, $accountKey);
        //$fullLoginUrl = $hesClient->getLoginUrl($accountId, $configId, $userId, $nonce);
        $kresult = $hesClient->getLoginUrl($accountId, $configId, $userId, $nonce); 
 
		//$ch = curl_init();
//$timeout = 5;
//curl_setopt ($ch, CURLOPT_URL, $kurl);
//curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
//$file_contents = curl_exec($ch); 
		// $kresult=$file_contents; 
        //$kresult=$kurl;
		//   $formatter = Formatter::make($result, Formatter::JSON);
		  // $jstoarray=new JsonArrayHandle;
		 //  $array = $formatter->toArray();
		 //  $finalresult=$jstoarray->objectToArray($array); 
		 //  $finalresult2=json_decode($result);
		 //   $zhuanye=array_keys(get_object_vars($finalresult2));
		    
		//	foreach($finalresult2 as $mydata)

  //  {   
    //	$zhiye[]=array_keys(get_object_vars($mydata->Careers)); 
		//var_dump($zhiye);
        
  //  }    
			 
			
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
	  public function matches()
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
		return \View::make('users.matches.index');
	}
	  public function specialties()
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
		return \View::make('users.specialties.index');
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