@extends('layouts.master')

@section('active_page', 'Work experience')

@section('content')


<style type="text/css">
	.actionBtns {
		display: inline;
	}
	td {
		max-width: 20em;
	}
	.tableHeadRad {
		font-weight: 800;
	}
</style>

{{-- Div for status messages after CRUD operations --}}
@if (session('status'))
    <div class="alert alert-info">
        {{ session('status') }}
    </div>
@endif

{{-- If there is no record in DB for work experience, echo No data, else show table with data --}}
@if($allJobs->isEmpty())
	<p> -no data- </p>
@else


	@foreach($allJobs as $job)
		<table class="table table-responsive table-hover" style="padding-bottom: 3em;">
			<tbody>
				<tr>
					<td class="tableHeadRad">Company name</td>
					<td>{{ strtoupper($job->company) }}</td>
				</tr>
				<tr>
					<td class="tableHeadRad">Sector</td>
					<td>{{ $job->sector }}</td>
				</tr>
				<tr>
					<td class="tableHeadRad">Address</td>
					<td>{{ $job->address }}</td>
				</tr>
				<tr>
					<td class="tableHeadRad">Employment started</td>
					<td>{{ $job->work_from }}</td>
				</tr>
				<tr>
					<td class="tableHeadRad">Employment ended</td>
					<td>
						@if(is_null($job->work_to))
							Currently employed
						@endif
						{{ $job->work_to }}
					</td>
				</tr>
				<tr>
					<td class="tableHeadRad">Position</td>
					<td>{{ strtoupper($job->position) }}</td>
				</tr>
				<tr>
					<td class="tableHeadRad">Description</td>
					<td>{{ $job->desc }}</td>
				</tr>
				@can('admin')
				<tr>
					<td class="tableHeadRad">Actions</td>
					<td>
						<a href="{{ route('work_experience.edit', $job->id) }}" class="btn btn-info btn-sm actionBtns">Edit</a>
						<form action="{{ URL('cv/work_experience/'.$job->id.'/delete') }}" method="POST" class="actionBtns">
							<input type="hidden" name="_method" value="DELETE">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="submit" name="submit" value="Delete" class="btn btn-danger btn-xs">
						</form>
					</td>
				</tr>
				@endcan
			</tbody>
		</table>
	@endforeach

	<hr>

@endif


@endsection