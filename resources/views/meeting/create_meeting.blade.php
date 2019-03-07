@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Meeting</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div>
                            <form method="post" action="{{url('/save_meeting')}}" enctype="multipart/form-data">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Meeting Type</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="meeting_type_id">

                                        @foreach($meeting_types as $data)
                                            <option value="{{ $data->id }}">{{ $data->meeting_type_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Location</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="location_id">
                                        @foreach($locations as $data)
                                            <option value="{{$data->id}}">{{ $data->location_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Time</label>
                                    <input class="form-control" type="time" value="{{date('h:i:sa')}}" id="example-time-input" name="meeting_time">
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Date</label>
                                    <input class="form-control" type="date" value="{{date('Y:M:D')}}" id="example-date-input" name="meeting_date">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Meeting Note</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="meeting_note"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Upload File</label>
                                    <input type="file" class="form-control-file" name="document_url" id="fileInput">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Attendee</label>
                                    <select multiple class="form-control" id="exampleFormControlSelect2" name="attendee[]">
                                        @foreach($users as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Create Meeting</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection