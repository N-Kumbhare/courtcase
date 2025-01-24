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
        if (! Schema::hasTable('lawyers')) {
            Schema::create('lawyers', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();     
                $table->unsignedInteger('userID');    
                $table->unsignedInteger('caseID')->nullable();     
                $table->string('education')->nullable();    
                $table->string('address')->nullable();    
                $table->string('tahsil')->nullable();    
                $table->string('district')->nullable();    
                $table->string('state')->nullable();  
                $table->string('city')->nullable();   
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
        Schema::dropIfExists('lawyers');
    }
};
