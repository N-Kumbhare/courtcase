<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Cases;
use App\models\User;
use DB;
use Auth;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        return view('frontend.termsofuse');
    }
}