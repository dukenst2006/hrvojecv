@extends('layouts.master')

@section('active_page', 'Edit work experience')

@section('content')

<style type="text/css">
	.tableHead {
		font-weight: 800;
	}
</style>

<div class="container" style="z-index: 5;margin-top:10em;">
	<form method="POST" action="{{ url('cv/work_experience/'.$workExpData->id) }}">
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<table class="table table-responsive table-hover">
			<tbody>
				<tr>
					<td class="tableHeadRad">Naziv tvrtke</td>
					<td><input type="text" name="company" value="{{ $workExpData->company }}"></td>
				</tr>
				<tr>
					<td class="tableHeadRad">Sektor</td>
					<td><input type="text" name="sector" value="{{ $workExpData->sector }}"></td>
				</tr>
				<tr>
					<td class="tableHeadRad">Adresa</td>
					<td><input type="text" name="address" value="{{ $workExpData->address }}"></td>			
				</tr>
				<tr>
					<td>Trenutno zaposlen</td>
					<td>
						@if($workExpData->currently_employed == '1')
						<input type="radio" name="currentlyEmployed" id="da" value="1" checked>
						<label for="da">Da</label>
						<input type="radio" name="currentlyEmployed" id="ne" value="0">
						<label for="ne">Ne</label>
						@else
						<input type="radio" name="currentlyEmployed" id="da" value="1">
						<label for="da">Da</label>
						<input type="radio" name="currentlyEmployed" id="ne" value="0" checked>
						<label for="ne">Ne</label>
						@endif
					</td>
				</tr>
				<tr>
					<td class="tableHeadRad">Pocetak rada</td>
					<td><input type="text" name="workFrom" class="datepicker firstDtp" value="{{ $workExpData->work_from }}"></td>
				</tr>
				<tr id="finishedJob">
					<td class="tableHeadRad">Zavrsetak rada</td>
					<td>
						<input type="text" name="workTo" class="datepicker secondDtp" value="{{ $workExpData->work_to }}">
					</td>
				</tr>
				<tr>
					<td class="tableHeadRad">Naziv radnog mjesta</td>
					<td><input type="text" name="position" value="{{ $workExpData->position }}"></td>
				</tr>
				<tr>
					<td class="tableHeadRad">Opis radnog mjesta</td>
					<td><input type="text" name="desc" value="{{ $workExpData->desc }}"></td>
				</tr>
			</tbody>
		</table>

		<a href="{{ URL::previous() }}" class="btn btn-info" style="">Cancel</a>
		<input type="submit" name="submit" value="Submit" class="btn btn-success" style="">
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

	// CHECKING IF CURRENTLY EMPLOYED, IF YES WE DON'T NEED END DATE INPUT FIELD
	if( $("#da").is(":checked")) {
		$("#finishedJob").hide();
	}

	// TOGGLING YES/NO CURRENTLY EMPLOYED AND DISPLAYING PROPER INPUT FIELDS
	$("#da").on("click", function() {
		$("#finishedJob").hide();
		$("#da").val('da');
		$("#ne").val('');
		$(".secondDtp").datepicker("setDate", null);
	});
	$("#ne").on("click", function() {
		$("#finishedJob").show();
		$(".secondDtp").datepicker("setDate", null);
		$("#ne").prop(':checked').val('ne');
		$("#da").val('');
	});

	
</script>

@endsection