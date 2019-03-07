@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <ul class="list-group">
                            <li class="list-group-item"><a href="{{ url('/create_meeting') }}">Create Meeting</a></li>
                            <li class="list-group-item"><a href="{{ url('/create_meeting_type') }}">Create Meeting Type</a></li>
                            <li class="list-group-item"><a href="{{ url('/create_location') }}">Create Location</a></li>
                            <li class="list-group-item"><a href="{{ url('/create_role') }}">Create Role</a></li>
                            <li class="list-group-item"><a href="{{ url('/create_approver') }}">Create Approver</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header">All Meeting Table</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-hover table-light">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Location</th>
                                <th>Meeting Type</th>
                                <th>Time</th>
                                <th>Date</th>
                                <th>Notes</th>
                                <th>Caller Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($all_meetings as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->location->location_name }}</td>
                                    <td>{{ $data->meeting_type->meeting_type_name }}</td>
                                    <td>{{ $data->meeting_time }}</td>
                                    <td>{{ $data->meeting_date }}</td>
                                    <td>{{ $data->meeting_note }}</td>
                                    <td>{{ $data->meeting_caller->name }}</td>
                                    <td>{{ $data->status }}</td>


                                    <?php

                                        $roles = DB::table('user_roles')->where('user_id', Auth::id())->get();
                                        //dd($roles);
                                        $isAdmin = false;

                                        foreach ($roles as $role){
                                            if($role->role_id == 1){
                                                $isAdmin = true;
                                            }
                                        }

                                    ?>
                                    @if($isAdmin)
                                    <td>
                                        <a class="btn btn-info" href="{{ url('/edit_meeting/'.$data->id) }}">Edit</a>
                                        <a class="btn btn-danger" href="{{ url('/delete_meeting/'.$data->id) }}">Delete</a>
                                    </td>
                                    @endif

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
