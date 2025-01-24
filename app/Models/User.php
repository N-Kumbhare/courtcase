<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', 'email', 'password','phone','regNo','state','district','razorpay_payment_id','razorpay_subscription_id','razorpay_signature','status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    protected function TodayCount(){
        $query =  Cases::where("caseDate", '=', date('Y-m-d'))
                        ->where('recordRoom','=','0')
                        ->where('userID','=',Auth::user()->id)
                        ->count(); 
        return $query;
    }
    protected function todayCountRegion(){
        $district =  Cases::where("caseDate", '=', date('Y-m-d'))
                        ->where('recordRoom','=','0')
                        ->where('caseRegion','=','1')
                        ->where('userID','=',Auth::user()->id)
                        ->count(); 
        $high =  Cases::where("caseDate", '=', date('Y-m-d'))
                        ->where('recordRoom','=','0')
                        ->where('caseRegion','=','2')
                        ->where('userID','=',Auth::user()->id)
                        ->count(); 
        $resopnse = ['district'=> $district ,'high'=> $high];
        return $resopnse;
    }
    protected function pastCount(){
        $userID = '';
        if(Auth::user()->isAdmin == 1) {
            $userID = '1 =1';
        }else{
            $userID = 'C.userID = '.Auth::user()->id;
        } 
        $query =  DB::select("
            SELECT  
                COUNT(C.id) AS caseCount,  
                N.date AS nextDate
            FROM 
                cases C 
            LEFT JOIN 
                (SELECT * FROM `nextstages` N WHERE N.caseID IN (SELECT id FROM cases WHERE id = N.caseID) AND id IN(SELECT MAX(id) FROM nextstages GROUP BY caseID) ORDER BY N.id DESC) AS N
            ON 
                C.id = N.caseID
            WHERE
                ".$userID."
            AND 
                C.recordRoom = '0'
            AND
                IF(N.date <> '',N.date,C.caseDate) < CURDATE() 
            ");     
        
            return $query ? $query[0]->caseCount : 0;
        }
    protected function pastCountRegion(){
        $district =  Cases::where("caseDate", '<', date('Y-m-d'))
                         ->where('recordRoom','=','0')
                         ->where('caseRegion','=','1')
                         ->where('userID','=',Auth::user()->id)
                         ->count(); 
        $high =  Cases::where("caseDate", '<', date('Y-m-d'))
                         ->where('recordRoom','=','0')
                         ->where('caseRegion','=','2')
                         ->where('userID','=',Auth::user()->id)
                         ->count(); 
        $resopnse = ['district'=> $district ,'high'=> $high];
        return $resopnse;
    }
    protected function futureCount(){
        $userID = '';
        if(Auth::user()->isAdmin == 1) {
            $userID = '1 =1';
        }else{
            $userID = 'C.userID = '.Auth::user()->id;
        } 
        $query =  DB::select("
            SELECT 
                C.id AS id,
                COUNT(C.id) AS caseCount,  
                N.date AS nextDate
            FROM 
                cases C 
            LEFT JOIN 
                (SELECT * FROM `nextstages` N WHERE N.caseID IN (SELECT id FROM cases WHERE id = N.caseID) AND id IN(SELECT MAX(id) FROM nextstages GROUP BY caseID) ORDER BY N.id DESC) AS N
            ON 
                C.id = N.caseID
            WHERE
                ".$userID."
            AND 
                C.recordRoom = '0'
            AND
                IF(N.date <> '',N.date,C.caseDate) > CURDATE()
            GROUP BY 
                N.date,C.id     
            ");             
       return $query ? $query[0]->caseCount : 0;
    }
    protected function futureCountRegion(){
        $district =  Cases::where("caseDate", '>', date('Y-m-d'))
                        ->where('recordRoom','=','0')
                        ->where('caseRegion','=','1')
                        ->where('userID','=',Auth::user()->id)
                        ->count(); 
        $high =  Cases::where("caseDate", '>', date('Y-m-d'))
                        ->where('recordRoom','=','0')
                        ->where('caseRegion','=','2')
                        ->where('userID','=',Auth::user()->id)
                        ->count();  
        $resopnse = ['district'=> $district ,'high'=> $high];
        return $resopnse;
    }
    protected function roomRecordCount(){
        $query =  Cases::where("recordRoom", '=', '1')
                        ->where('userID','=',Auth::user()->id)
                        ->count();  
        return $query;
    }

    protected function roomRecordCountRegion(){
        $district =  Cases::where("recordRoom", '=', '1')
                        ->where('caseRegion','=','1')
                        ->where('userID','=',Auth::user()->id)
                        ->count();  
        $high =  Cases::where("recordRoom", '=', '1')
                        ->where('caseRegion','=','2')
                        ->where('userID','=',Auth::user()->id)
                        ->count();  
        $resopnse = ['district'=> $district ,'high'=> $high];                        
        return $resopnse;
    }
}
