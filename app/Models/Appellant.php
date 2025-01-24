<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Appellant extends Model {
    use HasFactory; 
 
    protected $fillable = [
        'userID','name','dob','job','age','address','city','tahsil','district','state','phone','email','created_at','updated_at','caseID',
    ];
     
}

 