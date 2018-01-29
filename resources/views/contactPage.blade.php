@extends('layouts.master')
@section('active_page', 'Contact form')
@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Send message</h4>
        <p>*All messages sent through this form are private between you and the developer/admin (me). <br> No third party users will ever see exchanged messages</p>
        <p>** This form is not classic form but more of a chat.</p>
    </div>

    <div class="panel-body">
    	{!! Form::open(['route' => ['contact.store', \Auth::id()], 'method' => 'POST']) !!}
    		{!! Form::hidden('type', 'contact') !!}
    		{{ Form::label('subject', 'Subject', ['class' => 'form-label']) }}
    		{{ Form::text('subject', null, ['class' => 'form-control', 'required' => 'required']) }}

    		{{ Form::label('sender', 'Sender', ['class' => 'form-label']) }}
    		{{ Form::text('sender', \Auth::user()->name, ['class' => 'form-control', 'disabled' => 'disabled	']) }}

    		{{ Form::label('message', 'Message', ['class' => 'form-label']) }}
    		{{ Form::textarea('message', null, ['class' => 'form-control', 'required' => 'required']) }}

    		{{ Form::submit('Send', ['class' => 'form-control btn btn-success']) }}
    	{!! Form::close() !!}
    </div>
    <div class="panel-body" style="text-align: center;">
    	<h5>Message history</h5>
    	@if (count($messages) > 0)
			@foreach($messages as $message)
			<div class="row">
				<div class="col-lg-12 alert alert-primary" style="text-align: left;">
					<h5>Message from: {{ $message->sender->name }}</h5>
					<h5>Content:</h5>
					<p>{{ $message->message }}</p>
				</div>
			</div>
			@endforeach
		@else
			<p>No previous messages</p>
		@endif
    </div>
</div>

@endsection