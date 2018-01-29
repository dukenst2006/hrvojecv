@extends('layouts.master')

@section('active_page', 'Personal info')

@section('content')

<style type="text/css">
	.tableHeadPodaci {
		font-weight: 800;
		/*background-color: lightgrey;*/
		/*width: 20em;*/
	}
</style>

@if (session('status'))
    <div class="alert alert-info">
        {{ session('status') }}
    </div>
@endif

@if($myself->isEmpty())
	-no data-
@else

	<table class="table table-responsive table-hover">
		<tbody>
			<tr>
				<td class="tableHeadPodaci">Name</td>
				<td>{{ $myself[0]->name }}</td>
			</tr>
			<tr>
				<td class="tableHeadPodaci">Surname</td>
				<td>{{ $myself[0]->surname }}</td>
			</tr>
			<tr>
				<td class="tableHeadPodaci">Gender</td>
				<td>{{ $myself[0]->gender }}</td>
			</tr>
			<tr>
				<td class="tableHeadPodaci">DOB</td>
				<td>{{ $myself[0]->dob }}</td>
			</tr>
			<tr>
				<td class="tableHeadPodaci">POB</td>
				<td>{{ $myself[0]->pob }}</td>
			</tr>
			<tr>
				<td class="tableHeadPodaci">Current city</td>
				<td>{{ $myself[0]->current_residence }}</td>
			</tr>
			<tr>
				<td class="tableHeadPodaci">Street, St.Number</td>
				<td>{{ $myself[0]->street }}, {{ $myself[0]->house_no }}</td>
			</tr>
			<tr>
				<td class="tableHeadPodaci">State</td>
				<td>{{ $myself[0]->state }}</td>
			</tr>
			<tr>
				<td class="tableHeadPodaci">Nationality</td>
				<td>{{ $myself[0]->nationality }}</td>
			</tr>
			<tr>
				<td class="tableHeadPodaci">Land line</td>
				<td>{{ $myself[0]->tel }}</td>
			</tr>
			<tr>
				<td class="tableHeadPodaci">Mobile</td>
				<td>{{ $myself[0]->mob }}</td>
			</tr>
			<tr>
				<td class="tableHeadPodaci">E-mail</td>
				<td>{{ $myself[0]->email }}</td>
			</tr>
			<tr>
				<td class="tableHeadPodaci">Skype</td>
				<td>{{ $myself[0]->skype }}</td>
			</tr>
		</tbody>
	</table>
@endif

@endsection