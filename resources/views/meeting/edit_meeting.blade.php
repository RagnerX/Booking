@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Meeting</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div>
                            <form method="post" action="{{url('/update_meeting/'.$meeting_data->id)}}" enctype="multipart/form-data">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Meeting Type</label>
                                    <select class="form-control" id="exampleFormControlSelect1" value="2" name="meeting_type_id">
                                        @foreach($meeting_types as $data)
                                            <option 
                                                value="{{ $data->id }}" 
                                                @if($data->id == $meeting_data->meeting_type_id)
                                                    selected="selected"
                                                @endif
                                            >
                                                {{ $data->meeting_type_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Location</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="location_id">
                                        @foreach($all_locations as $data)
                                            <option 
                                                value="{{ $data->id }}" 
                                                @if($data->id == $meeting_data->location_id)
                                                    selected="selected"
                                                @endif
                                            >
                                                {{ $data->location_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Time</label>
                                    <input class="form-control" type="time" value="{{$meeting_data->meeting_time}}" id="example-time-input" name="meeting_time">
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Date</label>
                                    <input class="form-control" type="date" value="{{$meeting_data->meeting_date}}" id="example-date-input" name="meeting_date">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Meeting Note</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="meeting_note" >{{$meeting_data->meeting_note}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Upload File</label>
                                    <input type="file" class="form-control-file" name="document_url" id="fileInput">
                                </div>
                                <div class="form-group">

                                    <label for="exampleFormControlSelect2">Attendee</label>
                                    <select multiple class="form-control" id="exampleFormControlSelect2" name="attendee[]">
                                        @foreach($meeting_data->attendee as $data)
                                            <option value="{{ $data->user->id }}">{{ $data->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @if($meeting_data->status == 0)

                                    <input type="checkbox" name="status" id="status"> <label for="status">Is Approved </label>
                                @else 
                                    <input type="checkbox" name="status" id="status" checked>  <label for="status">Is Approved </label>
                                @endif
                                <br>

                                <button type="submit" class="btn btn-primary">Create Meeting</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection