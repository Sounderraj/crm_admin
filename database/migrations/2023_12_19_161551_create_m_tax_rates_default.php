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
        Schema::create('m_tax_rates_default', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger("intra_tax_rate_id");
            $table->unsignedBigInteger("inter_tax_rate_id");
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_tax_rates_default');
    }
};
