<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $fillable = [
         'meeting_id', 'user_id'
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

//    public function meeting()
//    {
//        return $this->belongsTo('App\Meeting', 'id');
//    }
}
