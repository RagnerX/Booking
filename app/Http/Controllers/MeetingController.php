<?php

namespace App\Http\Controllers;

use App\Location;
use App\Meeting;
use App\MeetingType;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meeting_types = DB::table('meeting_types')->get();
        $locations = DB::table('locations')->get();
        $users = DB::table('users')->get();

        
        //dd($meeting_types);
        return view('meeting.create_meeting', [
            'meeting_types' => $meeting_types,
            'locations' => $locations,
            'users' => $users
        ]);
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
        //dd($request->all(), $request->attendee, $request->meeting_type_name);


        $this->validate($request, [
            'meeting_type_id' => 'required|integer',
            'location_id' => 'required|integer',
            'meeting_note' => 'required|string'
        ]);

        $data = array();
        $data['meeting_type_id'] = $request->meeting_type_id;
        $data['location_id'] = $request->location_id;
        $data['meeting_time'] = $request->meeting_time;
        $data['meeting_date'] = $request->meeting_date;
        $data['meeting_note'] = $request->meeting_note;
        $data['meeting_caller_id'] = Auth::id();
        $file = $request->file('document_url');

        if($file){
            $file_name = str_random(20);
            $ext = strtolower($file->getClientOriginalExtension());
            $file_full_name = $file_name.'.'.$ext;
            $upload_path = 'file/';
            $file_url = $upload_path.$file_full_name;
            $success = $file->move($upload_path, $file_full_name);

            if($success){

                $data['document_url'] = $file_url;
                DB::table('meetings')->insert($data);

            }
        }

        $meeting =  Meeting::create($data);


        $attendees = $request->attendee;
        foreach( $attendees as $attendee ) {
            DB::table('attendees')->insert(['meeting_id' => $meeting->id, 'user_id' => $attendee ]);
        }

        //dd($meeting, $meeting->id);

        return Redirect::to('/create_meeting');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show(Meeting $meeting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

            $meeting_data = Meeting::where('id',$id)
                        ->with('location')
                        ->with('meeting_type')
                        ->with('meeting_caller')
                        ->with('approver')
                        ->with('attendee')
                        ->first();

            //return $meeting_data;
            //dd($meeting_data);
            $all_locations = Location::all();
            $meeting_types = MeetingType::all();
            //return  json_encode(['meeting'=> $meeting_data, 'loc' => $all_locations, 'types' => $meeting_types]);

            return view('meeting.edit_meeting', [
                'meeting_data' => $meeting_data,
                'all_locations' => $all_locations,
                'meeting_types' => $meeting_types
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd('updateee', $request->all(), $id);

        $data = array();
        $data['meeting_type_id'] = $request->meeting_type_id;
        $data['location_id'] = $request->location_id;
        $data['meeting_time'] = $request->meeting_time;
        $data['meeting_date'] = $request->meeting_date;
        $data['meeting_note'] = $request->meeting_note;
        $data['status'] = empty($request->status) ? 0 : 1;
        
        $data['meeting_caller_id'] = Auth::id();
        $file = $request->file('document_url');
        //dd($file); 
        if($file){
            $file_name = str_random(20);
            $ext = strtolower($file->getClientOriginalExtension());
            $file_full_name = $file_name.'.'.$ext;
            $upload_path = 'file/';
            $file_url = $upload_path.$file_full_name;
            $success = $file->move($upload_path, $file_full_name);

            if($success){

                $data['document_url'] = $file_url;
                DB::table('meetings')->insert($data);

            }
        }
        
        DB::table('meetings')->where('id', $id)->update($data);;

        $attendees = $request->attendee;
        if ($attendees != null) {
            DB::table('attendees')->where('meeting_id', $id)->delete();
            foreach( $attendees as $attendee ) {
                DB::table('attendees')->insert(['meeting_id' => $id, 'user_id' => $attendee ]);
            }
        }


        return Redirect::to('/home');
    }

    
    public function destroy($id)
    {
        DB::table('meetings')->where('id', $id)->delete();
        return Redirect::to('/home');
    }
}
