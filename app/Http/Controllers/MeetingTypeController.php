<?php

namespace App\Http\Controllers;


use App\MeetingType;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class MeetingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('meeting_type.create_meeting_type');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'meeting_type_name' => 'required|string|max:150',
        ]);

        $data = array();
        $data['meeting_type_name'] = $request->meeting_type_name;


        DB::table('meeting_types')->insert($data);
        return Redirect::to('/create_meeting_type');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MeetingType  $meetingType
     * @return \Illuminate\Http\Response
     */
    public function show(MeetingType $meetingType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MeetingType  $meetingType
     * @return \Illuminate\Http\Response
     */
    public function edit(MeetingType $meetingType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MeetingType  $meetingType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MeetingType $meetingType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MeetingType  $meetingType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeetingType $meetingType)
    {
        //
    }
}
