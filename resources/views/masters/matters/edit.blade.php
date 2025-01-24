@extends('layouts.app')

@section('content') 
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Matter</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('matters.index') }}"> Matter</a></li>
                        <li class="breadcrumb-item active">Edit Matter</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <form action="{{ route('matters.update', $matter->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" required id="name" class="form-control"
                                value="{{ $matter->name }}">
                            <span class="invalid-feedback" id="name_error" style="display: none;"></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" value="Update" id="submit" class="btn btn-success float-left mb-2 mr-2">
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
        $('#submit').click(function() {
            var name = $('#name').val();
            var userValidate = 0;
            if (name == '') {
                $('#name_error').html('Please Enter Name!');
                $('#name').addClass('is-invalid');
                $('#name_error').show();
                userValiname = 1
            } else {
                $('#name_error').hide();
                $('#name').removeClass('is-invalid');
            }
            if (userValidate == 1) {
                return false;
            } else {
                return true;
            }
        });
    </script>
@endpush
