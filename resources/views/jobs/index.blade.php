@extends('layouts.master')
@section('active_page', 'Job offers')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
    <div class="alert alert-info">
        {{ session('status') }}
    </div>
@endif

<div class="panel panel-default">
    <div class="panel-heading">
        Job list
    </div>

    <div class="panel-body table-responsive">
        <table class="table table-bordered {{ count($jobs) > 0 ? 'datatable' : '' }}" id="jobsTable" class="hover">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Offered by</th>
                    <th>Main Lang</th>
                    <th>Years Exp</th>
                    <th>Contract</th>
                    <th>Salary Range</th>
                    <th>Location</th>
                    <th>Actions</th>
                    <th>Status</th>
                </tr>
            </thead>
            
            <tbody>
                @if (count($jobs) > 0)
                    @foreach ($jobs as $job)
                        <tr>

                            <td>{{ $job->title }}</td>
                            <td>{{ $job->user->name }}</td>
                            <td>{{ $job->mainLanguage }}</td>
                            <td>{{ $job->yearsExp }}</td>
                            <td>{{ $job->contract }}</td>
                            <td>{{ $job->salaryRange }}</td>
                            <td>{{ $job->location }}</td>
                            @can('admin')
                            <td style="width:100%;">
                                <a href="{{ route('job_offer.show', $job->id) }}" class="btn btn-xs btn-info">Details</a>
                                <a href="mailto:{{ $job->user->email }}" class="btn btn-xs btn-success">Reply</a>
                            </td>
                            <td>
                                {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'route' => ['toggleStatus', $job->id])) !!}
                                        {{ Form::select('status', 
                                                        [$job->status => $job->status, 'In progress' => 'In progress', 'Accepted' => 'Accepted', 'Declined' => 'Declined', 'Need more info' => 'Need more info'], null, ['id' => 'setStatus', 'onchange' => 'this.form.submit()']) }}
                                {!! Form::close() !!}
                            </td>
                            @endcan
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">No offers yet...</td>
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
        $('#jobsTable').DataTable();
    });
</script>

@endsection