@extends('layouts.master')
@section('active_page', 'Edit changelog')
@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
		Edit
	</div>
	<div class="panel-body">
		{!! Form::open(['route' => ['changelog.update', $changelog->id], 'method' => 'PUT']) !!}
			{{ Form::label('title', 'Title', ['class' => 'form-label']) }}
			{{ Form::text('title', $changelog->title, ['class' => 'form-control', 'required' => 'required']) }}

			{{ Form::label('desc', 'Description', ['class' => 'form-label']) }}
			{{ Form::textarea('desc', $changelog->description, ['class' => 'form-control', 'required' => 'required']) }}

			{{ Form::label('changes', 'Changes (Separate by comma)', ['class' => 'form-label']) }}
			{{ Form::textarea('changes', $changelog->changes, ['class' => 'form-control', 'required' => 'required']) }}

			{{ Form::submit('Submit', ['class' => 'form-control btn btn-success']) }}
		{!! Form::close() !!}
	</div>
</div>

@endsection