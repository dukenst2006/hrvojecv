@extends('layouts.master')
@section('content')
@section('active_page', 'Project details')

<div class="row">
	<div class="col-lg-12">
		<h4>Project name: {{ $project->name }}</h4>
		<h4>Type: {{$project->type}}</h4>
		@if(!$project->company)
			<h4>{{ $project->company }}</h4>
		@endif
		<h4>URL: <a href="{{ $project->url }}" target="_blank">{{ $project->url }}</a></h4>
		<h4>Technology used:</h4>
		<p>{{ $project->technology }}</p>
		<h4>More details</h4>
		<p>{{ $project->description }}</p>

		<a href="{{ route('projects.index') }}" class="btn btn-info form-control">Back</a>
	</div>
</div>

@endsection