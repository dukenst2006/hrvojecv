@extends('layouts.master')
@section('content')
@section('active_page', 'Download area')

{!! Form::open(['route' => 'downloads.store', 'method' => 'post', 'files' => true]) !!}

	<div class="form-group">
		{{ Form::label('title', 'Add title for uploading item', ['class' => 'form-label']) }}
		{{ Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) }}
	</div>

	<div class="form-group">
		{{ Form::label('desc', 'Short description of item', ['class' => 'form-label']) }}
		{{ Form::text('desc', null, ['class' => 'form-control', 'required' => 'required']) }}
	</div>

	<div class="form-group">
		{{ Form::label('file', 'Choose file to upload', ['class' => 'form-label']) }}
		{{ Form::file('file', null, ['class' => 'form-control', 'required' => 'required']) }}
	</div>

	{{ Form::submit('Submit', ['class' => 'btn btn-success form-control']) }}

{!! Form::close() !!}

@endsection