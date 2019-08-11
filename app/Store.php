<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
	use SoftDeletes;

    public function stations()
    {
    	return $this->hasMany('App\Station');
    }
}
