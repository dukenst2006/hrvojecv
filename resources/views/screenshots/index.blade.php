@extends('layouts.master')
@section('content')
@section('active_page', 'Screenshots area')

{{-- Div for status messages after CRUD operations --}}
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

    <div class="panel panel-default">
        <div class="panel-heading">
            Screenshots
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered {{ count($screenshots) > 0 ? 'datatable' : '' }}" id="screenshotsTable" class="hover">
                <thead>
                    <tr>
                        <th>IMAGE</th>
                        <th>DESCRIPTION</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($screenshots) > 0)
                        @foreach ($screenshots as $file)
                            <tr>
                                <td><img src="{{ asset('storage/screenshot/'.$file->file_name) }}" class="img-responsive" style="max-height: 150px;max-width: 300px;min-height: 150px;min-width: 150px;"></td>
                                <td>{{ $file->desc }}</td>
                                <td>
                                	<a href="download/{{$file->file_name}}/{{$file->type}}" class="btn btn-xs btn-success"><i class="icon-file-download"> Download</i></a>
                                	@can('admin')
                                	{!! Form::open(array(
                                		'style' => 'display:inline-block',
					                    'method' => 'DELETE',
					                    'onsubmit' => "return confirm('Are you sure?');",
					                    'route' => ['files.destroy', $file->file_name])) !!}
					                    {!! Form::hidden('id', $file->id) !!}
                                        {!! Form::hidden('type', 'screenshot') !!}
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
        $('#screenshotsTable').DataTable();
    } );
</script>

@endsection