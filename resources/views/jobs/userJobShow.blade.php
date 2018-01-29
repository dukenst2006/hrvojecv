@extends('layouts.master')
@section('active_page', 'Your job offer')
@section('content')

@if (session('status'))
    <div class="alert alert-info">
        {{ session('status') }}
    </div>
@endif

<div class="panel panel-default">
    <div class="panel-heading">
        Your job offer
    </div>

    <div class="panel-body">
    	<span class="status-mark border-success position-left"></span>
    	Status:
    	<span>
	    	{{ $job->status }}
    	</span>
		<br>
		<span class="status-mark success position-left"></span>
		<span id="expandOffer"><a href="#">See offer details</a></span>
		<span id="collapseOffer" style="display: none;"><a href="#">Hide offer details</a></span>
		<div class="job-details alert alert-info" style="display: none;margin-left: 1.5em;">
			<h4>Job Title: {{ $job->title }}</h4>
			<div class="row">
				<div class="col-lg-2">Location: {{ $job->location }}</div>
				<div class="col-lg-2">Contract: {{ $job->contract }}</div>
				<div class="col-lg-2">Salary: {{ $job->salaryRange }} <br>
					@if(!$job->exactSalary)
						</div>
					@else
						( {{ $job->exactSalary }} )</div>
					@endif
				<div class="col-lg-6"></div>
			</div>
			<div class="row">
				<div class="col-lg-2">Remote policy: {{ $job->remote }}</div>
				<div class="col-lg-2">Benefits: {{ $job->benefits }}</div>
				<div class="col-lg-2">Experience: {{ $job->yearsExp }}</div>
				<div class="col-lg-6"></div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div id="sendMessage">
			<h4>Send direct message about this offer</h4>
			<p>*All messages sent through this form are private between you and the developer/admin (me). <br> No third party users will ever see exchanged messages</p>
			{!! Form::open(['method' => 'POST', 'route' => ['job.message.send', \Auth::id()]]) !!}
				{!! Form::hidden('type', 'job') !!}
				{!! Form::hidden('jobId', $job->id) !!}
				{{ Form::textarea('message', null, ['class' => 'form-control', 'required' => 'required']) }}
				{{ Form::submit('Send', ['class' => 'btn btn-success form-control']) }}
			{!! Form::close() !!}
		</div>
		<div class="container-fluid messageHistory" style="text-align: center;margin-top:2em;">
			<h4>Message history</h4>
			@if (count($getMessages) > 0)
				@foreach($getMessages as $message)
				<div class="row">
					<div class="col-lg-12 alert alert-primary" style="text-align: left;">
						<h5>Message from: {{ $message->sender->name }}</h5>
						<h5>Content:</h5>
						<p>{{ $message->message }}</p>
					</div>
				</div>
				@endforeach
			@endif
		</div>
    </div>
</div>

@endsection

@section('javascripts')

<script>
	
	$("#expandOffer").on("click", function(){
		$(".job-details").show();
		$("#collapseOffer").show();
		$("#expandOffer").hide();
	});

	$("#collapseOffer").on("click", function(){
		$(".job-details").hide();
		$("#collapseOffer").hide();
		$("#expandOffer").show();
	});

</script>

@endsection