<?php

namespace App\Controllers\Users;
 
use Area,City,College,School,Province,UserProfile,ProfileField,Ktest,Kresult;
use Input, Notification, Redirect, Sentry, Str;

use App\Services\Validators\PageValidator;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;
use App\Services\Sclass\JsonArrayHandle;
use SoapBox\Formatter\Formatter;

class UsersController extends \BaseController {
		
	
 

	public function index()
{
     $loggeduser=\App::make('authenticator')->getLoggedUser();
     $authentication = \App::make('authenticator');
     if($loggeduser)
      {
	  $userprofile=UserProfile::find($loggeduser->id);
          $xuehao=ProfileField::whereRaw("profile_id = '$userprofile->id' and profile_field_type_id = 2")->pluck('value');
	  $xihao=ProfileField::whereRaw("profile_id = '$userprofile->id' and profile_field_type_id = 3")->pluck('value');
          $userprofile->xuehao=$xuehao;
	  $userprofile->xihao=$xihao;
	  $kuserId=Ktest::whereraw("user_id = $loggeduser->id");  
      if ($kuserId->count())
	 { 
	    $kuserId = $kuserId->first()["kuser_id"];
	    $accountId = 2100;
	    $accountKey = "XM13lk42jFpyphj4"; 
            $accountPassword = "WmUv%2BPqTanQjtg"; 
            $environment = "staging";
            $hesClient = new HesClient($environment);
	    $filters = array ('type'=>"asPortDWYAResult",'dwya_career_mode'=>8);
            $nonce=$hesClient->handshake($accountId,$accountPassword,$accountKey); 
	    $kresult=$hesClient->listResults($accountId, $kuserId, $nonce, $filters);
	    $de_json = json_decode($kresult,true);
	    $count_json = count($de_json);
           for ($i = 0; $i < $count_json; $i++)
             {      
	      $ktest_id = $de_json[$i]['id'];
              $ktest_type = $de_json[$i]['type'];
	      $ktest_userid = $de_json[$i]['user_id'];
              $result =  json_encode($de_json[$i]['CareerClusters']);
	      $ktestId=Kresult::whereraw("ktest_id = $ktest_id "); 
	      if($ktestId->count())
	         {
                 // $result="你还没做过测试";
		  }
		  else
		  {
		  $kresult = new Kresult;
                  $kresult->user_id = $loggeduser->id;
                   $kresult->kuser_id=$kuserId;
                  $kresult->ktest_id=$ktest_id;
                  $kresult->type=$ktest_type;
                  $kresult->careerclusters=$result;
                   $kresult->save();
		  }
		   $formatter = Formatter::make($result, Formatter::JSON);
		   $jstoarray=new JsonArrayHandle;
		   $array = $formatter->toArray();
		   $finalresult=$jstoarray->objectToArray($array); 
		   $finalresult2=json_decode($result);
		    $zhuanye=array_keys(get_object_vars($finalresult2));
		    
			foreach($finalresult2 as $mydata)

    {   
    	$zhiye[]=array_keys(get_object_vars($mydata->Careers)); 
		//var_dump($zhiye);
        
    }    
			 
			 }
			 }   
		else {
			$kresult="你还没做过测试";
		  //change this to the humanesources userId you have created with the api
		}
        $configId = 104;  //lsi
        $accountId = 2100;
        $yourDomain = "http://localhost:8000/users/ktest"; //change this to your server domain
        $bounceUrl = "https://center.staging.humanesources.com/setCookieAndBounce.php?returnUrl=$yourDomain";
        $kuserId=Ktest::whereraw("user_id = $loggeduser->id"); 
        $kuserId = $kuserId->first()["kuser_id"];
        $kurl = $bounceUrl . urlencode('?accountId='.$accountId.'&userId='.$kuserId.'&configId='.$configId);
		
		
		return \View::make('users.index')->with('user',$userprofile)
		                                 ->with('kurl',$kurl)
						 ->with('kresult',$result)
						  ->with('zhuanye',$zhuanye)
						  ->with('zhiye',array_flatten($zhiye));
		  
		   }
		else {
		 	$logged='not login';
		   	return \View::make('users.login');
		}
		
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
		$schools = School::search($specialty)->paginate(20);
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
		$schools = School::search($specialty)->paginate(20);
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
		$schools = School::search($specialty)->paginate(20);
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
		$schools = School::search($specialty)->paginate(20);
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
		$schools = School::search($specialty)->paginate(20);
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
		$schools = School::search($specialty)->paginate(20);
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
		$schools = School::search($specialty)->paginate(20);
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