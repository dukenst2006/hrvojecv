@extends('layouts.master')

@section('active_page', 'Edit personal details')

@section('content')

<style type="text/css">
	.tableHead {
		font-weight: 800;
	}
</style>

<div class="container" style="z-index: 5;">
	<form method="POST" action="{{ url('cv/personal_info/'.$myself->id) }}">
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<table class="table table-responsive" style="margin-top: 3em;">
			<tbody>
				<tr>
					<td class="tableHead"><label>Ime</label></td>
					<td><input type="text" name="name" value="{{ $myself->name }}"></td>
				</tr>
				<tr>
					<td class="tableHead"><label>Prezime</label></td>
					<td><input type="text" name="surname" value="{{ $myself->surname }}"></td>
				</tr>
				<tr>
					<td class="tableHead"><label>Spol</label></td>
					<td><select name="gender">
							<option selected>{{ $myself->gender }}</option>
							<option value='M'>Muško</option>
							<option value='F'>Žensko</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="tableHead"><label>Datum rođenja</label></td>
					<td><input type="text" name="dob" value="{{ $myself->dob }}"></td>
				</tr>
				<tr>
					<td class="tableHead"><label>Mjesto rođenja</label></td>
					<td><input type="text" name="pob" value="{{ $myself->pob }}"></td>
				</tr>
				<tr>
					<td class="tableHead"><label>Mjesto stanovanja</label></td>
					<td><input type="text" name="currentResidence" value="{{ $myself->current_residence }}"></td>
				</tr>
				<tr>
					<td class="tableHead"><label>Ulica</label></td>
					<td><input type="text" name="street" value="{{ $myself->street }}"></td>
				</tr>
				<tr>
					<td class="tableHead"><label>Kucni broj</label></td>
					<td><input type="text" name="houseNo" value="{{ $myself->house_no }}"></td>
				</tr>
				<tr>
					<td class="tableHead"><label>Poštanski broj</label></td>
					<td><input type="text" name="postcode" value="{{ $myself->postcode }}"></td>
				</tr>
				<tr>
					<td class="tableHead"><label>Država</label></td>
					<td><input type="text" name="state" value="{{ $myself->state }}"></td>
				</tr>
				<tr>
					<td class="tableHead"><label>Telefon</label></td>
					<td><input type="text" name="tel" value="{{ $myself->tel }}"></td>
				</tr>
				<tr>
					<td class="tableHead"><label>Mobitel</label></td>
					<td><input type="text" name="mob" value="{{ $myself->mob }}"></td>
				</tr>
				<tr>
					<td class="tableHead"><label>E-mail</label></td>
					<td><input type="email" name="email" value="{{ $myself->email }}"></td>
				</tr>
				<tr>
					<td class="tableHead"><label>Skype</label></td>
					<td><input type="text" name="skype" value="{{ $myself->skype }}"></td>
				</tr>
				<tr>
					<td class="tableHead"><label>Nacionalnost</label></td>
					<td><input type="text" name="nationality" value="{{ $myself->nationality }}"></td>
				</tr>
			</tbody>
		</table>

		<a href="{{ URL::previous() }}" class="btn btn-info" style="display: inline;">Cancel</a>
		<input type="submit" name="submit" value="Submit" class="btn btn-success" style="display: inline;">
	</form>
</div>

@endsection