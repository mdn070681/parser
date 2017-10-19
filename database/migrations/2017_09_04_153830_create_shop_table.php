<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id')->nullable()->default(NULL);
            $table->integer('category_id')->nullable()->default(NULL);
            $table->integer('location_id')->nullable()->default(NULL);
            $table->string('name')->nullable()->default(NULL);
            $table->string('method')->nullable()->default(NULL);
            $table->string('img')->nullable()->default(NULL);
            $table->unsignedTinyInteger('status')->default('1');
            $table->text('description')->nullable()->default(NULL);;
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
        Schema::dropIfExists('shop');
    }
}
