<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */ 
    public function up(): void
    {
        if (! Schema::hasTable('respondents')) {
            Schema::create('respondents', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();     
                $table->unsignedInteger('userID');    
                $table->unsignedInteger('caseID')->nullable();     
                $table->string('dob')->nullable();  
                $table->string('job')->nullable();
                $table->string('age')->nullable();
                $table->string('address')->nullable();
                $table->string('city')->nullable();
                $table->string('tahsil')->nullable();
                $table->string('district')->nullable();
                $table->string('state')->nullable();
                $table->string('phone')->nullable();    
                $table->string('email')->nullable();   
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respondents');
    }
};
