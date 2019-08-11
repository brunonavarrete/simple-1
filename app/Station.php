<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Station extends Model
{
	use SoftDeletes;

    public function slots()
    {
    	return $this->hasMany('App\Slot');
    }
}
