<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class DeleteAccount extends Controller
{
    public function index(Request $request)
    {
    	/*echo(Auth::id());
    	$delete = DB::table('users')->where('id','=',Auth::id())->onDelete('cascade');
    	echo($delete);
		*/

    	Auth::logout();
    	return view('index');
    }

}
