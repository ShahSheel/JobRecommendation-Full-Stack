<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class recommendationController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @param  \App\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	 $id = DB::table('user_searches')->where('user_id','=',Auth::id())->value('search_id');

         $scrape = 'python '.base_path().'Description\recommendation.py '.Auth::id() .' '.$id.' 2>&1' ; //Runs in background mode and produces errors.
   
   		 $output = shell_exec($scrape); 
   		
   		 $job = DB::table('recommendation')->join('job_details','recommendation.url_id','=','job_details.id')->where('user_id','=',Auth::id())->get();

  		 return view('recommendation',['job' => $job]); 
  		 #Need Title of job + salary + location of job. 
    }
}
 