@extends('layouts.master')

@section('active_page', 'Add new work experience')

@section('content')

<div class="container" style="margin-top: 10em;">
	<form method="POST" action="{{ route('work_experience.store') }}">

		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="row">
			<div class="col-md-2">
				<input type="text" name="company" placeholder="Unesite naziv tvrtke">
				<input type="text" name="address" placeholder="Adresa tvrtke">
			</div>
			<div class="col-md-2">
				<input type="text" name="sector" placeholder="Upisite sektor rada">
				<input type="text" name="position" placeholder="Naziv radnog mjesta">
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<textarea name="desc" placeholder="Opis radnog mjesta"></textarea>
			</div>
			<div class="col-md-6">
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div class="radio-group">
					<label>Trenutno zaposlen?</label>
					<input type="radio" name="currentlyEmployed" id="yes" value="yes">
					<label for="da">Da</label>
					<input type="radio" name="currentlyEmployed" id="no" value="no" checked>
					<label for="ne">Ne</label>
				</div>
			</div>
			<div class="col-md-8"></div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<div class="firstDtpDiv">Rad od
		    		<input type="text" class="datepicker firstDtp" name="workFrom">
		    	</div>
		    	<div class="secondDtpDiv">Rad do
		    		<input type="text" class="datepicker secondDtp" name="workTo">
		    	</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-4">
				<div id="buttonsGroup">
					<input type="submit" name="submit" value="Submit" class="btn btn-success">
					<a href="{{ URL::previous() }}" class="btn btn-danger">Cancel</a>
				</div>
			</div>
		</div>

	</form>
</div>

@endsection

@section('javascripts')

<script>
	$( function() {
    	$( ".datepicker" ).datepicker({
    		dateFormat: "dd.mm.yy"
    	});
	});


	$("#yes").on("click", function() {
		$(".secondDtpDiv").hide();
		$("#yes").val('yes');
		$("#no").val('');
	});
	$("#no").on("click", function() {
		$(".secondDtpDiv").show();
		$(".secondDtp").datepicker("setDate", null);
		$("#no").prop(':checked').val('no');
		$("#da").val('');
	});
</script>

@endsection