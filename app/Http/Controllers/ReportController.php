<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Auth;
use App\models\Report;

class ReportController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
     }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function districtCourtReport(Request $request)
    {    
        $data = Report::districtCourtReport('2');   
        // dd($data);      
        if ($request->ajax()) { 
             return Datatables::of($data)
                ->addIndexColumn() 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('reports.districtreport',compact('data')); 
    }
    public function highCourtReport(Request $request)
    {    
        $data = Report::districtCourtReport('1');           
        if ($request->ajax()) { 
             return Datatables::of($data)
                ->addIndexColumn() 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('reports.highreport',compact('data')); 
    } 
    public function todayReport(Request $request)
    {    
        $data = Report::dayWiseReport('today');      
        if ($request->ajax()) { 
             return Datatables::of($data)
                ->addIndexColumn() 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('reports.todayreport',compact('data')); 
    } 
    public function pastReport(Request $request)
    {            
        $data = Report::dayWiseReport('past');      
        if ($request->ajax()) { 
             return Datatables::of($data)
                ->addIndexColumn() 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('reports.pastreport',compact('data')); 
    } 
    public function futureReport(Request $request)
    {    
        $data = Report::dayWiseReport('future');       
        if ($request->ajax()) { 
             return Datatables::of($data)
                ->addIndexColumn() 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('reports.futurereport',compact('data')); 
    }
    public function recordRoomReport(Request $request)
    {    
        $data = Report::recordRoomReport(); 
        if ($request->ajax()) { 
             return Datatables::of($data)
                ->addIndexColumn() 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('reports.recordroomreport',compact('data')); 
    }
     
    public function dateWiseCaseReport(Request $request)
    {     
        $data = [];
        $startDate = '';
        $endDate = '';
        return view('reports.datewisecasereport',compact('data','startDate','endDate')); 
    }
    public function postDateWiseCaseReport(Request $request)
    {     
        $data = Report::datewiseCaseReport($request->get('startDate'),$request->get('endDate'));
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        return view('reports.datewisecasereport', compact('data','startDate','endDate')); 
    }
     
     
    
}