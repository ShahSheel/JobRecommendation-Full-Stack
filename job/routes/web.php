<?php
use App\Http\Requests\RecommendFormRequest;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();



//Route::get('/home', 'HomeController@index')->name('home');
/*
Index home page
*/
Route::get('index', function()
{
    return view('index');
});

/*
About home page
*/
Route::get('about', function()
{
    return view('about');
});

Route::post('contact', 
  ['as' => 'contact_store', 'uses' => 'ContactController@store']);


/*
contact  home page
*/
Route::get('contact', 
  ['as' => 'contact', 'uses' => 'ContactController@create']);


/*
contact  home page
*/
Route::get('auth/login', function()
{
    return view('login');
});

/*
Applier  home page
*/

Route::get('applier', 
  ['as' => 'applier', 'uses' => 'FormController@create']);
Route::post('applier', 
  ['as' => 'recommender_store', 'uses' => 'FormController@store']);

 Route::get('recommendation', 'RecommendationController@index');

/*
Output API data
*/
 Route::get('output', 'ParseFormDataController@index');


/*Route::get('output', function () {
	return view('output');
});
*/

/*
Self log
*/
Route::get('termsandconditions', function()
{
    return view('termsandconditions');
});

Route::get('log', function()
{
    return view('log');
});

Route::get('careerjet', function()
{
    return view('careerjet');
});

Route::get('delete', function()
{
    return view('delete');
});

/*Get request to delete account*/
Route::post('delete', 
  ['as' => 'deleteAccount', 'uses' => 'DeleteAccount@index']);

