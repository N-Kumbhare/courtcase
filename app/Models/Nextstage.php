<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nextstage extends Model {
    use HasFactory; 
    protected $fillable = [
        'userID','description','caseID','date','previousDate',
    ];
     
}

 