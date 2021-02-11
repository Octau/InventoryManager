<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            Schema::dropIfExists('purchases');
            $table->id('purchase_id');
            $table->foreignId('supplier_id')->references('supplier_id')->on('suppliers');
            $table->foreignId('product_id')->references('product_id')->on('products');
            $table->boolean('status')->default(true);
            $table->date('purchase_date', $precision=0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
