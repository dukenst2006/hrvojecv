@extends('layouts.master')
@section('content')
@section('active_page', 'Edit Password')

<div class="container" style="text-align: center;">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

{!! Form::open(['route' => ['post.change.pass', \Auth::id()], 'method' => 'PUT']) !!}

	{{ Form::label('password', 'Enter new password')}}
    <br>
	{{ Form::password('password', null, ['placeholder' => 'Enter new password', 'required' => 'required']) }}
    <br>
	{{ Form::label('password_confirmation') }}
    <br>
	{{ Form::password('password_confirmation'), null, ['placeholder' => 'Confirm password', 'required' => 'required'] }}
    <br><br>
	{{ Form::submit('Submit', ['class' => 'btn btn-success']) }}

{!! Form::close() !!}
</div>

@endsection