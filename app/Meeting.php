<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    //
    protected $fillable = [
        'meeting_type_id', 'location_id', 'meeting_time', 'meeting_date', 'meeting_note', 'meeting_caller_id'
    ];

    public function approver()
    {
        return $this->belongsTo('App\User',  'approver_id', 'id');
    }

    public function meeting_caller()
    {
        return $this->belongsTo('App\User',  'meeting_caller_id','id');
    }

    public function meeting_type()
    {
        return $this->belongsTo('App\MeetingType', 'meeting_type_id');
    }

    public function location()
    {
        return $this->belongsTo('App\Location', 'location_id');
    }

    public function attendee()
    {
        return $this->hasMany('App\Attendee', 'meeting_id', 'id')->with('user');
    }


}
