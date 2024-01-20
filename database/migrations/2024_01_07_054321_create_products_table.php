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
            $table->string("name",100);
            $table->string("sku_number", 100)->nullable();
            $table->double('rate', 8, 2);
            $table->string("description")->nullable();
            $table->BigInteger("quantity")->nullable();
            $table->string("unit",'50')->nullable();
            $table->tinyInteger("is_taxable")->nullable();
            $table->integer("gst_percentage")->nullable();
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
