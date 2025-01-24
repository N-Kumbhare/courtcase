@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Lawyer List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Lawyer List</li>
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
                    <table id="giftcardtable" class="table table-bordered table-hover">
                        <a style="cursor: pointer;" href="{{ route('lawyers.create') }}"
                            class="btn btn-primary float-sm-left mb-2"><i class="fas fa-plus"> Add</i></a>
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th >Name</th>
                                <th >Case Name</th>
                                <th>Education</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Phone</th>
                                 <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lawyers as $key => $value)
                                <tr>
                                    <td>{{ $value->id }}</td> 
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->caseName }}</td>
                                    <td>{{ $value->education }}</td>
                                    <td>{{ $value->city }}</td>
                                    <td>{{ $value->state }}</td>
                                    <td>{{ $value->phone }}</td> 
                                    <td class="project-actions" width="10%">
                                        <form action="{{ route('lawyers.destroy', $value->id) }}" method="POST">
                                            <a class="btn btn-info btn-sm" href="{{ route('lawyers.edit', $value->id) }}"
                                                title="Edit Court">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Court"> <i
                                                    class="fas fa-trash"></i></button>
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
        $(function() {
            $('#giftcardtable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'print'
                ]
            });
        });
    </script>
@endpush
