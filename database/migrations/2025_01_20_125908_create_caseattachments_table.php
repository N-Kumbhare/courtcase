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
        if (! Schema::hasTable('caseattachments')) {
            Schema::create('caseattachments', function (Blueprint $table) {
                $table->id(); 
                $table->unsignedInteger('userID'); 
                $table->bigInteger('caseID')->nullable();
                $table->string('tmpPath')->nullable();    
                $table->string('fileName')->nullable();     
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caseattachments');
    }
};
