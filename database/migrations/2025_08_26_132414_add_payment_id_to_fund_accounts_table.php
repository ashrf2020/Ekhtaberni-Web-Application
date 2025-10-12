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
        Schema::table('fund_accounts', function (Blueprint $table) {
            $table->foreignId('payment_id')
                ->nullable()
                ->after('receipt_id') // حطّه بعد العمود المناسب عندك
                ->constrained('payment_students')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fund_accounts', function (Blueprint $table) {
            //
        });
    }
};