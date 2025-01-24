<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brief;
use Auth;

class BriefController extends Controller
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
        $briefs = Brief::where('userID',Auth::user()->id)->get();
        return view('masters.briefs.index',compact('briefs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.briefs.create');
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
        Brief::create($requestData);   
        return redirect('/briefs')->with('success', 'Brief saved Successfully!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Brief $brief)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brief $brief)
    {
        // dd($matter);
        return view('masters.briefs.edit',compact('brief'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brief $brief)
    {
        $requestData = $request->all();
        $requestData['userID'] = Auth::user()->id;
        $brief->update($requestData);
        return redirect('/briefs')->with('success', 'Brief Updated Successfully!');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brief $brief)
    {
        $brief->delete(); 
        return redirect()->route('briefs.index')
                        ->with('success','Brief deleted successfully');
    }
}
