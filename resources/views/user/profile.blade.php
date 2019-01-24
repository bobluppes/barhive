@extends('layouts.dashboard')

@section('title')
    User Profile
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Account information
                </div>
                <div class="panel-body">
                    <ul style="list-style: none;">
                        <li><strong>{{ Auth::user()->name }}</strong></li>
                        <li>{{ Auth::user()->email }}</li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button id="changeCredentials" class="btn btn-primary">Change credentials</button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button id="deleteAccount" class="btn btn-danger">Delete account</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="display: none;">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Change credentials
                </div>
                <div class="panel-body">
                    <div class="container">
                        {!! Form::open(array('url' => 'user/preferences/save')) !!}
                        {!! Form::token() !!}

                        <div class="form-group row">
                            {!! Form::label('name', 'Name', array('class' => 'col-2 col-form-label')) !!}
                            <div class="col-10">
                                {!! Form::text('name', '', array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('email', 'Email', array('class' => 'col-2 col-form-label')) !!}
                            <div class="col-10">
                                {!! Form::text('email', '', array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        {!! Form::number('userId', Auth::user()->id, array('hidden' => true)) !!}

                        {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection