<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMyParentsTable extends Migration
{
    public function up()
    {
        Schema::table('my_parents', function(Blueprint $table) {
            $table->foreign('nationalities_Father_id')->references('id')->on('nationalities');
            $table->foreign('blood_types_Father_id')->references('id')->on('blood_types');
            $table->foreign('religions_Father_id')->references('id')->on('religions');
            $table->foreign('nationalities_Mother_id')->references('id')->on('nationalities');
            $table->foreign('blood_types_Mother_id')->references('id')->on('blood_types');
            $table->foreign('religions_Mother_id')->references('id')->on('religions');
        });
    }

    public function down()
    {
        Schema::table('my_parents', function (Blueprint $table) {
            $table->dropForeign(['nationalities_father_id']);
            $table->dropForeign(['blood_types_father_id']);
            $table->dropForeign(['religions_father_id']);
            $table->dropForeign(['nationalities_mother_id']);
            $table->dropForeign(['blood_types_mother_id']);
            $table->dropForeign(['religions_mother_id']);
        });
    }
}