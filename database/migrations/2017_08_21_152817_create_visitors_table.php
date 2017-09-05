<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned()->comment('viewed article id');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->string('ip', 32)->comment('ip address');
            $table->string('country')->nullable()->comment('area');
            $table->integer('clicks')->unsigned()->default(1)->comment('clicksss');
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
        Schema::dropIfExists('visitors');
    }
}
