@extends('layouts.app')

@section('content')
   <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Import Product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li> 
            <li class="breadcrumb-item active">Import Product</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="row">
    <div class="col-md-12 ">
      <div class="">   
        <hr>
          <div class="card-body"> 
            <div>
              <blockquote class="quote-info">
                <h5>Tip!</h5>
                <a href="{{ asset('docs/sample_docs/sample_products.xlsx') }}" class="btn btn-info btn-sm float-right"><i class="fas fa-download"> Download Sample File</i></a> 
                <p>
                  <span class="text-info">The first line in downloaded csv file should remain as it is. Please do not change the order of columns.</span> <br>
                  <span class="text-success">The correct column order is (Product Code, Product Name, Purchase Price, Product Tax, Product Price, Category Code) </span>
                  <span class="text-primary">& you must follow this. If you are using any other language then English, please make sure the csv file is UTF-8 encoded and not saved with byte order mark (BOM)</span>  
                </p>
              </blockquote>
            </div>
            <form action="{{ route('productPost') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                  <input type="file" name="file">
                </div>
                <div>
                  <strong class="validate-color">{{ $errors->first('file') }}</strong>  
                </div>
                <br>
                <div>
                  <button class="btn btn-success">Import Product Data</button> 
                </div>
          </div>
                
            </form> 
          </div>
        <!-- /.card-body -->
        </form>
      </div>

      <!-- /.card -->
    </div> 
  </div> 
@endsection
 