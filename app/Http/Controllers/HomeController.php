<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Meeting;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $all_meetings = Meeting::with('location')
                              ->with('meeting_type')
                              ->with('meeting_caller')
                              ->with('approver')
                              ->with('attendee')
                              ->get();

//        return $all_meetings;
  
       return view('home',['all_meetings'=>$all_meetings]);
    }
}
