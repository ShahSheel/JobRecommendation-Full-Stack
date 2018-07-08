<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSearches extends Model
{
	//protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = ['jobrole', 'Location',];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */#

	public function job_details(){
	return $this->hasMany('App\JobDetails');
	}

}
