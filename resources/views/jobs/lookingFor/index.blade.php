@extends('layouts.master')
@section('active_page', 'What I\'m looking for')
@section('content')

@if (session('status'))
    <div class="alert alert-info">
        {{ session('status') }}
    </div>
@endif

<div class="panel panel-default">
    <div class="panel-heading">
        I'm looking for a job like this... 
        @can('admin')
        <a href="{{ route('looking_for.edit', $lookingFor[0]->id) }}" class="btn btn-xs btn-info">Edit</a>
        @endcan
    </div>

    <div class="panel-body">
        {{ $lookingFor[0]->desc }}
    </div>
</div>

@endsection