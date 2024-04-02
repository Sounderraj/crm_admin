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
        Schema::create('m_tax_rates', function (Blueprint $table) {
            
            $table->id();
            $table->string("tax_name", 50);
            $table->string("tax_type", 50)->nullable();
            $table->double('tax_rate_percentage', 5, 2)->nullable();
            $table->string("tax_ids", 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_tax_rates');
    }
};
