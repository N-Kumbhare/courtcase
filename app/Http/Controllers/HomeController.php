<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Cases;
use App\models\User;
use DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }
    public function index()
    {             
        $todayCount = User::TodayCount();
        $pastCount = User::pastCount();
        $futureCount = User::futureCount();
        $recordRoomCount = User::roomRecordCount();

        $todayCountRegion = User::todayCountRegion();
        $pastCountRegion = User::pastCountRegion();
        $futureCountRegion = User::futureCountRegion();
        $roomRecordCountRegion = User::roomRecordCountRegion();
        
        $userID = '';
        if(Auth::user()->isAdmin == 1) {
            $userID = '1 =1';
        }else{
            $userID = 'C.userID = '.Auth::user()->id;
        } 
        $cases = DB::select("
            SELECT 
                COUNT(C.id) AS caseCount,
                C.userID AS userID, 
                IF(N.date <> '',N.date, C.caseDate) AS caseDate          
            FROM 
                cases C 
            LEFT JOIN 
                (SELECT * FROM `nextstages` N WHERE N.caseID IN (SELECT id FROM cases WHERE id = N.caseID) AND id IN(SELECT MAX(id) FROM nextstages GROUP BY caseID) ORDER BY N.id DESC) AS N
            ON 
                C.id = N.caseID
            WHERE
                ".$userID."
            AND
                C.recordRoom ='0'
            GROUP BY 
            C.caseDate, C.userID,N.date 
        ");
        
        return view('home', compact('cases','todayCount','pastCount','futureCount','recordRoomCount','todayCountRegion','pastCountRegion','futureCountRegion','roomRecordCountRegion'));

    }
}
