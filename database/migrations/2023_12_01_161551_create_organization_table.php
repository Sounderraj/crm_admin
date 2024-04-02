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
        Schema::create('organization', function (Blueprint $table) {

            $table->id();

            $table->string("org_name", 255);
            $table->string("industry", 255)->nullable();
            
            $table->string("org_country", 50)->nullable();
            $table->string("org_street1", 255)->nullable();
            $table->string("org_street2", 255)->nullable();
            $table->string("org_city", 100)->nullable();
            $table->string("org_state", 100)->nullable();
            $table->string("org_zip_code", 20)->nullable();
            $table->string("org_phone", 20)->nullable();
            $table->string("org_fax", 20)->nullable();
            $table->string("org_website_url", 255)->nullable();

            $table->string("fiscal_year", 255)->nullable();

            $table->string("language",10)->nullable();
            $table->string("time_zone", 50)->nullable();

            $table->string("TAN", 100)->nullable();

            $table->enum('gst_registered', ['0', '1'])->default('0');
            $table->string("GSTIN", 10)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization');
    }
};
