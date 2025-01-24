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
          <h1 class="m-0 text-dark">Create User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('users.index') }}"> User List</a></li>
            <li class="breadcrumb-item active">Create User</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="card card-primary">
        <!-- <div class="card-header">
          <h3 class="card-title">Add User</h3> 
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div> -->
        <form action="{{ route('users.store') }}" method="post">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="Group">Group</label><span class="validate-color">*</span>
              <select class="form-control custom-select" id="group" name="group">
                <option value="">Select Group</option>
                <option value="Admin">Admin</option>
                <option value="Staff">Staff</option> 
              </select>
              <span class="invalid-feedback" id="group_error" style="display: none;"></span>
            </div>
            <div class="form-group">
              <label for="firstname">First Name</label><span class="validate-color">*</span>
              <input type="text" name="fname" id="fname" class="form-control"  value="{{ old('fname') }}" placeholder="First Name">  
              <span class="invalid-feedback" id="fname_error" style="display: none;"></span>
            </div>
            <div class="form-group">
              <label for="lastname">Last Name</label><span class="validate-color">*</span>
              <input type="text" name="lname" id="lname" class="form-control @error('lname') is-invalid @enderror" value="{{ old('lname') }}" placeholder="Last Name">  
              <span class="invalid-feedback"  style="display: none;" id="lname_error"  style="display: none;"></span>
            </div>
            <div class="form-group">
              <label for="Phone">Phone</label><span class="validate-color">*</span>
              <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Phone">   
              <span class="invalid-feedback"  style="display: none;" id="phone_error"></span>
            </div>
            <div class="form-group">
              <label for="Gender">Gender</label><span class="validate-color">*</span>
              <select class="form-control custom-select" id="gender" name="gender">
                <option value="">Select Gender</option>
                <option value="m">Male</option>
                <option value="f">Female</option> 
              </select>
              <span class="invalid-feedback"  style="display: none;" id="gender_error"></span>
            </div>
            <div class="form-group">
              <label for="Phone">Email/Username</label><span class="validate-color">*</span>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="{{ __('E-Mail Address') }}">
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
              <span class="invalid-feedback"  style="display: none;" id="email_error"></span>
            </div>
            <div class="form-group">
              <label for="Phone">Password</label><span class="validate-color">*</span>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="{{ __('Password') }}"> 
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror          
              <span class="invalid-feedback"  style="display: none;" id="password_error"></span>
            </div>
            <div class="form-group">
              <label for="Phone">Confirm Password</label><span class="validate-color">*</span>
              <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="{{ __('Confirm Password') }}"> 
              <span class="invalid-feedback"  style="display: none;" id="password_confirmation_error"></span>
              <span class="invalid-feedback"  style="display: none;" id="password_confirmation_mismatch_error"></span>
            </div>
            <div class="form-group">
              <label for="status">Status</label><span class="validate-color">*</span>
              <select class="form-control custom-select" id="status" name="status">
                <option value="">Select Status</option>
                <option value="0">Active</option>
                <option value="1">InActive</option> 
              </select>
              <span class="invalid-feedback"  style="display: none;" id="status_error"></span>
            </div> 
            <div class="form-check">
              <input type="checkbox" name="notify" class="form-check-input" id="notify">
              <label class="form-check-label" for="notify">Notify Me on Email</label>
            </div>
          </div>
          <div class="col-12"> 
            <input type="submit" value="Add User"  id="submit" class="btn btn-success float-left mb-2">
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
     
      $('#submit').click(function(){
        var group = $('#group').val();
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var phone = $('#phone').val();
        var gender = $('#gender').val();
        var email = $('#email').val();
        var indexat = email.indexOf("@"); //Index of "@" in the email field
        var indexdot = email.indexOf("."); //Index of "." in the email field
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();
        var status = $('#status').val();
        var userValidate = 0; 

        if(group == ''){
          $('#group_error').html('Please select Group!');
          $('#group').addClass('is-invalid');
          $('#group_error').show(); 
          userValidate = 1;
        }else{
          $('#group_error').hide();
          $('#group').removeClass('is-invalid');
        }
        if(fname == ''){
         $('#fname_error').html('Please Enter First Name!');
         $('#fname').addClass('is-invalid');
         $('#fname_error').show();
          userValidate = 1
        }else{
          $('#fname_error').hide();
          $('#fname').removeClass('is-invalid');
        }
        if(lname == ''){
         $('#lname_error').html('Please Enter Last Name!');
         $('#lname').addClass('is-invalid');
         $('#lname_error').show();
          userValidate = 1
        }else{
          $('#lname_error').hide();
          $('#lname').removeClass('is-invalid');
        }
         
        if (phone.length !== 10) {
           $('#phone_error').html('Please Enter 10 digit Phone Number!');
           $('#phone').addClass('is-invalid');
           $('#phone_error').show();
            userValidate = 1
        }else {
            $('#phone_error').hide();
            $('#phone').removeClass('is-invalid');
        }
         
        if(gender == ''){
         $('#gender_error').html('Please Select gender!');
         $('#gender').addClass('is-invalid');
         $('#gender_error').show();
          userValidate = 1
        }else{
          $('#gender_error').hide();
          $('#gender').removeClass('is-invalid');
        }
        if(email == ''){
         $('#email_error').html('Please Enter Email!');
         $('#email').addClass('is-invalid');
         $('#email_error').show();
          userValidate = 1
        }else if(indexat < 1 || (indexdot-indexat) < 2){
          $('#email_error').hide();
          $('#email_error').html('Please Enter a valid Email ID!');
          $('#email').addClass('is-invalid');
          $('#email_error').show();
          userValidate = 1
        }else{
          $('#email_error').hide();
          $('#email').removeClass('is-invalid');
        }
        if(password == ''){
         $('#password_error').html('Please Enter password!');
         $('#password').addClass('is-invalid');
         $('#password_error').show();
          userValidate = 1
        }else{
          $('#password_error').hide();
          $('#password').removeClass('is-invalid');
        }
        if(password_confirmation == ''){
         $('#password_confirmation_error').html('Please Enter confirm Password!');
         $('#password_confirmation').addClass('is-invalid');
         $('#password_confirmation_error').show();
          userValidate = 1
        }else{
          $('#password_confirmation_error').hide();
          $('#password_confirmation').removeClass('is-invalid');
        }
        if(password != password_confirmation){
          $('#password_confirmation_mismatch_error').html('Password and Confirm Password must be same!');
          $('#password_confirmation_mismatch').addClass('is-invalid');
          $('#password_confirmation_mismatch_error').show();
           userValidate = 1
        }else{
          $('#password_confirmation_mismatch_error').hide();
          $('#password_confirmation_mismatch').removeClass('is-invalid');
        }
        if(status == ''){
         $('#status_error').html('Please Select status!');
         $('#status').addClass('is-invalid');
         $('#status_error').show();
          userValidate = 1
        }else{
          $('#status_error').hide();
          $('#status').removeClass('is-invalid');
        }
        if(userValidate == 1){
          return false;
        }else{ 
          return true;
        }
      });
    
     
  </script>
 @endpush