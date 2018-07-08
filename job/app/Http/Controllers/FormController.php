<?php

namespace App\Http\Controllers;
use App\Classes\Careerjet_API;
use App\Classes\PDF2Text;

use App\lain;
use App\Http\Requests\RecommendFormRequest;
use App\Http\Requests\beta_store;
use Auth;
use illuminate\Filesystem;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Smalot\PdfParser\Parser;
use Cookie;
use Response;
use DB;
use App\Quotation;
use App\Jobs\runscripts;
use Illuminate\Support\Carbon;
class FormController extends Controller
{


     public function __construct()
    {
        $this->middleware('auth');
    }

    
     /**
     * Display a listing of the resource.
     *
     * @param  \App\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
     //Figure out a training method.
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function store(RecommendFormRequest $request)
    {   
        $minutes = 2147483647; #Lasts 1 year
        $jobMinutes = 2147483647; #Lasts 1 year

        //unlink(base_path() . 'Cvs/'. $cvName); //Delete PDF 

        $location = strtolower($request->input('location')); // Request for users input and convert to all lower case
        $jobrole = strtolower($request->input('jobrole'));
    
        $loc = "'".(string)$location."'";
        $job = "'".(string)$jobrole."'";
        //TO DO: CHECK IF CONSTRAINTS EXIST IN DATABASE, IF SO REJECT and if data is < 1 month. If it is then update 
        $date = "'".Carbon::now()->toDateString()."'";
        $searchTime = "'30 days'";



        //Delete all records older than 30 days

        //$exists = DB::table('job_searches')->where('jobrole',$job)->where('location',$loc)->where('created_at','>',DB::raw('NOW() - INTERVAL '.$searchTime))->first();
       
      //$isInTable = DB::table('select exists(select 1 from job_searches where jobrole  = ? and location = ? and created_at + ? INTERVAL ? DAY < Now() )' , [$jobrole , $location,0]); 
        if(DB::table('job_searches')->where('jobrole', DB::raw($job) )->where('location', DB::raw($loc) )->where('created_at','>',DB::raw('NOW() - INTERVAL '.$searchTime))->exists()){
           
            //Since it exists, get the ID of it. 

             $getID = DB::table('job_searches')->where('jobrole', DB::raw($job) )->where('location', DB::raw($loc) )->where('created_at','>',DB::raw('NOW() - INTERVAL '.$searchTime))->value('id');
             $cvName =  'cv_' .  Auth::user()->id . '.' .
            $request->file('cvupload')->getClientOriginalExtension();
            $request->file('cvupload')->move(base_path() . 'Cvs/', $cvName);
            $tmp = "python " .base_path().'Cvs\new_pdf_to_txt.py '.$cvName; //Convert to text file
            exec($tmp,$output,$err);
            $temp2= $this ->sendID($getID,$jobMinutes);
        
            if(DB::table('user_searches')->where('user_id',DB::raw(Auth::user()->id))->exists()){
                DB::table('user_searches')->where('user_id',DB::raw(Auth::user()->id))->delete(); //Needed to update table (Update creates a new row for some reason)
               DB::insert('insert into user_searches (user_id,search_id,created_at) values(?,?,?)',[DB::raw(Auth::user()->id),$getID,DB::raw('NOW()')]);
            }else{
               DB::insert('insert into user_searches (user_id,search_id,created_at) values(?,?,?)',[DB::raw(Auth::user()->id),$getID,DB::raw('NOW()')]);
            }    
                


             //Since the data is already in the DB, simply call the recommendation algorithm with the users ID abs(number)nd CV name. 

              return redirect('recommendation');
       }else{
        $data = array(
            'location' => $location, 
            'jobrole' => $jobrole,
            'created_at' => DB::raw('CURRENT_TIMESTAMP')
        ); //Save entry to database
        $getID = DB::table('job_searches')->insertGetId($data);

        DB::insert('insert into user_searches (user_id,search_id,created_at) values(?,?,?)',[Auth::id(),$getID,DB::raw('NOW()')]);

        /*$temp = $this ->sendLocation($location,$minutes); //Send cookie to ParseFormDataController
        $temp1 = $this ->sendJobRole($jobrole,$minutes); 
        $temp2= $this ->sendID($getID,$minutes);
        */

        $cvName =  'cv_' .  Auth::user()->id. '.' .
        $request->file('cvupload')->getClientOriginalExtension();
        $request->file('cvupload')->move(base_path() . 'Cvs/', $cvName);
        $tmp = "python " .base_path().'Cvs\new_pdf_to_txt.py '.$cvName; //Convert to text file


            if(DB::table('user_searches')->where('user_id',DB::raw(Auth::user()->id))->exists()){
                DB::table('user_searches')->where('user_id',DB::raw(Auth::user()->id))->delete(); //Needed to update table (Update creates a new row for some reason)
                DB::insert('insert into user_searches (user_id,search_id,created_at) values(?,?,?)',[DB::raw(Auth::user()->id),$getID,DB::raw('NOW()')]);
            }else{
               DB::insert('insert into user_searches (user_id,search_id,created_at) values(?,?,?)',[DB::raw(Auth::user()->id),$getID,DB::raw('NOW()')]);
            }    
                        

       
//       return \Redirect::route('applier')->with('message', 'Data is not in DB');
        return \Redirect::route('applier')->with('message', 'Thanks for uploading. We will now gather dater for this job role. Your recommendation should be displayed within 1 day.');

  //      }
        }

    }

    /**
    * Send cookie "location" to parseformdata controller with an expiry of 1 minute.
    *
    *
    */
    public function sendLocation($location,$minutes){ Cookie::queue('location', $location, $minutes);}


    /**
    * Send cookie "jobrole" to parseformdata controller with an expiry of 1 minute.
    *
    */
     public function sendJobRole($jobrole,$minutes){ Cookie::queue('jobrole', $jobrole, $minutes);}
   

      /**
    * Send cookie "location" to parseformdata controller with an expiry of 1 minute.
    *
    *
    */
    public function sendID($getID,$minutes){ Cookie::queue('id', $getID, $minutes);}


    /**
    *
    * RUns

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function create(lain $lain){ return view('applier'); }




}
