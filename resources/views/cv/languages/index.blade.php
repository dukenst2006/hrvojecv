@extends('layouts.master')

@section('active_page', 'Languages')

@section('content')

<style type="text/css">
	#jeziciContainer {
		margin-top: 5em;
	}
</style>

{{-- Div for status messages after CRUD operations --}}
@if (session('status'))
    <div class="alert alert-info">
        {{ session('status') }}
    </div>
@endif

@if($langData->isEMpty())
-no data-
@else
<table class="table table-striped" id="jeziciContainer">
	<thead>
	    <tr>
	    	<th scope="col"></th>
		    <th scope="col">Writing</th>
		    <th scope="col">Understanding</th>
		    <th scope="col">Speach</th>
	    </tr>
	</thead>
  	<tbody>
  		@foreach($langData as $lang)
	    <tr>
	      <th scope="row">
	      	@can('admin')
			<form action="{{ route('language.destroy', $lang->id) }}" method="POST" style="display: inline;">
				<input type="hidden" name="_method" value="DELETE">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button type="submit" name="submit" class="btn btn-danger btn-sm"><i class="fa fa-close fa-fw"></i></button>
			</form>
			<a href="{{ route('language.edit', $lang->id) }}"><i class="fa fa-pencil fa-fw"></i></a>
			@endcan
	      	{{ $lang->title }}
	      </th>
	      <td>{{ $lang->writing }}</td>
	      <td>{{ $lang->understanding }}</td>
	      <td>{{ $lang->speach }}</td>
	    </tr>
	    @endforeach
	</tbody>
</table>
<small>Classes: A1/2: Beginner - B1/2: Independant user - C1/2 Experienced user</small><br>
<small>* Self-assesment of known languages based on <a href="http://europass.cedefop.europa.eu/hr/resources/european-language-levels-cefr" target="_blank">European common reference frame for languages</a>.</small>
@endif

@endsection