@extends('layouts.app')

@section('content') 
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Calculator </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Calculator</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default"> 
                <div class="card-body">
                   <!--  <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Case Type</label>
                                <select class="form-control" name="casetypes" id="casetypes">
                                    @foreach ($matters as $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Suit Value</label>
                                <div class="input-group">
                                    <input type="text" name="suitValue" id="suitValue" class="form-control"
                                        value="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>%</label>
                                <select class="form-control" name="percentIn" id="percentIn">
                                    <option value="{{ $data->id }}"> Full </option>
                                    <option value="{{ $data->id }}"> Half </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Court Fee</label>
                                <div class="input-group">
                                    <input type="text" name="courtFee" id="courtFee" class="form-control"
                                        value="" />
                                </div>
                            </div>
                        </div>

                    </div> -->
                     <div class="row">           
                      <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                          <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-court-fee-tab" data-toggle="pill" href="#custom-tabs-four-court-fee" role="tab" aria-controls="custom-tabs-four-court-fee" aria-selected="true">Court Fee</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-suit-claim-tab" data-toggle="pill" href="#custom-tabs-four-suit-claim" role="tab" aria-controls="custom-tabs-four-suit-claim" aria-selected="false">Suit claim</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-execuation-claim-tab" data-toggle="pill" href="#custom-tabs-four-execuation" role="tab" aria-controls="custom-tabs-four-execuation" aria-selected="false">Execuation claim</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-interest-amt-tab" data-toggle="pill" href="#custom-tabs-four-interest-amt" role="tab" aria-controls="custom-tabs-four-interest-amt" aria-selected="false">Interest Amt</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-rent-with-interest-tab" data-toggle="pill" href="#custom-tabs-four-rent-with-interest-amt" role="tab" aria-controls="custom-tabs-four-rent-with-interest-amt" aria-selected="false">Rent with Interest</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-limitation-period-tab" data-toggle="pill" href="#custom-tabs-four-limitation-period" role="tab" aria-controls="custom-tabs-four-limitation-period" aria-selected="false">Limitation Period</a>
                              </li>
                            </ul>
                          </div>
                          <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                              <div class="tab-pane fade show active" id="custom-tabs-four-court-fee" role="tabpanel" aria-labelledby="custom-tabs-four-court-fee-tab">
                                @include('calculator.courtfee')
                              </div> 
                              <div class="tab-pane fade" id="custom-tabs-four-suit-claim" role="tabpanel" aria-labelledby="custom-tabs-four-suit-claim-tab">
                                @include('calculator.suitclaim')        
                              </div>
                              <div class="tab-pane fade" id="custom-tabs-four-execuation" role="tabpanel" aria-labelledby="custom-tabs-four-execuation-tab">
                                @include('calculator.executionclaim')
                              </div>
                              <div class="tab-pane fade" id="custom-tabs-four-interest-amt" role="tabpanel" aria-labelledby="custom-tabs-four-interest-amt-tab">
                                 @include('calculator.intererstamount')
                              </div>
                              <div class="tab-pane fade" id="custom-tabs-four-rent-with-interest-amt" role="tabpanel" aria-labelledby="custom-tabs-four-rent-with-interest-amt-tab">
                                 @include('calculator.rent')
                              </div>
                              <div class="tab-pane fade" id="custom-tabs-four-limitation-period" role="tabpanel" aria-labelledby="custom-tabs-four-limitation-period-tab">
                                @include('calculator.limitationperiod')
                             </div>
                            </div>
                          </div>
                          <!-- /.card -->
                        </div>
                      </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript"></script>
@endpush
