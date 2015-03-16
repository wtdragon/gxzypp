<?php
namespace App\Controllers\Gxadmin;
 
use Area,City,College,School,Province,UserProfile,ProfileField,Teacher,Student,Sclass;
use Input, Notification, Redirect, Sentry, Str,DB;

use App\Services\Validators\AdminValidator;

class StudentsController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 * GET /gxadmin/gxadmin/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
			
	}
    /**
	 * Show the form for creating a new resource.
	 * GET /gxadmin/gxadmin/create
	 *
	 * @return Response
	 */
	public function index()
	{
		//
				$loggeduser=\App::make('authenticator')->getLoggedUser();
		$loginteacher = array_search('teacher', $loggeduser->permissions);
        $authentication = \App::make('authenticator');
		if (array_key_exists('_teacher',$loggeduser->permissions)){
			//var_dump($loggeduser->id);
		$teacher=Teacher::whereRaw("user_id = '$loggeduser->id'")->first();
			//var_dump($teacher->teachername);
		//var_dump($teacher->id);	
		//$class_tongjis =  DB::table('students')
         //   ->select((DB::raw('count(*) as student_count, classname')))
          //  ->groupBy('classname')
          //  ->get();
		//var_dump($class_tongji);
		//var_dump($teacher->teachername);
		$sclasses=Sclass::where('tid', '=',$teacher->id)->get();
	   // var_dump($sclasses->classname);
	   $classid=$sclasses->toArray();
	   
	   //var_dump(array_fetch($classid, 'id'));
		$students=Student::wherein('classid',array_fetch($classid, 'id'))->get();
		return \View::make('gxadmin.students.index')->with('students',$students);
	}
		else {
			{
				return "not a teacher";
			}
		}
	}
	/**
	 * Show the form for creating a new resource.
	 * GET /gxadmin/gxadmin/create
	 *
	 * @return Response
	 */
	public function students()
	{
		//
		return "students";
			
	}
	/**
	 * Store a newly created resource in storage.
	 * POST /gxadmin/gxadmin
	 *
	 * @return Response
	 */
/**
	 * Store a newly created resource in storage.
	 * POST /gxadmin/gxadmin
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		
$validation = new AdminValidator;
if ($validation->passes())
{
	$loggeduser=\App::make('authenticator')->getLoggedUser();
		$loginteacher = array_search('teacher', $loggeduser->permissions);
        $authentication = \App::make('authenticator');
 
$student =new Student;
$student->stuname = Input::get('stuname');
$student->stuno = Input::get('stuno');
$classname = Input::get('classname');
var_dump($classname);
$classid=Student::whereRaw("classname = '$classname'")->firstOrFail();
//var_dump($classid);
$student->classname = $classname;
$student->classid=$classid->id;
//var_dump($student->classid);
$student->emailaddress = Input::get('emailaddress');
$student->save();
var_dump(Input::get('classname'));
Notification::success('新增学生成功！');
return Redirect::route('gxadmin.students.edit', $student->id);
}
return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	/**
	 * Display the specified resource.
	 * GET /gxadmin/gxadmin/{id}
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
	 * GET /gxadmin/gxadmin/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
		public function edit($id)
	{
		//
		return \View::make('gxadmin.students.edit')->with('students', Student::find($id));
 
	}
	
    /**
	 * 处理excel 数据 the form for editing the specified resource.
	 *    
	 *
	 * @param  int  $id
	 * @return Response
	 */
		public function excel()
	{
		//
		$file = Input::file('file'); // your file upload input field in the form should be named 'file'

$destinationPath = 'uploads/';
$filename = $file->getClientOriginalName();
//$extension =$file->getClientOriginalExtension(); //if you need extension of the file
$uploadSuccess = Input::file('file')->move($destinationPath, $filename);
$file=$destinationPath . $filename;
if( $uploadSuccess ) {
    \Excel::load($file, function($reader) {

    // Getting all results
    $results = $reader->get();

    // ->all() is a wrapper for ->get() and will work the same
    $results = $reader->all();
	$uploadstudents=$reader->select(array('stuno', 'stuname','classname','emailaddress'))->get();
	   foreach($uploadstudents as $row)
        { 
            $student =new Student;
$student->stuname = $row->stuname;
$student->stuno = $row->stuno;
$student->classname = $row->classname;
$student->emailaddress = $row->emailaddress;
$student->save();   } 
});
Notification::success('批量新增学生成功！');
return Redirect::route('gxadmin.students.index');
} else {
   return Response::json('error', 400);
}
 
	}
	/**
	 * Update the specified resource in storage.
	 * PUT /gxadmin/gxadmin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
public function update($id)
{
		//
$validation = new AdminValidator;
if ($validation->passes())
{
	$loggeduser=\App::make('authenticator')->getLoggedUser();
		$loginteacher = array_search('teacher', $loggeduser->permissions);
        $authentication = \App::make('authenticator');
$student =Student::find($id);
$student->stuname = Input::get('stuname');
$student->stuno = Input::get('stuno');
$student->classname = Input::get('classname');
$student->emailaddress = Input::get('emailaddress');
$student->save();
//var_dump(Input::get('classname'));
Notification::success('更新学生成功！');
return Redirect::route('gxadmin.students.edit', $student->id);
}
return Redirect::back()->withInput()->withErrors($validation->errors);
	}


	/**
	 * Remove the specified resource from storage.
	 * DELETE /gxadmin/gxadmin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}