<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('author_id');
            
            $table->string('title');
            $table->text('description');
            $table->string('state');
            $table->float('price', 10, 2);
            $table->boolean('on_sale');
            $table->float('offer', 10, 2);
            $table->string('color');

            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('authors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
