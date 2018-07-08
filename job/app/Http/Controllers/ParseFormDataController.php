<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\lain;
use App\Classes\Careerjet_API;
use App\Http\Requests\RecommendFormRequest;
use Cookie;
use DB;
use App\Quotation;

class ParseFormDataController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @param  \App\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $result = array(); 
        $id = DB::table('user_searches')->orderBy('created_at','desc')->value('search_id');
        $location = DB::table('job_searches')->where('id',DB::raw($id))->value('location');
        $jobrole = DB::table('job_searches')->where('id',DB::raw($id))->value('jobrole');

        $searchTime = "'3 days'"; //Jobs expire pretty quicky! 

     if(DB::table('job_details')->where('job_search_id', $id )->where('created_at','>',DB::raw('NOW() - INTERVAL '.$searchTime))->where(DB::RAW('description is not null'))->exists()){
        echo("Seems like we already got enough data for this job!");
    }else{



     $cjapi = new Careerjet_API('en_GB'); //Init
     $passData = $this -> API('1',$cjapi,$location,$jobrole); // run API




    
     $api_url = array();
     $salary = array();
     $company = array();
     $date = array();
     $title = array();
     $loc = array();

     for($x = 1; $x <=13; $x++){
          $value = strval($x);
           $cjapi = new Careerjet_API('en_GB');
          $passData = $this -> API($value,$cjapi,$location,$jobrole);
          if ( $passData->type == 'JOBS' ){
             $jobs = $passData->jobs;
              foreach( $jobs as &$job ){
                  array_push($result, $job->url);
                  array_push($salary, $job->salary);
                  array_push($company, $job->company);
                  array_push($date, $job->date);
                  array_push($title, $job->title);
                  array_push($loc,$job->locations);


            }
         }

     }
  foreach($result as $key=>$value) {
        $s =  $salary[$key];
        $c =  $company[$key];
        $d = $date[$key];
        $t =  $title[$key];
        $l = $loc[$key];
     array_push($api_url, [
        'job_search_id' => $id, 
        'api' => json_encode($value),
        'salary' => $s,
        'company' => $c,
        'date' => $d,
        'title' => $t,
        'location_of_job' =>$l,
        'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }

    echo("ID " . $id);

    DB::table('job_details')->insert($api_url);



    echo("JOB SEARCH ID: " .$id);


                //Call API 
   // $scrape = 'python '.base_path().'Description\test.py '.$id .'  2>&1 &' ; //Runs in background mode and produces errors.

   // $output = shell_exec($scrape);

    //echo($output);
    //echo(exec("whoami"));
    //DB::insert('update job_details SET redirect = '%s' WHERE id = '%s'" % (str(url), str(ID[j]')
    }


     return view('output', compact('result'));



    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('output');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\lain  $lain
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function API($value,$cjapi,$location,$jobrole)
    {
     
        $passData = $cjapi->search(
                                    array(
                                        //interating through every page of the job result
                                        'keywords'   =>  $jobrole,
                                        'location'   =>  $location,
                                        'affid'      => 'dc1770014491970d3ff3c54d9451897e',
                                        'page'      => $value,
                                    )
                               );
    return $passData;
    }

}
