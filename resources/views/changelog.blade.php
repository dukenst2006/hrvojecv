@extends('layouts.master')
@section('active_page', 'News / Changelog')
@section('content')

@can('admin')
<button class="btn btn-secondary form-control" id="addBtn">Show/Hide</button>
<div class="panel panel-default" id="addDiv" style="display: none;">
	<div class="panel-heading">
		Add new 
	</div>
	<div class="panel-body">
		{!! Form::open(['route' => 'changelog.store', 'method' => 'POST']) !!}
			{{ Form::label('title', 'Title', ['class' => 'form-label']) }}
			{{ Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) }}

			{{ Form::label('desc', 'Description', ['class' => 'form-label']) }}
			{{ Form::textarea('desc', null, ['class' => 'form-control', 'required' => 'required']) }}

			{{ Form::label('changes', 'Changes (Separate by comma)', ['class' => 'form-label']) }}
			{{ Form::textarea('changes', null, ['class' => 'form-control', 'required' => 'required']) }}

			{{ Form::submit('Submit', ['class' => 'form-control btn btn-success']) }}
		{!! Form::close() !!}
	</div>
</div>
@endcan

<div class="panel panel-default">
    <div class="panel-heading">
        Changelog
    </div>

    <div class="panel-body">
    	@foreach($changelog as $log)
    	@can('admin')
    	<div>
    		{!! Form::open([
    				'route' => ['changelog.destroy', $log->id],
    				'method' => 'DELETE',
    				'style' => 'display:inline',
    				'onSubmit' => "return confirm('Are you sure?');"
    				]) !!}
    				{{ Form::submit('Delete', ['class' => 'btn btn-xs btn-danger']) }}
    		{!! Form::close() !!}
    		<a href="{{ route('changelog.edit', $log->id) }}" class="btn btn-xs btn-info">Edit</a>
    	</div>
    	@endcan
    	<h4>{{ $log->title }} | {{ $log->created_at->diffForHumans() }} </h4>
    	<p>More info: {{ $log->description }}</p>
    	<ul>
    		@foreach(explode(',', $log->changes) as $change)
    		<li>{{ $change }}</li>
    		@endforeach
    	</ul>
    	@endforeach
    </div>
</div>

@endsection

@section('javascripts')
<script type="text/javascript">
	$(document).ready(function() {
		$("#addBtn").on("click", function() {
			$("#addDiv").toggle();
		});
	});
</script>
@endsection