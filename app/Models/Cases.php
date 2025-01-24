<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Cases extends Model {
    use HasFactory; 
    protected $table = 'cases';

    protected $fillable = [
        'userID','name','caseNo','descriptions','districtCourtID', 'caseDate','matterID','briefID','courtID','casetypeID','caseID','recordRoom','caseRegion',
    ];
    public static function getCaseTypesList()
    {
        $queryBuilder = DB::table('casetypes')
             ->select('id','userID', 'name')
             ->where('userID','=',Auth::user()->id)
            ->get();
        return $queryBuilder;
    }
    public static function getBriefsList()
    {
        $queryBuilder = DB::table('briefs')
             ->select('id','userID', 'name')
             ->where('userID','=',Auth::user()->id)
            ->get();
        return $queryBuilder;
    }
    public static function getCourtsList()
    {
        $queryBuilder = DB::table('courts')
             ->select('id','userID', 'name')
             ->where('userID','=',Auth::user()->id)
            ->get();
        return $queryBuilder;
    }
    public static function getMattersList()
    {
        $queryBuilder = DB::table('matters')
             ->select('id','userID', 'name')
             ->where('userID','=',Auth::user()->id)
            ->get();
        return $queryBuilder;
    }
    public static function getDistrictCourtList()
    {
        $queryBuilder = DB::table('districtcourts')
             ->select('id', 'name')
            //  ->where('userID','=',Auth::user()->id)
            ->get();
        return $queryBuilder;
    }
}

 