<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_page')->nullable();
            $table->string('title')->nullable();
            $table->string('h1')->nullable();
            $table->text('content1')->nullable()->default(NULL);
            $table->text('content2')->nullable()->default(NULL);
            $table->text('content3')->nullable()->default(NULL);
            $table->text('content4')->nullable()->default(NULL);
            $table->text('content5')->nullable()->default(NULL);
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
        Schema::dropIfExists('pages');
    }
}
