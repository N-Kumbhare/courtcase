<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matter;
 
class CalculatorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $matters = Matter::all();
        
        return view('calculator.index', compact('matters'));
    }

     
}
