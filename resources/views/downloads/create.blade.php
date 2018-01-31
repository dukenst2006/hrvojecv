@extends('layouts.master')
@section('content')
@section('active_page', 'Download area')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{!! Form::open(['route' => 'files.store', 'method' => 'post', 'files' => true]) !!}

	{{ Form::select('type', ['sourceFile' => 'Source File', 'screenshot' => 'Screenshot']) }}

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