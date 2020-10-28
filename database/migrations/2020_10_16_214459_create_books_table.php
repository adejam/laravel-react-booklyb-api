<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'books',
            function (Blueprint $table) {
                $table->id();
                $table->char('bookId');
                $table->bigInteger('userId')->unsigned();
                $table->foreign('userId')->references('id')->on('users');
                $table->string('bookTitle');
                $table->string('bookAuthor')->nullable();
                $table->string('bookCategory');
                $table->string('comment')->nullable();
                $table->bigInteger('numberOfPages')->unsigned()->nullable();
                $table->integer('currentPageRead')->unsigned()->nullable();
                $table->integer('currentReadPercent')->unsigned()->nullable();
                $table->string('currentChapterTitle')->nullable();
                $table->integer('currentChapterRead')->unsigned()->nullable();
                $table->timestamps();
            }
        );
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
