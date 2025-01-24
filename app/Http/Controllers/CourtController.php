<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Court;
use Auth;

class CourtController extends Controller
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
        $courts = Court::where('userID',Auth::user()->id)->get();
        return view('masters.courts.index',compact('courts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.courts.create');
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
        Court::create($requestData);   
        return redirect('/courts')->with('success', 'Court saved Successfully!'); 
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
    public function edit(Court $court)
    {
        // dd($matter);
        return view('masters.courts.edit',compact('court'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Court $court)
    {
        $requestData = $request->all();
        $requestData['userID'] = Auth::user()->id;
        $court->update($requestData);
        return redirect('/courts')->with('success', 'Court Updated Successfully!');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Court $court)
    {
        $court->delete(); 
        return redirect()->route('courts.index')
                        ->with('success','Court deleted successfully');
    }
}
