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
        Schema::create('m_currencies_default', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->string('name', 50)->unique();
            $table->string('code', 50)->unique();
            $table->string('symbol', 5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_currencies_default');
    }
};
