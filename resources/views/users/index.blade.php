@extends('layouts.app')

@section('content')
    <style type="text/css">
        .dt-buttons {
            display: inline;
            float: right;
            margin-left: 2%;
        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Clinets</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Clinets</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table id="usertable" class="table table-bordered table-hover">
                        {{-- <a href="{{ route('users.create') }}" class="btn btn-primary float-sm-left"><i class="fas fa-plus">
                                Add User</i></a> --}}
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th width="10%">Email</th>
                                <th>Phone</th>
                                <th>State</th>
                                <th>District</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $value)
                                <tr>
                                    <td>{{ $value->name }}</td>
                                    <td width="10%">{{ $value->email }}</td>
                                    <td>{{ $value->phone }}</td>
                                    <td>{{ $value->state }}</td>
                                    <td>{{ $value->district }}</td>
                                    <td>
                                        @if ($value->status == 0 && $value->status != '')
                                            <span class="btn btn-success btn-sm">Active</span>
                                        @elseif ($value->status == 1)
                                            <span class="btn btn-danger btn-sm">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="project-actions">
                                        <form action="{{ route('users.destroy', $value->id) }}" method="POST">
                                            <a class="btn btn-info btn-sm" href="{{ route('users.edit', $value->id) }}"
                                                title="Edit User">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            {{-- <button type="submit" class="btn btn-danger btn-sm" title="Delete User"> <i
                                                    class="fas fa-trash"></i></button> --}}
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        // function showUser(){
        //   $('#showUserModal').modal('show');  
        // }
        $(function() {
            $('#usertable').DataTable({

                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'print'
                ]
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function showUser(val) {
            $('#showUserModal').modal('show');

            $.ajax({
                type: "GET",
                async: false,
                datatype: 'json',

                data: {
                    id: val
                },
                success: function(data) {

                    var genders = '';
                    if (data['data'].gender == 'm') {
                        genders = 'Male';
                    } else {
                        genders = 'Female';
                    }
                    var statuses = '';
                    if (data['data'].status == 0) {
                        statuses = 'Active';
                    } else {
                        statuses = 'InActive';
                    }

                    html = '<div class="col-md-4"> <b>First Name</b></div> <div class="col-md-8"> ' + data[
                            'data'].fname +
                        '</div><hr><div class="col-md-4"> <b>Last Name</b></div> <div class="col-md-8"> ' +
                        data['data'].lname +
                        '</div><hr><div class="col-md-4"> <b>Email</b></div> <div class="col-md-8"> ' + data[
                            'data'].email +
                        '</div><hr><div class="col-md-4"> <b>Group</b></div> <div class="col-md-8"> ' + data[
                            'data'].group +
                        '</div><hr><div class="col-md-4"> <b>Phone</b></div> <div class="col-md-8"> ' + data[
                            'data'].phone +
                        '</div><hr><div class="col-md-4"> <b>Gender</b></div> <div class="col-md-8"> ' +
                        genders +
                        '</div><hr><div class="col-md-4"> <b>Status</b></div> <div class="col-md-8"> ' +
                        statuses + '</div>';


                    $('#jacks').html(html);
                    // <tr>
                    //   <td>Alfreds Futterkiste</td>
                    //   <td>Maria Anders</td>
                    //   <td>Germany</td>
                    // </tr>';
                    // console.log(data);  
                },
                error: function() {
                    console.log("Fail/Error : City recorded Failed");
                }
            });

        }
    </script>
@endpush
