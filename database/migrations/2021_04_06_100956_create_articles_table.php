<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->string('title');
            $table->text('description');
            $table->text('content');
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('featured')->default(0);
            $table->date('date');
            $table->timestamps();
        });


        \Illuminate\Support\Facades\DB::statement('ALTER TABLE articles ADD FULLTEXT search(title, description, content)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
