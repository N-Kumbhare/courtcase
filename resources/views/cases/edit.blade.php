@extends('layouts.app')

@section('content')
    <style type="text/css">
        input[type="date"]::-webkit-calendar-picker-indicator {
            color: rgba(0, 0, 0, 0);
            opacity: 1;
            display: block;
            position: absolute;
            left: 0;
            /* background: url(yourURLHere) no-repeat; */
            width: 25px;
            height: 25px;
            border-width: thin;
        }

        input::-webkit-datetime-edit {
            position: relative;
            left: 15px;
        }

        input::-webkit-datetime-edit-fields-wrapper {
            position: relative;
            left: 15px;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <h1 class="m-0 text-dark">Edit Case</h1>
                </div><!-- /.col -->
                <div class="col-sm-4">
                    <select name="districtCourtIDs" id="districtCourtIDs" class="form-control" onClick="onCaseRegionChange(this.value)">
                        @foreach ($districtCourtList as $data)
                            <option @if ($cases->districtCourtID == $data->id) selected @endif value="{{ $data->id }}">
                                {{ $data->name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col-sm-2">
                </div>
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cases.index') }}">Case List</a></li>
                        <li class="breadcrumb-item active">Edit Case</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <form action="{{ route('cases.update', $cases) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="hidden" value="1" name="districtCourtID" id="districtCourtID">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Case Type</label>
                                    <select class="form-control" name="casetypes" id="casetypes">
                                        @foreach ($caseTypes as $data)
                                            <option value="{{ $data->id }}"
                                                @if ($data->id == $cases->casetypeID) selected @endif>{{ $data->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Matter Type</label>
                                    <select class="form-control" name="matters" id="matters">
                                        @foreach ($matters as $data)
                                            <option value="{{ $data->id }}"
                                                @if ($data->id == $cases->matterID) selected @endif>{{ $data->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="caseNo">Case No</label><span class="validate-color">*</span>
                                    <input type="text" name="caseNo" id="caseNo" class="form-control"
                                        value="{{ $cases->caseNo }}" placeholder="caseNo">
                                    <span class="invalid-feedback" id="caseNo_error" style="display: none;"></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Brief For</label>
                                    <select class="form-control" name="briefs" id="briefs">
                                        @foreach ($briefs as $data)
                                            <option value="{{ $data->id }}"
                                                @if ($data->id == $cases->briefID) selected @endif>{{ $data->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Court Name</label>
                                    <select class="form-control" id="courts" name="courts">
                                        @foreach ($courts as $data)
                                            <option value="{{ $data->id }}"
                                                @if ($data->id == $cases->courtID) selected @endif>{{ $data->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="class row">
                            <div class="class col-sm-6">
                                <div class="form-group">
                                    <label for="firstname">Case Title</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $cases->name }}" placeholder="First Name">
                                    <span class="invalid-feedback" id="name_error" style="display: none;"></span>
                                </div>
                            </div>
                            <div class="class col-sm-6">

                                <div class="form-group">
                                    <label>Filing Date:</label>
                                    <div class="input-group">
                                        <input type="date" name="caseDate" id="caseDate" class="form-control"
                                            value="{{ $cases->caseDate }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" style="background-color: #ccc" data-card-widget="collapse">
                                        <h3 class="card-title"><b>Appellant</b></h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool"title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title btn btn-success btn-xs"
                                                            onClick="addAppellant()"><i class="fas fa-plus"></i> Add
                                                            Appellant</h3>
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body table-responsive  p-0">
                                                        <table class="table table-hover text-nowrap table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <td></td>
                                                                    <th>Name</th>
                                                                    <th>DOB</th>
                                                                    <th>Occupation</th>
                                                                    <th>Age</th>
                                                                    <th>Phone</th>
                                                                    <th>Email</th>
                                                                    <th>City</th>
                                                                    <th>District</th>
                                                                    <th>State</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($appellant as $data)
                                                                    <tr>
                                                                        <td>
                                                                            <i onClick="editAppellent({{ $data->id }})"
                                                                                class="fas fa-edit text-primary cursor-pointer"></i>
                                                                            <i onClick="deleteAppellent({{ $data->id }})"
                                                                                class="fas fa-trash text-danger cursor-pointer"></i>
                                                                        </td>
                                                                        <td>{{ $data->name }}</td>
                                                                        <td>{{ $data->dob }}</td>
                                                                        <td>{{ $data->job }}</td>
                                                                        <td>{{ $data->age }}</td>
                                                                        <td>{{ $data->phone }}</td>
                                                                        <td>{{ $data->email }}</td>
                                                                        <td>{{ $data->city }}</td>
                                                                        <td>{{ $data->district }}</td>
                                                                        <td>{{ $data->state }}</td>

                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" style="background-color: #ccc" data-card-widget="collapse">
                                        <h3 class="card-title"><b>Respondent</b></h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool"title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title btn btn-success btn-xs"
                                                            onClick="addRespondent()"><i class="fas fa-plus"></i> Add
                                                            Respondent</h3>
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body table-responsive  p-0">
                                                        <table class="table table-hover text-nowrap table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Name</th>
                                                                    <th>DOB</th>
                                                                    <th>Occupation</th>
                                                                    <th>Age</th>
                                                                    <th>Phone</th>
                                                                    <th>Email</th>
                                                                    <th>City</th>
                                                                    <th>District</th>
                                                                    <th>State</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($respondent as $data)
                                                                    <tr>
                                                                        <td>
                                                                            <i onClick="editRespondent({{ $data->id }})"
                                                                                class="fas fa-edit text-primary cursor-pointer"></i>
                                                                            <i onClick="deleteRespondent({{ $data->id }})"
                                                                                class="fas fa-trash text-danger cursor-pointer"></i>
                                                                        </td>
                                                                        <td>{{ $data->name }}</td>
                                                                        <td>{{ $data->dob }}</td>
                                                                        <td>{{ $data->job }}</td>
                                                                        <td>{{ $data->age }}</td>
                                                                        <td>{{ $data->phone }}</td>
                                                                        <td>{{ $data->email }}</td>
                                                                        <td>{{ $data->city }}</td>
                                                                        <td>{{ $data->district }}</td>
                                                                        <td>{{ $data->state }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descriptions">Case Summary</label>
                            <textarea name="descriptions" id="descriptions" class="form-control">{{ $cases->descriptions }}</textarea>
                        </div>


                        <div class="form-group">
                            <input class="mr-2" type="checkbox" name="recordRoom"
                                {{ $cases->recordRoom === '1' ? 'checked' : '' }} id="recordRoom" value="1">
                            <label for="exampleInputFile">Move To Record Room</label>
                        </div>

                    </div>
                    <div class="col-12">
                        <input type="submit" id="submit" value="Save" class="btn btn-success float-left mb-2">
                        <a href="{{ route('cases.index') }}" class="btn btn-secondary float-left ml-4">Cancel</a>

                    </div>
                </form>
            </div>

            <!-- /.card -->
        </div>
    </div>
    @include('cases.appellant')
    @include('cases.respondent')
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#descriptions').summernote()
        })

        function onCaseRegionChange(id) {
            $('#districtCourtID').val(id);
        }

        function addAppellant() {
            $('#showAppelantModal').modal('show');
        }

        function editAppellent(id) {
            $.ajax({
                url: "{{ route('getAppellant') }}",
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "id": id
                },
                dataType: "json",
                success: function(response) {
                    console.log("response", response);
                    $('#appellantName').val(response.name)
                    $('#editAppellentID').val(response.id)
                    $('#age').val(response.age)
                    $('#dob').val(response.dob)
                    $('#job').val(response.job)
                    $('#email').val(response.email)
                    $('#city').val(response.city)
                    $('#tahsil').val(response.tahsil)
                    $('#district').val(response.district)
                    $('#state').val(response.state)
                    $('#address').html(response.address)
                    $('#phone').val(response.phone)
                    $('#saveEditButton').html("Edit")
                }
            })
            $('#showAppelantModal').modal('show');
        }

        function deleteAppellent(id) {
            let confirms = confirm("Are you sure! you want to delete this?");
            if (confirms === true) {
                $.ajax({
                    url: "{{ route('deleteAppellant') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "id": id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            location.reload();
                        } else {
                            alert("Something went wrong please refresh page and try again.")
                        }
                    }
                });
            } else {
                return false;
            }
        }

        function addRespondent() {
            $('#showRespondentModal').modal('show');
        }

        function editRespondent(id) {
            $.ajax({
                url: "{{ route('getRespondent') }}",
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "id": id
                },
                dataType: "json",
                success: function(response) {
                    $('#respondentName').val(response.name)
                    $('#editRespondentID').val(response.id)
                    $('#respondentAge').val(response.age)
                    $('#respondentDob').val(response.dob)
                    $('#respondentJob').val(response.job)
                    $('#respondentEmail').val(response.email)
                    $('#respondentCity').val(response.city)
                    $('#respondentTahsil').val(response.tahsil)
                    $('#respondentDistrict').val(response.district)
                    $('#respondentState').val(response.state)
                    $('#respondentAddress').html(response.address)
                    $('#respondentPhone').val(response.phone)
                    $('#saveRespondentEditButton').html("Edit")
                    $('#showRespondentModal').modal('show');
                }
            })
        }

        function deleteRespondent(id) {
            let confirms = confirm("Are you sure! you want to delete this?");
            if (confirms === true) {
                $.ajax({
                    url: "{{ route('deleteRespondent') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "id": id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            location.reload();
                        } else {
                            alert("Something went wrong please refresh page and try again.")
                        }
                    }
                });
            } else {
                return false
            }
        }
        $('#submit').click(function() {
            var descriptions = $('#descriptions').val();
            var name = $('#name').val();
            var caseDate = $('#caseDate').val();
            var userValidate = 0;
            if (descriptions == '') {
                $('#descriptions_error').html('Please Enter Descriptions!');
                $('#descriptions').addClass('is-invalid');
                $('#descriptions').focus();
                $('#descriptions_error').show();
                userValidate = 1
            } else {
                $('#descriptions_error').hide();
                $('#descriptions').removeClass('is-invalid');
            }
            if (name == '') {
                $('#name_error').html('Please Enter First Name!');
                $('#name').addClass('is-invalid');
                $('#name').focus();
                $('#name_error').show();
                userValidate = 1
            } else {
                $('#name_error').hide();
                $('#name').removeClass('is-invalid');
            }
            if (caseDate == '') {
                $('#caseDate_error').html('Please Select Date!');
                $('#caseDate').addClass('is-invalid');
                $('#caseDate').focus();
                $('#caseDate_error').show();
                userValidate = 1
            } else {
                $('#caseDate_error').hide();
                $('#caseDate').removeClass('is-invalid');
            }
            if (userValidate == 1) {
                return false;
            } else {
                return true;
            }
        })
    </script>
@endpush
