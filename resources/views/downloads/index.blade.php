@extends('layouts.master')
@section('content')
@section('active_page', 'Download area')

{{-- Div for status messages after CRUD operations --}}
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

    <div class="panel panel-default">
        <div class="panel-heading">
            Download source files
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered {{ count($files) > 0 ? 'datatable' : '' }}" id="downloadTable" class="hover">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>DESCRIPTION</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($files) > 0)
                        @foreach ($files as $file)
                            <tr>
                                <td>{{ $file->title }}</td>
                                <td>{{ $file->desc }}</td>
                                <td>
                                	<a href="download/{{$file->file_name}}" class="btn btn-xs btn-success"><i class="icon-file-download"> Download</i></a>
                                	@can('admin')
                                	{!! Form::open(array(
                                		'style' => 'display:inline-block',
					                    'method' => 'DELETE',
					                    'onsubmit' => "return confirm('Are you sure?');",
					                    'route' => ['downloads.destroy', $file->file_name])) !!}
					                    {!! Form::hidden('id', $file->id) !!}
						                {!! Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) !!}
						            {!! Form::close() !!}
						            @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">No files</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('javascripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#downloadTable').DataTable();
    } );
</script>

@endsection