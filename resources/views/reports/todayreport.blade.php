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
                    <h1 class="m-0 text-dark">Today Report</h1>
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
                    <table id="todayReportTable" class="table table-bordered table-hover yajra-datatable"> 
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('todayReport') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'casename',
                        name: 'casename'
                    },
                    {
                        data: 'lawyerName',
                        name: 'lawyerName'
                    }, 
                    {
                        data: 'caseRegion',
                        name: 'caseRegion'
                    }, 
                    {
                        data: 'caseDate',
                        name: 'caseDate'
                    },
                    {
                        data: 'nextDate',
                        name: 'nextDate'
                    },
                    
                ]
            });
        })       
    </script>
@endpush
