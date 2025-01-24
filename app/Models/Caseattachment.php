<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caseattachment extends Model {
    use HasFactory; 
 
    protected $fillable = [
        'userID','caseID','tmpPath','fileName',
    ];
     
}

 