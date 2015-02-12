<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
   
	public function showHome()
	{   
		//$userlogged=array(str_replace(':','=>',App::make('authenticator')->getLoggedUser()));	
        
        
        $userLogged=App::make('authenticator')->getLoggedUser();
		$userID=$userLogged->id;
		$userPermission=$userLogged->permissions;
		return $userPermission;
		// $arr=json_decode($userlogged);
		/*
		 * 

        foreach($userlogged as $key=>$val) {
            if (is_array($val)) {     //判断$val的值是否是一个数组，如果是，则进入下层遍历
                 foreach($val as $key=>$val) {
                      print("<li>".$key."=>".$val."</li>");
                                              }
                                   print("</ul>");
                                                }
                                               }
				 
		foreach($arr as $key=>$value){
$arr->$key=$value;
}
 print_r($arr);
				
 $array = json_decode(json_encode($userlogged),TRUE);
 echo $userid=$array["id"];
  echo $useremail=$array["email"];
		 *  
		 */
	}


}
