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
                    <h1 class="m-0 text-dark">Case List (All Cases)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Case List</li>
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
                    <table id="casetable" class="table table-bordered table-hover yajra-datatable">
                        <a href="{{ route('cases.create') }}" class="btn btn-primary float-sm-left mb-2">
                            <i class="fas fa-plus"> Add Case</i></a>
                        <thead>
                            <tr>
                                <th width="10" align="center">Sr.No</th>
                                <th>Case Title</th>
                                <th>case No</th>
                                <th>Dist Court</th>
                                <th>Court</th>
                                <th>Past Date</th>
                                <th>Next Date</th>
                                <th>Action</th>
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
    @include('cases.nextstagedate')
    @include('cases.viewhistory')
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
                ajax: "{{ route('cases.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'casename',
                        name: 'casename'
                    },
                    {
                        data: 'caseNo',
                        name: 'caseNo'
                    }, 
                    {
                        data: 'districtCourtName',
                        name: 'districtCourtName'
                    }, 
                    {
                        data: 'courtName',
                        name: 'courtName'
                    }, 
                    {
                        data: 'previousDate',
                        name: 'previousDate'
                    },
                    {
                        data: 'nextDate',
                        name: 'nextDate'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
        })
        // $('#producttable').DataTable({
        //     dom: 'Bfrtip',
        //     buttons: [
        //         'copy', 'excel', 'print'
        //     ]
        // });

        function showNextStageDateModal(id, caseNo) {
            console.log("id", id, "date", caseNo);
            $('#showCaseName').html(id);
            $('#showCaseID').val(id);
            $('#showCaseNo').html(caseNo);

            $('#showNextStageDateModal').modal('show');
        }

        function showHistoryModel(id) {
            $('#showCaseID').val(id);
            viewHistory()
            $('#viewHistoryModal').modal('show');
        }

        function deleteCase(id) {
            if (confirm("Are you sure you want to delete") == true) {
                $.ajax({
                    url: "{{ route('deleteCase') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "id": id
                    },
                    dataType: "json",
                    success: function(response) {
                        window.location.reload();
                    }
                })
            }
        }
    </script>
@endpush
