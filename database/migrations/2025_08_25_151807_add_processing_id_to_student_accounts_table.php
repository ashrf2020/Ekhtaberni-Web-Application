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
        Schema::table('student_accounts', function (Blueprint $table) {
                $table->foreignId('processing_id')->nullable()->after('student_id') // تقدر تغير مكان العمود إذا بدك
                    ->constrained('processing_fees')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_accounts', function (Blueprint $table) {
            $table->dropForeign(['processing_id']);
            $table->dropColumn('processing_id');
        });
    }
};