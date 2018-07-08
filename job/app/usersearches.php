<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usersearches extends Model
{
	public $timestamps = true;

    protected $fillable = ['user_id','search_id',];


}
