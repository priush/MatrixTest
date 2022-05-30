<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Classes extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_name','no_of_seats'
    ];

    // public function students(){
    //     return $this->belongsTo(Classes::class,'class_id');
    // }
    public function enStudents()
    {
        return $this->hasMany(EnrolledStudents::class,'class_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
  
}
