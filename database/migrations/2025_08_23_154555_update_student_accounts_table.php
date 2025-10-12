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
            $table->date('date')->after("student_id");
            $table->string('type')->after("date");
            $table->foreignId('fee_invoice_id')->nullable()->constrained('fee_invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_accounts', function (Blueprint $table) {
            Schema::dropIfExists('student_accounts');
        });
    }
};