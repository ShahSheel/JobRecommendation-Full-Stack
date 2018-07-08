<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobDetails extends Model
{
  	protected $primaryKey = 'job_search_id';
  	public $timestamps = true;

  	protected $fillable = ['job_search_id','API_URL', 'redirected_URL','location_of_job','description','salary','company','date','title',];

	  protected $casts = [
       'location_of_job' => 'array',
 		'API_URL' => 'array',
	'redirected_URL' => 'array',
		'description' => 'array',
		'salary' => 'array'
    ];

 public function job_search(){
	return $this->belongsTo('App\JobSearches');
 }

}