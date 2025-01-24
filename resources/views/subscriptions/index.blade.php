@extends('layouts.login.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom/subscription.css') }}">
@endpush
@section('content')
<div class="row d-flex justify-content-end">
    <div class="col-md-12">
        <!--PRICE HEADING START-->
        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
            onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
            <i class="fas fa-lock mr-2"></i> {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form> 
    </div>
</div>
    <div id="generic_price_table">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--PRICE HEADING START-->
                        <div class="price-heading clearfix">
                            <h1>Select your plan</h1>
                        </div>
                        <!--//PRICE HEADING END-->
                    </div>
                </div>
            </div>
            <div class="container-fluid">

                <div class="row">
                    @foreach ($allPlans->items as $plan)
                        {{-- @php
                    echo('<pre>');
                     print_r($plan);
                    @endphp --}}
                        <div class="col-md-4">
                            <div class="generic_content active clearfix">
                                <div class="generic_head_price clearfix">
                                    <div class="generic_head_content clearfix">
                                        <div class="head_bg"></div>
                                        <div class="head">
                                            <span>{{ $plan->item->name }}</span>
                                        </div>
                                    </div>
                                    <div class="generic_price_tag clearfix">
                                        <span class="price">
                                            <span class="sign"><i class="fas fa-rupee-sign"></i></span>
                                            <span class="currency">{{ $plan->item->amount / 100 }}</span>
                                            <span class="month">/MON</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="generic_feature_list">
                                    <ul>
                                        <li><span>UnLimited</span> Users</li>
                                        <li><span>UnLimited</span> File Access</li>
                                    </ul>
                                </div>
                                <div class="generic_price_btn clearfix">
                                    <a class=""
                                        href="{{ route('pay.with.razorpay', ['planid' => $plan->id]) }}">Proceed</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>

    </div>
@endsection
