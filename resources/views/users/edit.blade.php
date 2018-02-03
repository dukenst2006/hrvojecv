@extends('layouts.master')
@section('content')
@section('active_page', 'Profile')

<div class="container"> 
{!! Form::open(['route' => ['users.update', \Auth::id()], 'method' => 'PUT']) !!}

	<div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', $user->name, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('email', 'E-mail') }}
		{{ Form::text('email', $user->email, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('address', 'Address') }}
		{{ Form::text('address', $user->address, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('company', 'Company') }}
		{{ Form::text('company', $user->company, ['class' => 'form-control']) }}
	</div>

	{{ Form::submit('Submit', ['class' => 'btn btn-success form-control']) }}

{!! Form::close() !!}
</div>

@endsection