@extends('layouts.master')
@section('content')
@section('active_page', 'Users')

    <div class="panel panel-default">
        <div class="panel-heading">
            User list
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered {{ count($allUsers) > 0 ? 'datatable' : '' }}" id="usersTable" class="hover">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>E-MAIL</th>
                        <th>ROLE</th>
                        <th>HASH</th>
                        <th>ADDRESS</th>
                        <th>COMPANY</th>
                        <th>CREATED AT</th>
                        <th>LAST LOGIN</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($allUsers) > 0)
                        @foreach ($allUsers as $user)
                            <tr>

                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->hash }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->company }}</td>
                                <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('d.m.Y H:i:s').'h' }}</td>
                                @if(!empty($user->login))
                                    <td> {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->login)->format('d.m.Y H:i:s').'h' }}</td>
                                @else
                                    <td>Never</td>
                                @endif

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">No users</td>
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
        $('#usersTable').DataTable();
    } );
</script>

@endsection