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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string("name",255);
            $table->enum('type', ['Goods', 'Service'])->nullable();
            $table->string("sku_number", 100)->nullable();
            $table->string("unit",50)->nullable();
            $table->string("hsn_code", 100)->nullable();
            $table->string("sac_code", 100)->nullable();
            $table->enum('tax_preference', ['Taxable', 'Non-Taxable', 'Out of Scope', 'Non-GST supply'])->default('Taxable');
            $table->BigInteger("intra_tax_rate_id")->nullable();
            $table->BigInteger("inter_tax_rate_id")->nullable();

            $table->string("currency",10)->nullable();
            $table->double('selling_price', 8, 2);
            $table->string('selling_account', 20)->default('Sales')->nullable();
            $table->double('cost_price', 8, 2);
            $table->string('purchase_account', 20)->default('Purchase')->nullable();
            $table->text("s_desc")->nullable();
            $table->text("p_desc")->nullable();

            $table->boolean('track_inventry')->default(false);
            $table->string("stock_in_hand")->nullable();

            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('img_url', 255)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
