@extends('layouts.master')

@section('active_page', 'Edit language')

@section('content')

<style type="text/css">
	#jezikNoviForma {
		margin-top: 5em;
	}
</style>

{{-- Div for status messages after CRUD operations --}}
@if (session('status'))
    <div class="alert alert-success" style="margin-top: 3em;">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ URL('cv/language/'.$langData->id) }}" id="jezikNoviForma">
	<input type="hidden" name="_method" value="PUT">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="row">
		<div class="col-md-3">
			<label for="">Language Name:</label>
		</div>
		<div class="col-md-6">
			<input type="text" name="langTitle" value="{{ $langData->title }}">
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<label for="">Writing</label>
		</div>
		<div class="col-md-6">
			<select name="langWriting">
				<option selected>{{ $langData->writing }}</option>
				<option value="A1">A1</option>
				<option value="A2">A2</option>
				<option value="B1">B1</option>
				<option value="B2">B2</option>
				<option value="C1">C1</option>
				<option value="C2">C2</option>
			</select>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<label for="">Understanding</label>
		</div>
		<div class="col-md-6">
			<select name="langUnderstanding">
				<option selected>{{ $langData->understanding }}</option>
				<option value="A1">A1</option>
				<option value="A2">A2</option>
				<option value="B1">B1</option>
				<option value="B2">B2</option>
				<option value="C1">C1</option>
				<option value="C2">C2</option>
			</select>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<label for="">Speach</label>
		</div>
		<div class="col-md-6">
			<select name="langSpeaking">
				<option selected>{{ $langData->speach }}</option>
				<option value="A1">A1</option>
				<option value="A2">A2</option>
				<option value="B1">B1</option>
				<option value="B2">B2</option>
				<option value="C1">C1</option>
				<option value="C2">C2</option>
			</select>
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