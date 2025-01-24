<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Redirect;
use App\Models\User;
use Auth;

class PaymentController extends Controller
{
    
    public function index()
    {
         
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
        // dd(env('APP_NAME'),env('RAZOR_SECRET'));
        $allPlans = $api->plan->all();
        // dd($allPlans);
        return view('subscriptions.index', compact('allPlans'));
    }
    public function create($planid)
    {
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
        $plan = $api->plan->fetch($planid);
        // dd($plan); 
          
        $subscriptions = $api->subscription->create(array(
            'plan_id' => $plan->id,
            'customer_notify' => 1,
            'quantity' => 1,
            'total_count' => 1,  
        ));
// dd($subscriptions);
        return view('subscriptions.razorpay', compact('plan', 'subscriptions'));
    }

    public function payment(Request $request)
    {
        $input = $request->all();

        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                dd($response);
            } catch (\Exception $e) {
                return  $e->getMessage();
                \Session::put('error', $e->getMessage());
                return redirect()->back();
            }
        }

        \Session::put('success', 'Payment successful');
        return redirect()->back();
    }
    public function updateUserDataAfterPayment(Request $request) {
        $data = $request->all(); 
        $users = User::findOrFail(Auth::user()->id);
        $requestData['isTrial'] = 0; 
        $requestData['razorpay_payment_id'] = $data['razorpay_payment_id'];
        $requestData['razorpay_subscription_id'] = $data['razorpay_subscription_id'];
        $requestData['razorpay_signature'] = $data['razorpay_signature'];  
        $users->update($requestData); 
        return $users;
    }
    
}
