<?php

namespace App\Controllers\College;
 
use Area,City,College,School,Province;
use Input, Notification, Redirect, Sentry, Str;

use App\Services\Validators\PageValidator;

class SearchController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /college/search/provinceid
	 *
	 * @return Response
	 */
 
	public function index()
	{
		//
		//$input = Input::all();
		//if($provinceID){
		//$pre_page = 20;//每页显示页数
		//$colleges = College::whereRaw("provinceID = '$provinceID'")->paginate($pre_page);
		//$provinces=Province::All();
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
                                                // ->with('provinces',$provinces);
           //     return    $provinceID;                         
		//}
		//else {
		 	//return "havn't get provicenid";
		 $pre_page = 20;//每页显示页数
		 $colleges = College::paginate($pre_page);
		 $provinces=Province::All();
		 return \View::make('colleges.search.index')->with('colleges',$colleges)
                                              ->with('provinces',$provinces);
		//}
		
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /college/articles/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return \View::make('colleges.articles.create');
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
	// college search use province
    public function collegesearch()
	{
		//
		//
		$inputData = Input::get('college'); 
		$colleges = $inputData;
		$provinces=Province::All();
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $pre_page = 20;//每页显示页数
		$colleges = College::search($colleges)->paginate(20);
		$provinces=Province::All();
		return \View::make('colleges.search.index')->with('colleges',$colleges)
                                                   ->with('provinces',$provinces); 
	}
// college search use filter 
    public function cofilter($filter)
	{
		//
		//
		if($filter=='985'){
		 $pre_page = 20;//每页显示页数
		 $colleges = College::whereRaw("is985 = 1")->paginate($pre_page);
		 $provinces=Province::All();
		return \View::make('colleges.search.index')->with('colleges',$colleges)
                                               ->with('provinces',$provinces);
			}
		elseif($filter=='211')
		{
			$pre_page = 20;//每页显示页数
		 $colleges = College::whereRaw("is211 = 1")->paginate($pre_page);
		 $provinces=Province::All();
		return \View::make('colleges.search.index')->with('colleges',$colleges)
                                               ->with('provinces',$provinces);
		}
		elseif($filter=='jyb')
		{
		 $pre_page = 20;//每页显示页数
		 $colleges = College::whereRaw("lishu = '教育部'")->paginate($pre_page);
		 $provinces=Province::All();
		return \View::make('colleges.search.index')->with('colleges',$colleges)
                                               ->with('provinces',$provinces);
		}
		else {
			$pre_page = 20;//每页显示页数
		 $colleges =College::paginate($pre_page);
		 $provinces=Province::All();
		return \View::make('colleges.search.index')->with('colleges',$colleges)
                                               ->with('provinces',$provinces);
		}
		 
	}
// college list use some filter
    public function collegelist()
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
			$colleges=College::where('coid','=',$ktest->co_id)->get();
		}
	   // $areaid=College::distinct()->select('provinceID')->whereIN('coid','=',$ktests->co_id->toArray())->get();
	    $student=Student::whereraw("user_id = $loggeduser->id")->first();  
		$ktest1st=Ktest::whereraw("user_id = $loggeduser->id")->first();
		$usercareers=Kcresult::where('userid','=',$loggeduser->id)->lists('careername');
 
		$careername=Ctomajor::whereIn('career_name_chinese', $usercareers)->paginate(20);;
                                                
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
		
		
		
		$collegename=Zylb::where('coid','=',$ktest1st->coid)->distinct()->first();
        $zylbs =Zylb::search($ktest1st->co_id)->distinct()->paginate(10);
        
		return \View::make('users.college.index')->with('ktests',$ktests)
		->with('user',$student)
		->with('area',$area)
		 ->with('careers',$careername)
		                                             ->with('ktest1st',$ktest1st)
		                                             ->with('zylbs',$zylbs);
	}
	}
	/**
	 * Display the specified resource.
	 * GET /college/articles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($provinceID)
	{
		//
		if($provinceID){
		 $pre_page = 20;//每页显示页数
		 $colleges = College::whereRaw("provinceID = '$provinceID'")->paginate($pre_page);
		 $provinces=Province::All();
		return \View::make('colleges.search.index')->with('colleges',$colleges)
                                               ->with('provinces',$provinces);
			}
	}
	/**
	 * Display the specified resource.
	 * GET /college/articles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showco($coid)
	{
		//
		 //return $coid;
		  $pre_page = 20;//每页显示页数
		  $college = College::Find($coid);
		  $provinces=Province::All();
		 return \View::make('colleges.search.showco')->with('college',$college)
                                               ->with('provinces',$provinces);
			 
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