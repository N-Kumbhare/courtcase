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
        if (! Schema::hasTable('appellants')) {
            Schema::create('appellants', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email');
                $table->unsignedInteger('userID'); 
                $table->string('dob')->nullable();        
                $table->string('job')->nullable();
                $table->string('age')->nullable();
                $table->string('address')->nullable();
                $table->string('city')->nullable();
                $table->string('tahsil')->nullable();
                $table->string('district')->nullable();
                $table->string('state')->nullable();
                $table->string('phone'); 
                $table->string('caseID'); 
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appellants');
    }
};
