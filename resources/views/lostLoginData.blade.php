@extends('layouts.app')

@section('content')

<div class="container-fluid" id="accessResponseContainer">
	{{-- Div for status messages after CRUD operations --}}
	@if (Session::has('message') == 'success')
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="alert alert-info" id="accessResponseAlert">
					<p>
						Thank you for your interest! <br> <br>
						I have e-mailed you with your login details. <br>
						You may now close this window and check your inbox (and spam folder) and follow instructions. <br> <br>
						Regards, <br>
						Hrvoje Zubcic
					</p>
				</div>
			</div>
			<div class="col-lg-3"></div>
		</div>
	@elseif (Session::has('message') == 'failure')
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="alert alert-danger" id="accessResponseAlert">
					<p>
						Oops! <br> <br>
						Unfortunately, I don't recognize this credentials in my records! <br>
						Please, <a href="mailto:hrcamnlz@gmail.com?subject=Access Request Error">contact me</a> if you think this is an error or try with another credentials. <br> <br>
						Regards, <br>
						Hrvoje Zubcic
					</p>
				</div>
			</div>
			<div class="col-lg-3"></div>
		</div>
	@endif
</div>

@endsection