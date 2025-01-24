@extends('layouts.app')

@section('content') 
<style type="text/css">
  .dt-buttons{
    display: inline;
    float: right;
    margin-left: 2%;
  }
</style>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Brief List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Brief List</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- /.card-header --> 
          <div class="card-body">
            <table id="giftcardtable" class="table table-bordered table-hover">
              <a style="cursor: pointer;" href="{{ route('briefs.create') }}" class="btn btn-primary float-sm-left mb-2"><i class="fas fa-plus"> Add</i></a> 
              <thead>
              <tr> 
                <th width="10%">Sr. No</th> 
                <th width="80%">Name</th> 
                <th width="10%">Action</th> 
              </tr>
              </thead>
              <tbody>
                @foreach($briefs as $key => $value)  
                  <tr>  
                    <td>{{$key + 1}}</td> 
                    <td>{{$value->name}}</td>  
                    <td class="project-actions" width="10%">
                      <form action="{{ route('briefs.destroy',$value->id) }}" method="POST"> 
                        <a class="btn btn-info btn-sm" href="{{ route('briefs.edit',$value->id)}}" title="Edit Brief">
                            <i class="fas fa-pencil-alt">
                            </i>
                        </a>
                        @csrf
                        @method('DELETE') 
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Brief"> <i class="fas fa-trash"></i></button> 
                      </form>
                    </td> 
                  </tr>    
                @endforeach 
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
 $(function () { 
  $('#giftcardtable').DataTable({ 
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'print'
    ]
  });
}); 
</script>
@endpush

