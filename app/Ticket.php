<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function concepts()
    {
    	return $this->hasMany('App\Concept');
    }
}
