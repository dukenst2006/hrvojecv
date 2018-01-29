@extends('layouts.master')
@section('active_page', 'Job offer')
@section('content')

@if (session('status'))
    <div class="alert alert-info">
        {{ session('status') }}
    </div>
@endif

<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-3" style="font-weight: 600;">Position</div>
	<div class="col-lg-3">{{ $job->title }}</div>
	<div class="col-lg-5"></div>
</div>

<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-3" style="font-weight: 600;">Main Language</div>
	<div class="col-lg-3">{{ $job->mainLanguage }}</div>
	<div class="col-lg-5"></div>
</div>

<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-3" style="font-weight: 600;">Required Frameworks etc</div>
	<div class="col-lg-3">{{ $job->requiredFw }}</div>
	<div class="col-lg-5"></div>
</div>

<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-3" style="font-weight: 600;">Desired skills</div>
	<div class="col-lg-3">{{ $job->desiredSkills }}</div>
	<div class="col-lg-5"></div>
</div>

<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-3" style="font-weight: 600;">Additional desired skills</div>
	<div class="col-lg-3">{{ $job->desiredAdditional }}</div>
	<div class="col-lg-5"></div>
</div>

<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-3" style="font-weight: 600;">Required years of experience</div>
	<div class="col-lg-3">{{ $job->yearsExp }}</div>
	<div class="col-lg-5"></div>
</div>

<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-3" style="font-weight: 600;">Description</div>
	<div class="col-lg-3">{{ $job->description }}</div>
	<div class="col-lg-5"></div>
</div>

<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-3" style="font-weight: 600;">Contract type</div>
	<div class="col-lg-3">{{ $job->contract }}</div>
	<div class="col-lg-5"></div>
</div>

<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-3" style="font-weight: 600;">Salary Range</div>
	<div class="col-lg-3">{{ $job->salaryRange }}</div>
	<div class="col-lg-5"></div>
</div>

<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-3" style="font-weight: 600;">Exact salary</div>
	<div class="col-lg-3">{{ $job->exactSalary }}</div>
	<div class="col-lg-5"></div>
</div>

<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-3" style="font-weight: 600;">Remote work policy</div>
	<div class="col-lg-3">{{ $job->remote }}</div>
	<div class="col-lg-5"></div>
</div>

<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-3" style="font-weight: 600;">Location</div>
	<div class="col-lg-3">{{ $job->location }}</div>
	<div class="col-lg-5"></div>
</div>

<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-3" style="font-weight: 600;">Benefits</div>
	<div class="col-lg-3">{{ $job->benefits }}</div>
	<div class="col-lg-5"></div>
</div>

<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-3" style="font-weight: 600;">Offered</div>
	<div class="col-lg-3">{{ $job->created_at->diffForHumans() }} ( {{$job->created_at->format('d.m.Y H:i')}} )</div>
	<div class="col-lg-5"></div>
</div><br><br>

<div class="container-fluid" style="text-align: center;">
	<h4>ONE-TO-ONE MESSAGES</h4>
	<div class="row" style="margin-bottom:1.5em;">
		<div class="col-lg-12">
			{!! Form::open(['method' => 'POST', 'route' => ['job.admin.message', \Auth::id()]]) !!}
				{!! Form::hidden('type', 'job') !!}
				{!! Form::hidden('reciever', $job->user->id) !!}
				{!! Form::hidden('jobId', $job->id) !!}
				{{ Form::textarea('message', null, ['class' => 'form-control', 'required' => 'required']) }}
				{{ Form::submit('Send', ['class' => 'btn btn-success form-control']) }}
			{!! Form::close() !!}
		</div>
	</div>
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


<a href="{{ route('job_offer.index') }}" class="btn btn-info form-control">Back</a>





@endsection