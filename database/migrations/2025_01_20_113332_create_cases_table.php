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
        if (! Schema::hasTable('cases')) {
            Schema::create('cases', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->unsignedInteger('userID'); 
                $table->string('caseNo')->nullable();
                $table->longText('descriptions')->nullable();
                $table->bigInteger('districtCourtID')->nullable();
                $table->date('caseDate')->nullable();
                $table->bigInteger('courtID')->nullable();
                $table->bigInteger('matterID')->nullable();
                $table->bigInteger('briefID')->nullable();
                $table->bigInteger('casetypeID')->nullable();
                $table->bigInteger('caseID')->nullable();
                $table->enum('recordRoom', ['0','1'])->nullable();
                $table->enum('caseRegion', ['1'])->nullable();
                $table->timestamps(); 
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};
