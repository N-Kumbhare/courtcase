@extends('layouts.app')

@section('content')
    <style type="text/css">
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
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User List</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <form action="{{ route('users.update', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="firstname">Name</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}"
                                placeholder="First Name">
                            <span class="invalid-feedback" id="name_error" style="display: none;"></span>
                        </div>
                        <div class="form-group">
                            <label for="Phone">Phone</label>
                            <input type="number" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone }}"
                                placeholder="Phone">
                            <span class="invalid-feedback" style="display: none;" id="phone_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="Phone">Email/Username</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ $user->email }}" autocomplete="email"
                                placeholder="{{ __('E-Mail Address') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <span class="invalid-feedback" style="display: none;" id="email_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="Phone">Registration Nuber</label>
                            <input type="text" name="regNo" id="regNo"
                                class="form-control @error('regNo') is-invalid @enderror" value="{{ $user->regNo }}"
                                placeholder="regNo">
                            <span class="invalid-feedback" style="display: none;" id="regNo_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <select class="form-control select2bs4" onChange="getDistrict(this.value)" name="state"
                                id="state">
                                <option value="">Select State</option>
                                @foreach ($state as $data)
                                    <option @if ($data->StCode == $user->state) selected @endif value="{{ $data->StCode }}">
                                        {{ $data->StateName }}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" style="display: none;" id="state_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="district">District</label>
                            <select class="form-control select2bs4" name="district" id="district">
                            </select>
                            <span class="invalid-feedback" style="display: none;" id="district_error"></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" id="submit" value="Edit User" class="btn btn-success float-left mb-2">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function() { 
            var $option = $("<option selected></option>").val({{$user->district}}).text('{{$user->districtName}}');
            $('#district').append($option).trigger('change');
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })

        function getDistrict(val) {
            $.ajax({
                url: "{{ route('getDistrict') }}",
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "val": val
                },
                dataType: "json",
                success: function(response) {
                    var trHTML = '';
                    if (response) {
                        if (response.length > 0) {
                            var selected = "";

                            $.each(response, function(i, item) {
                                console.log("as", item.DistCode, item
                                    .DistrictName, {{ Auth::user()->district }});
                                // if (item.DistCode == {{ Auth::user()->district }}) {

                                // }
                                trHTML += '<option value="' + item.DistCode + '">' +
                                    item
                                    .DistrictName +
                                    '</option>';
                            });
                        }
                        $('#district').html(trHTML);
                    } else {
                        alert("Something went wrong please refresh page and try again.")
                    }
                }
            })

        }
        $('#submit').click(function() {

            var name = $('#name').val();
            var phone = $('#phone').val();
            var email = $('#email').val();
            var indexat = email.indexOf("@");
            var indexdot = email.indexOf(".");
            var userValidate = 0;

            if (name == '') {
                $('#name_error').html('Please Enter First Name!');
                $('#name').addClass('is-invalid');
                $('#name_error').show();
                userValidate = 1
            } else {
                $('#name_error').hide();
                $('#name').removeClass('is-invalid');
            }
            if (phone.length !== 10) {
                $('#phone_error').html('Please Enter 10 digit Phone Number!');
                $('#phone').addClass('is-invalid');
                $('#phone_error').show();
                userValidate = 1
            } else {
                $('#phone_error').hide();
                $('#phone').removeClass('is-invalid');
            }
            if (email == '') {
                $('#email_error').html('Please Enter Email!');
                $('#email').addClass('is-invalid');
                $('#email_error').show();
                userValidate = 1
            } else if (indexat < 1 || (indexdot - indexat) < 2) {
                $('#email_error').hide();
                $('#email_error').html('Please Enter a valid Email ID!');
                $('#email').addClass('is-invalid');
                $('#email_error').show();
                userValidate = 1
            } else {
                $('#email_error').hide();
                $('#email').removeClass('is-invalid');
            }
            if (userValidate == 1) {
                event.preventDefault();
                return false;
            } else {
                return true;
            }
        });
    </script>
@endpush
