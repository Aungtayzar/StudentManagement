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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('leadnumber')->unique();
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->unsignedInteger('gender_id');
            $table->integer('age');
            $table->string('email');
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->boolean('converted')->default(false);
            $table->unsignedBigInteger('student_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
