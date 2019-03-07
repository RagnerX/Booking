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
                            <form method="post" action="{{url('/save_approver')}}">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Approver</label>
                                    <select multiple class="form-control" id="exampleFormControlSelect2" name="approvers[]">
                                        @foreach($users as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Create</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection