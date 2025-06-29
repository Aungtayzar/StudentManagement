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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('regnumber')->unique();
            $table->string('image')->nullable();
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->string('slug');
            $table->date('dob')->nullable();
            $table->unsignedInteger('gender_id');
            $table->integer('age');
            $table->string('email')->unique();
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('region_id')->nullable();
            $table->unsignedInteger('city_id'); 
            $table->unsignedInteger('township_id')->nullable(); 
            $table->string('address')->nullable(); 
            $table->unsignedBigInteger('religion_id')->nullable(); 
            $table->string('nationalid')->nullable(); 
            $table->text('remark')->nullable();
            $table->unsignedInteger('status_id')->default(1);
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
