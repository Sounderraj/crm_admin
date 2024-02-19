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
        Schema::create('salesorders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->string("sale_order_id", 150);
            $table->string("reference_num", 150)->nullable();

            $table->date('saleorder_date');
            $table->date('expected_shipment_date')->nullable();

            $table->string("place_of_supply", 20)->nullable();
            
            $table->string("payment_terms", 100)->nullable();

            $table->unsignedBigInteger('delivery_method_id')->nullable();
            $table->foreign('delivery_method_id')->references('id')->on('m_so_delivery_methods');

            $table->string("customer_code", 150)->nullable();
            $table->string("customer_purchase_order_num", 150)->nullable();
            $table->date('customer_purchase_order_date')->nullable();
            $table->string("vendor_code", 150)->nullable();
            
            $table->string("order_status", 50)->nullable();
            
            $table->double('total_amount', 10, 2);

            $table->text("customer_notes")->nullable();
            $table->text("terms_and_conditions")->nullable();

            $table->string('attachment_url', 255)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salesorders');
    }
};
