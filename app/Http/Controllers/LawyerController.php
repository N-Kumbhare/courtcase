<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lawyer;
use App\Models\Cases;
use Auth;
use DB;

class LawyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
     }    
    public function index()
    { 
        if(Auth::user()->isAdmin == '1'){
            $lawyers = DB::table('lawyers')
                ->join('cases', 'cases.id', '=', 'lawyers.caseID') 
                ->select('lawyers.*', 'cases.name as caseName')
                ->get();
        }else{
            $lawyers = DB::table('lawyers')
            ->join('cases', 'cases.id', '=', 'lawyers.caseID') 
            ->select('lawyers.*', 'cases.name as caseName')
            ->where('lawyers.userID','=',Auth::user()->id)
            ->get();
        }
        return view('lawyers.index',compact('lawyers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cases = Cases::where("recordroom","=","0")->get();
        return view('lawyers.create',compact('cases'));
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
        $requestData['userID'] =Auth::user()->id;
        Lawyer::create($requestData);   
        return redirect('/lawyers')->with('success', 'Lawyer saved Successfully!'); 
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
    public function edit(Lawyer $lawyer)
    {
        // dd($matter);
        $cases = Cases::where("recordroom","=","0")->get();
        return view('lawyers.edit',compact('lawyer','cases'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lawyer $lawyer)
    {
        $requestData = $request->all();
        $requestData['userID'] =Auth::user()->id;

        // dd($requestData);
        $lawyer->update($requestData);
        return redirect('/lawyers')->with('success', 'Lawyer Updated Successfully!');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lawyer $lawyer)
    {
        $lawyer->delete();
        return redirect()->route('lawyers.index')
                        ->with('success','Lawyer deleted successfully');
    }
}
