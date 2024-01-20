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
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();
            $table->date("quote_date");
            $table->date("expiry_date")->nullable();

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            
            $table->string("estimate_number", 255)->nullable();
            $table->string("reference_number", 255)->nullable();
            $table->string("subject_name")->nullable();
            $table->double('rate', 8, 2);
            $table->enum('status', ['DRAFT', 'SENT', 'PENDING APPROVAL', 'ACCEPTED', 'INVOICED', 'DECLINED']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimates');
    }
};
