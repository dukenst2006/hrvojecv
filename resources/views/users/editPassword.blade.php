@extends('layouts.master')
@section('content')
@section('active_page', 'Users')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{!! Form::open(['route' => ['users.changePassword', \Auth::id()], 'method' => 'PUT']) !!}
    {{ csrf_field() }}

	{{ Form::label('password', 'Enter new password')}}
	{{ Form::password('password', null, ['placeholder' => 'Enter new password', 'required' => 'required']) }}

	{{ Form::label('password_confirmation') }}
	{{ Form::password('password_confirmation'), null, ['placeholder' => 'Confirm password', 'required' => 'required'] }}

	{{ Form::submit('Submit') }}

{!! Form::close() !!}

@endsection