<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdvCaseNGP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-3 col-md-offset-6">
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Error!</strong> {{ $message }}
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}"
                                role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Success!</strong> {{ $message }}
                            </div>
                        @endif
                        <div class="card card-default">
                            <div class="card-header">
                                Pay Rs. <b>{{ $plan->item->amount / 100 }}</b> for your <b>{{ $plan->item->name }}</b>
                                Plan
                            </div>
                            <button id="rzp-button1">Pay</button>
                            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                            <script>
                                $(function() {
                                    $('#rzp-button1').trigger('click');
                                })
                                var options = {
                                    "key": "rzp_test_yWwIhzk5GoXraO",
                                    "subscription_id": "wxbvNsEj2eA6tHn0XcVa0QG6",
                                    "name": "AdvCaseNGP.",
                                    "amount": "{{ $plan->item->amount / 100 }}",
                                    "description": "Monthly Test Plan",
                                    "image": "/your_logo.jpg",
                                    "handler": function(response) {
                                        console.log(response.razorpay_payment_id),
                                            console.log(response.razorpay_subscription_id),
                                            console.log(response.razorpay_signature);
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        })
                                        $.ajax({
                                            type: 'POST',
                                            url: '{{ route('updateUserDataAfterPayment') }}',
                                            data: {
                                                razorpay_payment_id: response.razorpay_payment_id,
                                                razorpay_subscription_id: response.razorpay_subscription_id,
                                                razorpay_signature: response.razorpay_signature
                                            },
                                            success: function(data) {
                                                console.log(data);
                                                window.location.href = "{{ route('home')}}"; 
                                            }
                                        });
                                    },
                                    "prefill": {
                                        "name": "{{ Auth::user()->name }}",
                                        "email": "{{ Auth::user()->email }}",
                                        "contact": "{{ Auth::user()->phone }}"
                                    },
                                    "theme": {
                                        "color": "#F37254"
                                    }
                                };
                                var rzp1 = new Razorpay(options);
                                document.getElementById('rzp-button1').onclick = function(e) {
                                    rzp1.open();
                                    e.preventDefault();
                                }
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
