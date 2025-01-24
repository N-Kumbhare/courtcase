<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Casetype;
use Auth;

class CasetypeController extends Controller
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
        $casetypes = Casetype::where('userID',Auth::user()->id)->get();
         
        return view('masters.casetypes.index',compact('casetypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.casetypes.create');
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

        // dd($requestData);
        Casetype::create($requestData);   
        return redirect('/casetypes')->with('success', 'Case Type saved Successfully!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Giftcard $giftcard)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Casetype $casetype)
    {
        return view('masters.casetypes.edit',compact('casetype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Casetype $casetype)
    {
        $requestData = $request->all();
        $requestData['userID'] = Auth::user()->id;
         $casetype->update($requestData);
        return redirect('/casetypes')->with('success', 'Case Type Updated Successfully!');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Casetype $casetype)
    {
        $casetype->delete(); 
        return redirect()->route('casetypes.index')
                        ->with('success','Case Type deleted successfully');
    }
}
