<?php

use App\Models\Student;
use App\Models\Ktest;
use App\Models\Kresult;
use App\Models\Kmajor;
use App\Models\Kcareer;
use App\Models\Careermajors;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use App\Services\Validators\PageValidator;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;
use App\Services\Sclass\JsonArrayHandle;
use SoapBox\Formatter\Formatter;

class syncdata extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'command:syncdata';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Sync Ktest Data';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//
		 $students=\Student::ALL();
		 $accountId = 1000001;
	     $accountKey = "deI%2BKwrnkhenLX"; 
         $accountPassword = "d1SLnDVAbxKxOid5"; 
         $environment = "singapore";
		 foreach($students  as $student)
		 {
		 $hesClient = new HesClient($environment);
	     $filters = array ('type'=>"asPortDWYAResult",'dwya_career_mode'=>8,'culture'=>'en_US');
         $nonce=$hesClient->handshake($accountId,$accountPassword,$accountKey);
		 var_dump($nonce);
		 $kuserId = $student->kuser_id;
		 $userId= $student->user_id;
		 $kresult=$hesClient->listResults($accountId, $kuserId, $nonce, $filters);
		 var_dump($kresult);
         $de_json = json_decode($kresult,true);
	     $count_json = count($de_json);
		 var_dump($de_json);
		    for ($i = 0; $i < $count_json; $i++)
             {      
	          $ktest_id = $de_json[$i]['id'];
              $ktest_type = $de_json[$i]['type'];
	          $ktest_userid = $de_json[$i]['user_id'];
              $result =  json_encode($de_json[$i]['CareerClusters']);
			  $str2=$result;
			  $finalresult2=json_decode($result);
              $czhuanye=array_keys(get_object_vars($finalresult2));
               foreach($finalresult2 as $mydata)
                {   
                 $zhiye[]=$mydata->Careers;
                   foreach($mydata as $key => $majors){
 	               $jstoarray=new JsonArrayHandle;
 	               $finalresult=$jstoarray->objectToArray($majors);
	                foreach($finalresult as $key => $value){
		                    $mayjors[]=json_encode($value['Majors']);
 
	 
                                                       }

                 }  
				
				
				 
				 $zhiye2=json_encode($zhiye);
               $czy=$hesClient-> unicode_decode(json_encode($czhuanye), 'UTF-8', true, '\u', '');
			   $ccn=$hesClient-> unicode_decode(json_encode($zhiye), 'UTF-8', true, '\u', '');
			   $mmn=$hesClient-> unicode_decode(json_encode($mayjors), 'UTF-8', true, '\u', '');
               
              
			 
			      $kresult = new \Kresult;
                  $kresult->user_id = $userId;
                  $kresult->kuser_id=$kuserId;
                  $kresult->ktest_id=$ktest_id;
                  $kresult->type=$ktest_type;
                  $kresult->careerclusters=$str2;
				  $kresult->clustername=$czy;
				 
				 $kresult->careername=$zhiye2;
				  $kresult->majorsname=json_encode($mayjors);
				  $kresult->save();
			  
				 
			 }	   
				   
		 }
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
						$kmajors=\Kmajor::where('english_name','=',$realmajor)->get();
						foreach($kmajors as $kmajor)
						{
							 $ktests=new \Ktest;
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
		                     
			             }
			           }
			         }
				    $affectedRows = Ktest::where('zymc', '=', '')->delete();
					$affectedRows2 = Ktest::where('co_id', '=', '0')->delete();

 }
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
			   
		
	}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			
		);
	}

}
