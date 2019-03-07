@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Role</div>

                    <div class="card-body">

                        <div>
                            <form method="post" action="{{url('/save_role')}}">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Role Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Role Name" name="name" required>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection