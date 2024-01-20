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
            $table->string("name",255);
            $table->string("title",255)->nullable();
            $table->string("company_name", 255)->nullable();
            $table->string("phone", 255)->nullable();
            $table->string("location",255)->nullable();
            $table->string("leads_owner", 255)->nullable();
            $table->string("leads_status",100);
            $table->string("leads_score",20)->nullable();
            $table->timestamps();
            $table->softDeletes();
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
