@extends('layouts.master')
@section('active_page', 'Post job offer')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<p style="color: red;">*** This is not a final deal, more of a proposal that we can discuss about further, if preliminary offer is good enough ***</p>

{!! Form::open(['route' => 'job_offer.store', 'method' => 'POST']) !!}
	{!! Form::hidden('user_id', \Auth::id()) !!}
	{!! Form::hidden('status', 'Recieved') !!}

	{{ Form::label('title', 'Job title', ['class' => 'form-label'])}}
	{{ Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) }}

	<small><em>"Web developer / PHP developer / Full-stack developer</em></small>
	<br><br>
	<h4>REQUIREMENTS</h4>
	<small>All of the following info is completely sortable by yourself, placeholders are just for guideline.</small>
	<br>
	<small>* required fields</small>
	<br><br>

	{{ Form::label('mainLanguage', 'Main language/s*', ['class' => 'form-label']) }}
	{{ Form::text('mainLanguage', null, ['placeholder' => 'e.g. PHP, JavaScript, GO etc.', 'class' => 'form-control', 'required' => 'required']) }}

	{{ Form::label('requiredFw', 'Required frameworks or tools*', ['class' => 'form-label']) }}
	{{ Form::text('requiredFw', null, ['placeholder' => 'e.g. Laravel/Symfony, NodeJs, MySQL, API, Git etc.', 'class' => 'form-control', 'required' => 'required']) }}

	{{ Form::label('desiredSkills', 'Desired skills', ['class' => 'form-label'])}}
	{{ Form::text('desiredSkills', null, ['placeholder' => 'JSON, AJAX, jQuery etc.', 'class' => 'form-control']) }}

	{{ Form::label('desiredAdditional', 'Additional desired skills', ['class' => 'form-label']) }}
	{{ Form::text('desiredAdditional', null, ['placeholder' => 'HTML/CSS, LAMP etc.', 'class' => 'form-control']) }}
	<br>
	{{ Form::label('yearsExp', 'Required years of experience?*', ['class' => 'form-label']) }}
	{{ Form::select('yearsExp', ['Any' => 'Any experience', 'Less then a year' => '< 1 year', '1-2 years' => '1-2 years', '2-3 years' => '2-3 years', 'More then three years' => '> 3 years'], null, ['placeholder' => 'Please select...', 'class' => 'form-control', 'required' => 'required']) }} <br><br>

	{{ Form::label('description', 'Additional info about the role', ['class' => 'form-label']) }}
	{{ Form::textarea('description', null, ['class' => 'form-control']) }}

	<br><br>
	<h4>OFFER</h4>

	{{ Form::label('contract', 'Contract*', ['class' => 'form-label']) }}
	{{ Form::select('contract', ['Full-time' => 'Full-time', 'Part-time' => 'Part-time', 'Fixed duration' => 'Fixed duration', 'Remote' => 'Remote'], null, ['placeholder' => 'Please select...', 'class' => 'form-control', 'required' => 'required']) }}
	<br>
	<div class="row">
		<div class="col-lg-6">
			{{ Form::label('salaryRange', 'Salary range*', ['class' => 'form-label'])}}
			{{ Form::select('salaryRange', ['< 30k EUR' => 'Below 30k EUR', '30k-40k EUR' => '30k - 40k EUR', '40k-50k EUR' => '40k - 50k EUR', 'above 50k EUR' => 'Above 50k EUR'], null, ['placeholder' => 'Please select...', 'class' => 'form-control', 'required' => 'required']) }}
		</div>
		<div class="col-lg-6">
			{{ Form::label('exactSalary', 'or specify', ['class' => 'form-label']) }}
			{{ Form::text('exactSalary', null, ['placeholder' => 'Salary', 'class' => 'form-control'])}}
		</div>
	</div><br>

	<div class="row">
		<div class="col-lg-2">
			{{ Form::label('remotePolicy', 'Remote work policy:*', ['class' => 'form-label'])}}
		</div>

		<div class="col-lg-2">
			{{ Form::radio('remote', 'inhouse', true) }}
			{{ Form::label('remote', 'Inhouse job', ['class' => 'form-label', 'style' => 'inline'])}}
		</div>
		<div class="col-lg-2">
			{{ Form::radio('remote', 'occasionally') }}
			{{ Form::label('remote', 'Occasionally', ['class' => 'form-label', 'style' => 'inline'])}}
		</div>
		<div class="col-lg-2">
			{{ Form::radio('remote', 'frequent') }}
			{{ Form::label('remote', 'Allowed (frequent)', ['class' => 'form-label', 'style' => 'inline'])}}
		</div>
		<div class="col-lg-2">
			{{ Form::radio('remote', 'remote') }}
			{{ Form::label('remote', '100% remote job', ['class' => 'form-label', 'style' => 'inline'])}}
		</div>
	</div><br>

	{{ Form::label('location', 'Workplace location*', ['class' => 'form-label']) }}
	{{ Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Dublin, IE', 'required' => 'required']) }}

	{{ Form::label('benefits', 'Benefits', ['class' => 'form-label']) }}
	{{ Form::textarea('benefits', null, ['class' => 'form-control', 'placeholder' => 'Add as many benefits but separate each one with comma (,)!']) }}<br>

	{{ Form::submit('Place job offer', ['class' => 'form-control btn btn-success']) }}<br><br>
	<a href="{{ route('home') }}" class="form-control btn btn-info">Cancel</a>

{!! Form::close() !!}

@endsection