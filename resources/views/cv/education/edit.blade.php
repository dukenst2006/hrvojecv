@extends('layouts.master')

@section('active_page', 'Edit education')

@section('content')

<style type="text/css">
	.edukacijaTextarea {
		width: 400px;
		max-width: 400px;
		min-width: 400px;
		height: 100px;
		max-height: 100px;
		min-height: 100px;
	}
</style>

<div class="container" style="z-index: 5;margin-top:10em;">
	<form method="POST" action="{{ url('cv/education/'.$educationData->id) }}">
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<table class="table table-responsive table-hover">
			<tbody>
				<tr>
					<td class="tableHeadRad">Naziv tvrtke</td>
					<td><input type="text" name="institute" value="{{ $educationData->institute }}"></td>
				</tr>
				<tr>
					<td class="tableHeadRad">Sektor</td>
					<td><input type="text" name="title" value="{{ $educationData->title }}"></td>
				</tr>
				<tr>
					<td class="tableHeadRad">Adresa</td>
					<td><input type="text" name="period" value="{{ $educationData->period }}"></td>			
				</tr>
				<tr>
					<td class="tableHeadRad">Naziv radnog mjesta</td>
					<td><textarea name="addInfo" class="edukacijaTextarea">{{ $educationData->add_info }}</textarea></td>
				</tr>
				<tr>
					<td class="tableHeadRad">Opis radnog mjesta</td>
					<td><textarea name="accomplishments" class="edukacijaTextarea">{{ $educationData->accomplishments }}</textarea></td>
				</tr>
			</tbody>
		</table>

		<a href="{{ URL::previous() }}" class="btn btn-info" style="">Cancel</a>
		<input type="submit" name="submit" value="Submit" class="btn btn-success">
	</form>
</div>


@endsection