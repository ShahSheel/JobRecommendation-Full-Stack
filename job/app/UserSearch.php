<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSearch extends Model
{
    
    public $timestamps = false;

    protected $fillable = ['recommended_job', 'user_id','search_id',];


    protected $casts = ['recommended_job' => 'array'];

  
}
