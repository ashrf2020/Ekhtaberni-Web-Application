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
        // Change string columns to JSON for translatable fields
        Schema::table('my_parents', function (Blueprint $table) {
            // Father's translatable fields
            $table->json('Name_Father')->change();
            $table->json('Jop_Father')->change();
            
            // Mother's translatable fields
            $table->json('Name_Mother')->change();
            $table->json('Jop_Mother')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to string columns
        Schema::table('my_parents', function (Blueprint $table) {
            // Revert father's fields
            $table->string('Name_Father')->change();
            $table->string('Jop_Father')->change();
            
            // Revert mother's fields
            $table->string('Name_Mother')->change();
            $table->string('Jop_Mother')->change();
        });
    }
};
