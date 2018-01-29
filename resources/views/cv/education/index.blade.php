@extends('layouts.master')

@section('active_page', 'Education')

@section('content')


<style type="text/css">
	.actionBtns {
		display: inline;
	}
	.tableHeadEdu {
		font-weight: 800;
	}
	#edukacijaIndexTable {
		margin-bottom: 3em;
	}
</style>


{{-- Div for status messages after CRUD operations --}}
@if (session('status'))
    <div class="alert alert-info">
        {{ session('status') }}
    </div>
@endif

{{-- If there is no record in DB for work experience, echo No data, else show table with data --}}
@if($educationData->isEmpty())
	<p> -no data- </p>
@else

	@foreach($educationData as $education)
	<table class="table table-responsive table-hover" id="edukacijaIndexTable">
		<tbody>
			<tr>
				<td class="tableHeadEdu">Institution name</td>
				<td>{{ strtoupper($education->institute) }}</td>
			</tr>
			<tr>
				<td class="tableHeadEdu">Title</td>
				<td>{{ $education->title }}</td>
			</tr>
			<tr>
				<td class="tableHeadEdu">Period</td>
				<td>{{ $education->period }}</td>
			</tr>
			<tr>
				<td class="tableHeadEdu">Additional information</td>
				<td>{{ $education->add_info }}</td>
			</tr>
			<tr>
				<td class="tableHeadEdu">Accomplishments</td>
				<td>{{ $education->accomplishments }}</td>
			</tr>
			@can('admin')
			<tr>
				<td class="tableHeadEdu">Actions</td>
				<td>
					<a href="{{ route('education.edit', $education->id) }}" class="btn btn-info btn-sm actionBtns">Edit</a>
					<form action="{{ route('education.destroy', $education->id) }}" method="POST" class="actionBtns">
						<input type="hidden" name="_method" value="DELETE">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="submit" name="submit" value="Delete" class="btn btn-danger btn-sm">
					</form>
				</td>
			</tr>
			@endcan
		</tbody>
	</table>
	<hr style="margin-bottom: 5em;border:0.05em solid black;">
	@endforeach
@endif

@endsection