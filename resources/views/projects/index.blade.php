@extends('layouts.master')
@section('content')
@section('active_page', 'Projects')

{{-- Div for status messages after CRUD operations --}}
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if (count($projects) > 0)
	@foreach($projects as $project)
	<div class="row">
		@if($project->logo == '')
		<div class="col-lg-4"><h5><img src="{{asset('images/nologo.png')}}" alt="No logo" /></h5></div>
		@else
		<div class="col-lg-4"><h5><img src="{{asset('project_logos/'. $project->logo)}}" alt="No logo" /></h5></div>
		@endif
		<div class="col-lg-4">
			<h4>{{ $project->name }}</h4>
			<a href="{{ $project->url }}" target="_blank">{{ $project->url }}</a>
			<h5>Technologies used:</h5>
			<p>{{ $project->technology }}</p>
			<h5>Description</h5>
			<p>{{ $project->description }}</p>
		</div>
		<div class="col-lg-4">
			<h5>Actions</h5>
			<a href="{{ route('projects.show', $project->id) }}" class="btn btn-xs btn-info">Show Details</a>
			@can('admin')
			<a href="{{ route('projects.edit', $project->id) }}" class="btn btn-xs btn-success">Edit</a>
				{!! Form::open(array(
						'style' => 'padding-top: 0.5em',
	                    'method' => 'DELETE',
	                    'onsubmit' => "return confirm('Are you sure?');",
	                    'route' => ['projects.destroy', $project->id])) !!}
	                {!! Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) !!}
	            {!! Form::close() !!}
			@endcan
		</div>
	</div>
	<hr>
	@endforeach
@else
<p style="font-size: 10em;text-align: center;-webkit-transform: rotate(90deg);">:(</p>
<p style="text-align: center;">Sorry, no projects to show</p>
@endif

@endsection