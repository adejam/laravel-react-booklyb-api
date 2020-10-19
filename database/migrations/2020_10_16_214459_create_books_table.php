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
                $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');
                $table->string('book_title');
                $table->string('book_author');
                $table->string('book_category');
                $table->string('comment')->nullable();
                $table->bigInteger('number_of_pages')->unsigned()->nullable();
                $table->integer('current_page_read')->unsigned()->nullable();
                $table->integer('current_read_percent')->unsigned()->nullable();
                $table->char('current_chapter_title')->nullable();
                $table->integer('current_chapter_read')->unsigned()->nullable();
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
