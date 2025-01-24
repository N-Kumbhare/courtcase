@extends('layouts.app')

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Add User</h3> 
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <form action="{{ route('users.update',$user->id) }}" method="post">
          @csrf
          @method('PUT')
          <div class="card-body">
            <div class="form-group">
              <label for="group">Group</label>
              <select class="form-control custom-select" id="group" name="group">
                <option value="">Select Group</option>
                
                <option @if($user->group == 'Admin') selected @endif value="Admin">Admin</option>
                <option  @if($user->group == 'Staff') selected @endif value="Staff">Staff</option> 
              </select>
            </div>
            <div class="form-group">
              <label for="firstname">First Name</label>
              <input type="text" name="fname" id="fname" class="form-control @error('fname') is-invalid @enderror"  value="{{ $user->fname }}" placeholder="First Name">  
            </div>
            <div class="form-group">
              <label for="lastname">Last Name</label>
              <input type="text" name="lname" id="lname" class="form-control @error('lname') is-invalid @enderror" value="{{ $user->lname }}" placeholder="Last Name">  
            </div>
            <div class="form-group">
              <label for="Phone">Phone</label>
              <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone }}" placeholder="Phone">   
            </div>
            <div class="form-group">
              <label for="Gender">Gender</label>
              <select class="form-control custom-select" id="gender" name="gender">
                <option value="">Select Gender</option>
                <option @if($user->gender == 'm') selected @endif value="m">Male</option>
                <option @if($user->gender == 'f') selected @endif value="f">Female</option> 
              </select>
            </div>
            <div class="form-group">
              <label for="Phone">Email/Username</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email" placeholder="{{ __('E-Mail Address') }}">
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control custom-select" id="status" name="status">
                <option value="">Select Status</option>
                <option @if($user->status == 0) selected @endif value="0">Active</option>
                <option @if($user->status == 1) selected @endif value="1">InActive</option> 
              </select>
            </div> 
            <div class="form-check">
              <input type="checkbox" name="notify" class="form-check-input" id="notify">
              <label class="form-check-label" for="notify">Notify Me on Email</label>
            </div>
          </div>
          <div class="col-12"> 
            <input type="submit" id="submit" value="Add User" class="btn btn-success float-left mb-2">
          </div> 

        <!-- /.card-body -->
        </form>
      </div>

      <!-- /.card -->
    </div> 
  </div>
  <!-- <div class="row">
    <div class="col-12">
      <a href="#" class="btn btn-secondary">Cancel</a>
      <input type="submit" value="Create new Porject" class="btn btn-success float-right">
    </div>
  </div> -->
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
        var status = $('#status').val();
        var userValidate = 0;
        
        if(group == ''){
          $('#group_error').html('Please select Group!');
          $('#group').addClass('is-invalid');
          $('#group_error').show(); 
          userValidate = 1;
        }else{
          $('#group_error').hide();
        }
        if(fname == ''){
         $('#fname_error').html('Please Enter First Name!');
         $('#fname').addClass('is-invalid');
         $('#fname_error').show();
          userValidate = 1
        }else{
          $('#fname_error').hide();
        }
        if(lname == ''){
         $('#lname_error').html('Please Enter Last Name!');
         $('#lname').addClass('is-invalid');
         $('#lname_error').show();
          userValidate = 1
        }else{
          $('#lname_error').hide();
        }
        if(phone == ''){
         $('#phone_error').html('Please Enter Phone Number!');
         $('#phone').addClass('is-invalid');
         $('#phone_error').show();
          userValidate = 1
        }else{
          $('#phone_error').hide();
        }
        if(gender == ''){
         $('#gender_error').html('Please Select gender!');
         $('#gender').addClass('is-invalid');
         $('#gender_error').show();
          userValidate = 1
        }else{
          $('#gender_error').hide();
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
        }  
        if(status == ''){
         $('#status_error').html('Please Select status!');
         $('#status').addClass('is-invalid');
         $('#status_error').show();
          userValidate = 1
        }else{
          $('#status_error').hide();
        }
        if(userValidate == 1){
          return false;
        }else{ 
          return true;
        } 
      });
</script>
@endpush 