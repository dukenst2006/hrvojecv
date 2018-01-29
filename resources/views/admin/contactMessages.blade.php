@extends('layouts.master')
@section('active_page', 'Messages')
@section('content')

@if (count($messages) > 0)
		@foreach($messages as $message)
			<div class="row alert alert-info">
				<div class="col-lg-12">
					<h4>Sender: {{ $message->sender->name }}</h4>
					<h6>Subject: {{ $message->subject }}</h6>
					<p>Message: {{ $message->message }}</p>
				</div>
				<button id="sendMsg" class="btn btn-success form-control">Reply</button>
				<div id="replyDiv" style="display: none;">
					{!! Form::open(['method' => 'POST', 'route' => 'contact.admin.send']) !!}
						{!! Form::hidden('reciever', $message->sender_id) !!}
						{!! Form::hidden('type', $message->type) !!}

						{{ Form::label('subject', 'Subject', ['class' => 'form-label']) }}
						{{ Form::text('subject', 'RE:'.$message->subject, ['class' => 'form-control']) }}

						{{ Form::label('message', 'Message', ['class' => 'form-label']) }}
						{{ Form::textarea('message', null, ['class' => 'form-control']) }}

						{{ Form::submit('Send', ['class' => 'form-control btn btn-success']) }}	
					{!! Form::close() !!}
					<button class="btn btn-primary form-control" id="cancelBtn">Cancel</button>
				</div>
			</div>
		@endforeach
@else
<p>No messages</p>
@endif


@endsection

@section('javascripts')

<script>
	$("#sendMsg").on("click", function() {
		$("#replyDiv").show();
		$("#sendMsg").hide();
	});
	$("#cancelBtn").on("click", function() {
		$("#replyDiv").hide();
		$("#sendMsg").show();
	});
</script>

@endsection