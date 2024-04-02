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
        Schema::create('vendors', function (Blueprint $table) {
            
            $table->id();
            $table->string("salutation", 10)->nullable();
            $table->string("first_name", 50)->nullable();
            $table->string("last_name", 50)->nullable();
            $table->string("email",50)->unique();
            $table->string("mobile",20);
            $table->string("company_name", 255);
            $table->string("vendor_name", 255)->nullable();
            $table->string("work_phone", 20)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->string("gst_treatment", 10)->nullable();
            $table->unsignedBigInteger('gst_treatment_id')->nullable();
            // $table->foreign('gst_treatment_id')->references('id')->on('m_gst_treatment');
            $table->string("gstin", 50)->nullable();
            $table->string("business_legal_name", 50)->nullable();

            $table->string("pan", 20)->nullable();
            $table->string("place_of_supply", 50)->nullable();
            $table->enum('tax_preference', ['Taxable', 'Tax Exempt'])->nullable();
            $table->string("currency", 3)->nullable();
            $table->decimal("opening_balance", 15, 2)->default(0)->nullable();
            $table->string("payment_terms")->nullable();
            $table->text("remarks")->nullable();
            
            // $table->string("billing_attention")->nullable();
            $table->string("billing_country")->nullable();
            $table->string("billing_street")->nullable();
            $table->string("billing_city")->nullable();
            $table->string("billing_state")->nullable();
            $table->string("billing_zip_code")->nullable();
            $table->string("billing_phone")->nullable();
            $table->string("billing_fax")->nullable();

            // $table->string("shipping_attention")->nullable();
            $table->string("shipping_country")->nullable();
            $table->string("shipping_street")->nullable();
            $table->string("shipping_city")->nullable();
            $table->string("shipping_state")->nullable();
            $table->string("shipping_zip_code")->nullable();
            $table->string("shipping_phone")->nullable();
            $table->string("shipping_fax")->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
