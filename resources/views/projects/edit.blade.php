@extends('layouts.master')
@section('content')
@section('active_page', 'Edit project')

{!! Form::open(['route' => ['projects.update', $project->id], 'method' => 'PUT', 'files' => true]) !!}

	{{ Form::label('projectName', 'Project name', ['class' => 'form-label']) }}
	{{ Form::text('projectName', $project->name, ['class' => 'form-control']) }}<br>

	{{ Form::label('type', 'Personal / Corporate', ['class' => 'form-label']) }}<br>
	{{ Form::select('type', ['personal' => 'Personal', 'corporate' => 'Corporate'])}}<br><br>

	{{ Form::label('logo', 'Logo') }}
	{{ Form::file('logo', null) }}<br>

	{{ Form::label('company', 'Company', ['class' => 'form-label']) }}
	{{ Form::text('company', $project->company, ['class' => 'form-control']) }}

	{{ Form::label('url', 'Link to site', ['class' => 'form-label']) }}
	{{ Form::text('url', $project->url, ['class' => 'form-control']) }}

	{{ Form::label('technology', 'Technologies used', ['class' => 'form-label']) }}
	{{ Form::text('technology', $project->technology, ['class' => 'form-control']) }}

	{{ Form::label('desc', 'Description', ['class' => 'form-label']) }}
	{{ Form::textarea('desc', $project->description, ['class' => 'form-control']) }}<br>

	{{ Form::submit('Submit', ['class' => 'btn btn-success form-control']) }}<br><br>
	<a href="{{ route('projects.index') }}" class="btn btn-secondary form-control">Cancel</a>

{!! Form::close() !!}

@endsection