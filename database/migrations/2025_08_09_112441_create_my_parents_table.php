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
        Schema::create('my_parents', function (Blueprint $table) {
            $table->id();
            $table->string("email")->unique();
            $table->string("password");
            //Father Infrmation
            $table->string("Name_Father");
            $table->string("National_ID_Father");
            $table->string("Password_ID_Father");
            $table->string("Phone_Father");
            $table->string("Jop_Father");
            $table->bigInteger("nationalities_Father_id")->unsigned();
            $table->bigInteger("blood_types_Father_id")->unsigned();
            $table->bigInteger("religions_Father_id")->unsigned();
            $table->string("Adress_Father");
            // Mother Information
            $table->string("Name_Mother");
            $table->string("National_ID_Mother");
            $table->string("Password_ID_Mother");
            $table->string("Phone_Mother");
            $table->string("Jop_Mother");
            $table->bigInteger("nationalities_Mother_id")->unsigned();
            $table->bigInteger("blood_types_Mother_id")->unsigned();
            $table->bigInteger("religions_Mother_id")->unsigned();
            $table->string("Adress_Mother");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_parents');
    }
};