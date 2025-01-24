<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model {
    use HasFactory; 
 
    protected $fillable = [
        'userID','caseID','name','education','address','city','tahsil','district','state','phone','email'
    ];
}

 