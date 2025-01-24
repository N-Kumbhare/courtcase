<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matter;
use Auth;

class MatterController extends Controller
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
        $matters = Matter::where('userID',Auth::user()->id)->get();
        return view('masters.matters.index',compact('matters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.matters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all(); 
        $requestData['userID'] = Auth::user()->id;
        Matter::create($requestData);   
        return redirect('/matters')->with('success', 'Matters saved Successfully!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Matter $matters)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Matter $matter)
    {
        // dd($matter);
        return view('masters.matters.edit',compact('matter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matter $matter)
    {
        $requestData = $request->all();
        $requestData['userID'] = Auth::user()->id;
        $matter->update($requestData);
        return redirect('/matters')->with('success', 'Matter Updated Successfully!');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matter $matter)
    {
        $matter->delete(); 
        return redirect()->route('matters.index')
                        ->with('success','Matter deleted successfully');
    }
}
