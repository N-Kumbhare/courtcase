@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Lawyer</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('lawyers.index') }}"> Lawyer</a></li>
                        <li class="breadcrumb-item active">Edit Lawyer</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <form action="{{ route('lawyers.update', $lawyer->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Case List</label>
                                    <select class="form-control select2bs4" name="caseID" id="caseID">
                                        <option value="">Select Case</option>
                                        @foreach ($cases as $data)
                                            <option value="{{ $data->id }}"  @if ($data->id == $lawyer->caseID) selected @endif>{{ $data->name }}</option>
                                        @endforeach
                                    </select>

                                    <span class="invalid-feedback" id="caseID_error" style="display: none;"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" required id="name" class="form-control"
                                        value="{{ $lawyer->name }}" placeholder="Lawyer Name">
                                    <span class="invalid-feedback" id="name_error" style="display: none;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="education">Education</label>
                            <input type="text" name="education" required id="education" class="form-control"
                                value="{{ $lawyer->education }}" placeholder="Education">
                            <span class="invalid-feedback" id="education_error" style="display: none;"></span>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" required id="address" class="form-control">{{ $lawyer->address }}</textarea>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city" required id="city" class="form-control"
                                        value="{{ $lawyer->city }}" placeholder="city">
                                    <span class="invalid-feedback" id="city_error" style="display: none;"></span>
                                </div>
                                <div class="form-group">
                                    <label for="district">District</label>
                                    <input type="text" name="district" id="district" class="form-control"
                                        value="{{ $lawyer->district }}" placeholder="district">
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" required id="phone" class="form-control"
                                        value="{{ $lawyer->phone }}" placeholder="phone">
                                    <span class="invalid-feedback" id="phone_error" style="display: none;"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tahsil">Tahsil</label>
                                    <input type="text" name="tahsil" id="tahsil" class="form-control"
                                        value="{{ $lawyer->tahsil }}" placeholder="tahsil">
                                    <span class="invalid-feedback" id="tahsil_error" style="display: none;"></span>
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" name="state" required id="state" class="form-control"
                                        value="{{ $lawyer->state }}" placeholder="state">
                                    <span class="invalid-feedback" id="state_error" style="display: none;"></span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" required id="email" class="form-control"
                                        value="{{ $lawyer->email }}" placeholder="email">
                                    <span class="invalid-feedback" id="email_error" style="display: none;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" value="Update" id="submit"
                            class="btn btn-success float-left mb-2 mr-2">
                        <a class="btn btn-primary float-left mb-2" href="{{ url()->previous() }}"> Cancel</a>
                    </div>

                    <!-- /.card-body -->
                </form>
            </div>

            <!-- /.card -->
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#address').summernote()
        })
        $('#submit').click(function() {
            var name = $('#name').val();
            var phone = $('#phone').val();
            var email = $('#email').val();
            var city = $('#city').val();
            var caseID = $('#caseID').val();

            var userValidate = 0;
            if (caseID == '') {
                $('#caseID_error').html('Please Select Case!');
                $('#caseID').addClass('is-invalid');
                $('#caseID_error').show();
                userValidate = 1
            } else {
                $('#caseID_error').hide();
                $('#caseID').removeClass('is-invalid');
            }
            if (name == '') {
                $('#name_error').html('Please Enter Name!');
                $('#name').addClass('is-invalid');
                $('#name_error').show();
                userValidate = 1
            } else {
                $('#name_error').hide();
                $('#name').removeClass('is-invalid');
            }
            if (phone == '') {
                $('#phone_error').html('Please Enter phone!');
                $('#phone').addClass('is-invalid');
                $('#phone_error').show();
                userValidate = 1
            } else {
                $('#phone_error').hide();
                $('#phone').removeClass('is-invalid');
            }
            if (email == '') {
                $('#email_error').html('Please Enter email!');
                $('#email').addClass('is-invalid');
                $('#email_error').show();
                userValidate = 1
            } else {
                $('#email_error').hide();
                $('#email').removeClass('is-invalid');
            }
            if (city == '') {
                $('#city_error').html('Please Enter city!');
                $('#city').addClass('is-invalid');
                $('#city_error').show();
                userValidate = 1
            } else {
                $('#city_error').hide();
                $('#city').removeClass('is-invalid');
            }
            if (userValidate == 1) {
                return false;
            } else {
                return true;
            }
        });
    </script>
@endpush
