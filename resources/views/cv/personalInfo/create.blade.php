@extends('layouts.master')

@section('active_page', 'New personal info data')

@section('content')

<a href="{{ URL::previous() }}" class="btn btn-success" style="margin-top:5em;">Cancel</a>

<form method="POST" action="{{ route('personal_info.store') }}">

	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="form-group">
		<label>Ime</label>
		<input type="text" name="name">
	</div>
	<div class="form-group">
		<label>Prezime</label>
		<input type="text" name="surname">
	</div>
	<div>
		<label>Spol</label>
		<select name="spol">
			<option value='M'>Muško</option>
			<option value='F'>Žensko</option>
		</select>
	</div>
	<div>
		<label>Datum rođenja</label>
		<input type="text" name="dob">
	</div>
	<div>
		<label>Mjesto rođenja</label>
		<input type="text" name="pob">
	</div>
	<div>
		<label>Mjesto stanovanja</label>
		<input type="text" name="currentResidence">
	</div>
	<div>
		<label>Ulica</label>
		<input type="text" name="street">
	</div>
	<div>
		<label>Kucni broj</label>
		<input type="text" name="houseNo">
	</div>
	<div>
		<label>Poštanski broj</label>
		<input type="text" name="postcode">
	</div>
	<div>
		<label>Država</label>
		<input type="text" name="state">
	</div>
	<div>
		<label>Telefon</label>
		<input type="text" name="tel">
	</div>
	<div>
		<label>Mobitel</label>
		<input type="text" name="mob">
	</div>
	<div>
		<label>E-mail</label>
		<input type="email" name="email">
	</div>
	<div>
		<label>Skype</label>
		<input type="text" name="skype">
	</div>
	<div>
		<label>Nacionalnost</label>
		<input type="text" name="nationality">
	</div>

	<div>
		<label>Position</label>
		<input type="text" name="position">
	</div>
	<div>
		<label>Professional summary</label>
		<input type="textarea" name="summary">
	</div>
	<div>
		<label>Key Skills</label>
		<input type="text" name="keySkills">
	</div>

	<input type="submit" name="submit" value="Submit" class="btn btn-success">

</form>

@endsection