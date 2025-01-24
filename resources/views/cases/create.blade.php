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
                    <h1 class="m-0 text-dark">Create Case</h1>
                </div><!-- /.col -->
                <div class="col-sm-4">
                    <select name="districtCourtIDs" id="districtCourtIDs" class="form-control"
                        onClick="onCaseRegionChange(this.value)">
                        <option value="">Select Court</option>
                        @foreach ($districtCourtList as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2">
                </div>
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('cases.index') }}"> Case List</a></li>
                        <li class="breadcrumb-item active">Create Case</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <form action="{{ route('cases.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" value="1" name="districtCourtID" id="districtCourtID">
                        <div class="row">
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Case Type</label>
                                    <select class="form-control" name="casetypes" id="casetypes">
                                        @foreach ($caseTypes as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Matter Type</label>
                                    <select class="form-control" name="matters" id="matters">
                                        @foreach ($matters as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Brief For</label>
                                    <select class="form-control" name="briefs" id="briefs">
                                        @foreach ($briefs as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Court Name</label>
                                    <select class="form-control" id="courts" name="courts">
                                        @foreach ($courts as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="caseNo">Case No</label><span class="validate-color">*</span>
                                    <input type="text" name="caseNo" id="caseNo" class="form-control"
                                        value="{{ old('caseNo') }}" placeholder="caseNo">
                                    <span class="invalid-feedback" id="caseNo_error" style="display: none;"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Case Title</label><span class="validate-color">*</span>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name') }}" placeholder="Name">
                                    <span class="invalid-feedback" id="name_error" style="display: none;"></span>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Filing Date:</label>
                                    <div class="input-group">
                                        <input type="date" name="caseDate" id="caseDate" class="form-control"
                                            value="" />
                                    </div>
                                    <span class="invalid-feedback" id="caseDate_error" style="display: none;"></span>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descriptions">Case Summary</label>
                            <textarea name="descriptions" id="descriptions" class="form-control"></textarea>
                            <span class="invalid-feedback" id="descriptions_error" style="display: none;"></span>
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleInputFile">Image</label><span> (Images Includes:
                                pdf,png,jpg,doc,docx)</span>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" id="customFile">
                                </div>
                            </div>
                            <strong class="validate-color">{{ $errors->first('image') }}</strong>
                        </div> --}}


                        <div class="col-12">
                            <input type="submit" value="Next" id="submit" class="btn btn-success float-left mb-2">
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#descriptions').summernote()
        })

        function onCaseRegionChange(id) {
            $('#districtCourtID').val(id);
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
        });
    </script>
@endpush
