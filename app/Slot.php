<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slot extends Model
{
    use SoftDeletes;

    public function station()
    {
    	return $this->belongsTo('App\Station');
    }

    public function client()
    {
    	return $this->belongsTo('App\User', 'client_id');
    }

    public function employee()
    {
    	return $this->belongsTo('App\User', 'employee_id');
    }

    public function service()
    {
    	return $this->belongsTo('App\Service', 'service_id');
    }

    public function ticket()
    {
        return $this->hasOne('App\Ticket', 'slot_id');
    }
}
