<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Districtcourt;
use Auth;

class DistrictcourtController extends Controller
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
        $courts = Districtcourt::where('userID',Auth::user()->id)->get();
        return view('masters.districtcourts.index',compact('courts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.districtcourts.create');
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
        Districtcourt::create($requestData);   
        return redirect('/districtcourts')->with('success', 'Court saved Successfully!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Court $court)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Districtcourt $districtcourt)
    {
        // dd($matter);
        return view('masters.districtcourts.edit',compact('districtcourt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Districtcourt $districtcourt)
    {
        $requestData = $request->all();
        $requestData['userID'] = Auth::user()->id;
        $districtcourt->update($requestData);
        return redirect('/districtcourts')->with('success', 'Court Updated Successfully!');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Districtcourt $districtcourt)
    {
        $districtcourt->delete(); 
        return redirect()->route('districtcourts.index')
                        ->with('success','Court deleted successfully');
    }
}
