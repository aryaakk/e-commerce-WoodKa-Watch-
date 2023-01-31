<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('sku', 20);
            $table->text('description');
            $table->integer('stock');
            $table->string('unit', 20);
            $table->decimal('weight', 10, 2);
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->boolean('is_active')->default(1);

            $table->foreign('category_id')->references('id')->on('tbl_categories');
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
        Schema::dropIfExists('tbl_products');
    }
};
