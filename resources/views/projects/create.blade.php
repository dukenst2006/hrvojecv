@extends('layouts.master')
@section('content')
@section('active_page', 'Create new project')

{!! Form::open(['route' => 'projects.store', 'method' => 'POST', 'files' => true]) !!}

	{{ Form::label('projectName', 'Project name', ['class' => 'form-label']) }}
	{{ Form::text('projectName', null, ['class' => 'form-control']) }}<br>

	{{ Form::label('type', 'Personal / Corporate', ['class' => 'form-label']) }}<br>
	{{ Form::select('type', ['personal' => 'Personal', 'corporate' => 'Corporate'])}}<br><br>

	{{ Form::label('logo', 'Logo') }}
	{{ Form::file('logo', null) }}<br>

	{{ Form::label('company', 'Company', ['class' => 'form-label']) }}
	{{ Form::text('company', null, ['class' => 'form-control']) }}

	{{ Form::label('url', 'Link to site', ['class' => 'form-label']) }}
	{{ Form::text('url', null, ['class' => 'form-control']) }}

	{{ Form::label('technology', 'Technologies used', ['class' => 'form-label']) }}
	{{ Form::text('technology', null, ['class' => 'form-control']) }}

	{{ Form::label('desc', 'Description', ['class' => 'form-label']) }}
	{{ Form::textarea('desc', null, ['class' => 'form-control']) }}<br>

	{{ Form::submit('Submit', ['class' => 'btn btn-success form-control']) }}

{!! Form::close() !!}

@endsection