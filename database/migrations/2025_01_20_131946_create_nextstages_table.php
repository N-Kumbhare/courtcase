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
        if (! Schema::hasTable('nextstages')) {
            Schema::create('nextstages', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('userID'); 
                $table->string('description')->nullable();                
                $table->string('date')->nullable(); 
                $table->bigInteger('caseID'); 
                $table->dateTime('previousDate', precision: 0)->nullable();            
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nextstages');
    }
};
