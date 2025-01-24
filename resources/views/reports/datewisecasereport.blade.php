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
                    <h1 class="m-0 text-dark">Date Wise Case report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
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
                    <form action="{{ route('postDateWiseCaseReport') }}" method="POST">
                        @csrf
                        @method('post')
                        <div class="row col-md-12 mb-2">
                            <div class="col-md-3">
                                <input class="form-control" type="date" name="startDate" id="startDate"
                                    value="{{ $startDate }}">
                            </div>
                            <div class="col-md-3">
                                <input class="form-control" type="date" name="endDate" id="endDate"
                                    value="{{ $endDate }}">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                    <table id="dateWiseCaseReportTable" class="table table-bordered table-hover ">
                        <thead>
                            <tr>
                                <th width="10" align="center">#</th>
                                <th>Case Title</th>
                                <th width="20%">Lawyer</th>
                                <th>Region</th>
                                <th>Case Date</th>
                                <th>Next Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $value->casename }}</td>
                                    <td>{{ $value->lawyerName }}</td>
                                    <td>{{ $value->caseRegion }}</td>
                                    <td>{{ $value->caseDate }}</td>
                                    <td>{{ $value->nextDate }}</td>
                                </tr>
                            @endforeach
                        <tbody>
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
    <script>
        $(document).ready(function() {
            $('#dateWiseCaseReportTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ]
            });
        });
    </script>
@endpush
