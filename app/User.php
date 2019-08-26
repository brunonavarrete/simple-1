<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function store()
    {
        return $this->belongsTo('App\Store','store_id');
    }

    public function stores()
    {
        return $this->hasMany('App\Store','owner_id');
    }

    public function slots()
    {
        return $this->hasMany('App\Slot','employee_id');
    }

    public function setTodaysSlotsAttribute($date)
    {
        // checl different dates

        $day = !$date ? new Carbon($date) : Carbon::parse($date);
        $day = $day->toDateString();
                
        foreach ($this->slots as $key => $slot) {
            if( $slot->date != $day ) {  
                unset($this->slots[$key]);
            }
        }

        return $this->slots;
    }

    public function getFullNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }
}
