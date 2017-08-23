<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('title')->comment('article title');
            $table->string('subtitle')->nullable()->comment('article sub title');
            $table->text('content')->comment('article content');
            $table->string('slug')->unique()->comment('article slug');
            $table->string('page_image')->comment('article img url');
            $table->string('meta_description')->nullable()->comment('seo  in meta tag key word');
            $table->timestamp('published_at')->comment('article publish time');
            $table->boolean('is_draft')->default(false)->comment('draft or not');
            $table->boolean('is_original')->default(true)->comment('get from somewhere or by myself');
            $table->integer('view_count')->default(0)->comment('view times');
            $table->unsignedInteger('user_id')->comment('who create the article');
            $table->unsignedInteger('last_user_id')->comment('the last one read this article');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('last_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
