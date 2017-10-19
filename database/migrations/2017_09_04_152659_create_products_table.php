<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->nullable()->default(NULL);
            $table->integer('shop_id')->nullable()->default(NULL);
            $table->string('name')->nullable()->default(NULL);
            $table->string('shop')->nullable()->default(NULL);
            $table->string('name_action')->nullable()->default(NULL);
            $table->string('img')->nullable()->default(NULL);
            $table->unsignedTinyInteger('status')->default('1');
            $table->text('description')->nullable()->default(NULL);
            $table->float('price')->nullable()->default(NULL);
            $table->float('price_sale')->nullable()->default(NULL);
            $table->integer('sale')->nullable()->default(NULL);
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
        Schema::dropIfExists('products');
    }
}
