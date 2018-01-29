@extends('layouts.master')

@section('active_page', 'Add new education')

@section('content')

<style type="text/css">
	#edukacijaNovaForma {
		margin-top: 5em;
	}
	.edukacijaTextarea {
		width: 400px;
		max-width: 400px;
		min-width: 400px;
		height: 100px;
		max-height: 100px;
		min-height: 100px;
	}
</style>

<form method="POST" action="{{ route('education.store') }}" id="edukacijaNovaForma">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="row">
		<div class="col-md-3">
			<label for="">Name of institute:</label>
		</div>
		<div class="col-md-6">
			<input type="text" name="institute">
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<label for="">Title</label>
		</div>
		<div class="col-md-6">
			<input type="text" name="title">
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<label for="">Period:</label>
		</div>
		<div class="col-md-6">
			<input type="text" name="period" placeholder="2000. - 2005.">
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<label for="">Additional information:</label>
		</div>
		<div class="col-md-6">
			<textarea name="addInfo" class="edukacijaTextarea"></textarea>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<label>Accomplishment:</label>
		</div>
		<div class="col-md-6">
			<textarea name="accomplishments" class="edukacijaTextarea"></textarea>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
			<input type="submit" name="submit" value="Submit" class="btn btn-success">
			<a href="{{ URL::previous() }}" class="btn btn-info">Cancel</a>
		</div>
	</div>

</form>

@endsection