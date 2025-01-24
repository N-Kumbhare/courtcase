<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Report extends Model
{
    protected function districtCourtReport($param){ 
        $userID = '';
        if(Auth::user()->isAdmin == 1) {
            $userID = '1 =1';
        }else{
            $userID = 'C.userID = '.Auth::user()->id;
        } 
        $query =  DB::select("
                        SELECT 
                            C.id AS id,
                            C.userID AS userID,
                            N.id AS nextStageID,	 
                            C.name AS casename, 
                            C.caseNo AS caseNo,
                            C.districtCourtID,
                            D.name AS caseRegion,
                            C.courtID,
                            CC.name AS courtName,
                            L.name AS lawyerName,
                            -- IF(C.caseRegion = '1', 'District','High') AS caseRegion,
                            N.caseID AS nextStageCaseID,
                            DATE_FORMAT(C.caseDate,'%d/%m/%Y')  AS caseDate,
                            DATE_FORMAT(N.date,'%d/%m/%Y') AS nextDate,            
                            DATE_FORMAT(N.previousDate,'%d/%m/%Y') AS previousDate
                        FROM 
                            cases C 
                        LEFT JOIN 
                            (SELECT * FROM `nextstages` N WHERE N.caseID IN (SELECT id FROM cases WHERE id = N.caseID) AND id IN(SELECT MAX(id) FROM nextstages GROUP BY caseID) ORDER BY N.id DESC) AS N
                        ON 
                            C.id = N.caseID
                        LEFT JOIN 
                            districtcourts D
                        ON 
                            D.id = C.districtCourtID
                        LEFT JOIN 
                            courts CC
                        ON
                            C.courtID = CC.id
                        LEFT JOIN
                            lawyers L
                        ON
                            C.id = L.caseID 
                        WHERE 
                            ".$userID."
                        AND
                            D.id = ".$param."
                        AND
                            recordRoom = '0'
                        ORDER BY 
                            C.id DESC
                    
                    ");     
        
        return $query;
    }
    protected function dayWiseReport($param){ 
        $userID = '';
        $dateParam = '';
        if(Auth::user()->isAdmin == 1) {
            $userID = '1 =1';
        }else{
            $userID = 'C.userID = '.Auth::user()->id;
        } 
        if($param == 'today'){
            $dateParam = 'C.caseDate = CURDATE()';
        }else if($param == 'past'){
            $dateParam = 'C.caseDate < CURDATE()';
        }else{
            $dateParam = 'C.caseDate > CURDATE()';
        }
        $query =  DB::select("
                        SELECT 
                            C.id AS id,
                            C.userID AS userID,
                            N.id AS nextStageID,	 
                            C.name AS casename, 
                            C.caseNo AS caseNo,
                            C.districtCourtID,
                            D.name AS caseRegion,
                            C.courtID,
                            CC.name AS courtName,
                            L.name AS lawyerName,
                            -- IF(C.caseRegion = '1', 'District','High') AS caseRegion,
                            N.caseID AS nextStageCaseID,
                            DATE_FORMAT(C.caseDate,'%d/%m/%Y')  AS caseDate,
                            DATE_FORMAT(N.date,'%d/%m/%Y') AS nextDate,            
                            DATE_FORMAT(N.previousDate,'%d/%m/%Y') AS previousDate
                        FROM 
                            cases C 
                        LEFT JOIN 
                            (SELECT * FROM `nextstages` N WHERE N.caseID IN (SELECT id FROM cases WHERE id = N.caseID) AND id IN(SELECT MAX(id) FROM nextstages GROUP BY caseID) ORDER BY N.id DESC) AS N
                        ON 
                            C.id = N.caseID
                        LEFT JOIN 
                            districtcourts D
                        ON 
                            D.id = C.districtCourtID
                        LEFT JOIN 
                            courts CC
                        ON
                            C.courtID = CC.id
                        LEFT JOIN
                            lawyers L
                        ON
                            C.id = L.caseID 
                        WHERE 
                            ".$userID."
                        AND
                            ".$dateParam."
                        AND
                            recordRoom = '0'
                        ORDER BY 
                            C.id DESC
                    
                    ");     
        
        return $query;
    }
    protected function recordRoomReport(){ 
        $userID = '';
        if(Auth::user()->isAdmin == 1) {
            $userID = '1 =1';
        }else{
            $userID = 'C.userID = '.Auth::user()->id;
        }        
        $query =  DB::select("
                        SELECT 
                            C.id AS id,
                            C.userID AS userID,
                            N.id AS nextStageID,	 
                            C.name AS casename, 
                            C.caseNo AS caseNo,
                            C.districtCourtID,
                            D.name AS caseRegion,
                            C.courtID,
                            CC.name AS courtName,
                            L.name AS lawyerName,
                            -- IF(C.caseRegion = '1', 'District','High') AS caseRegion,
                            N.caseID AS nextStageCaseID,
                            DATE_FORMAT(C.caseDate,'%d/%m/%Y')  AS caseDate,
                            DATE_FORMAT(N.date,'%d/%m/%Y') AS nextDate,            
                            DATE_FORMAT(N.previousDate,'%d/%m/%Y') AS previousDate
                        FROM 
                            cases C 
                        LEFT JOIN 
                            (SELECT * FROM `nextstages` N WHERE N.caseID IN (SELECT id FROM cases WHERE id = N.caseID) AND id IN(SELECT MAX(id) FROM nextstages GROUP BY caseID) ORDER BY N.id DESC) AS N
                        ON 
                            C.id = N.caseID
                        LEFT JOIN 
                            districtcourts D
                        ON 
                            D.id = C.districtCourtID
                        LEFT JOIN 
                            courts CC
                        ON
                            C.courtID = CC.id
                        LEFT JOIN
                            lawyers L
                        ON
                            C.id = L.caseID 
                        WHERE 
                            ".$userID."  
                        AND
                            C.recordRoom = '1'
                        ORDER BY 
                            C.id DESC
                    
                    ");     
        
        return $query;
    }
    protected function datewiseCaseReport($startDate, $endDate){         
        $userID = '';
        if(Auth::user()->isAdmin == 1) {
            $userID = '1 =1';
        }else{
            $userID = 'C.userID = '.Auth::user()->id;
        }                 
        $query =  DB::select("
                        SELECT 
                            C.id AS id,
                            C.userID AS userID,
                            N.id AS nextStageID,	 
                            C.name AS casename, 
                            C.caseNo AS caseNo,
                            C.districtCourtID,
                            D.name AS caseRegion,
                            C.courtID,
                            CC.name AS courtName,
                            L.name AS lawyerName,
                            
                            N.caseID AS nextStageCaseID,
                            DATE_FORMAT(C.caseDate,'%d/%m/%Y')  AS caseDate,
                            DATE_FORMAT(N.date,'%d/%m/%Y') AS nextDate,            
                            DATE_FORMAT(N.previousDate,'%d/%m/%Y') AS previousDate
                        FROM 
                            cases C 
                        LEFT JOIN 
                            (SELECT * FROM `nextstages` N WHERE N.caseID IN (SELECT id FROM cases WHERE id = N.caseID) AND id IN(SELECT MAX(id) FROM nextstages GROUP BY caseID) ORDER BY N.id DESC) AS N
                        ON 
                            C.id = N.caseID
                        LEFT JOIN 
                            districtcourts D
                        ON 
                            D.id = C.districtCourtID
                        LEFT JOIN 
                            courts CC
                        ON
                            C.courtID = CC.id
                        LEFT JOIN
                            lawyers L
                        ON
                            C.id = L.caseID 
                        WHERE 
                            ".$userID."  
                        AND
                            C.caseDate BETWEEN '".$startDate."' AND '".$endDate."' 
                        ORDER BY 
                            C.id DESC
                    
                    "); 
        return $query;
    }
}
