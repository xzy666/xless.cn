<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('user name');
            $table->string('email')->unique()->comment('user email');
            $table->string('password')->comment('user password');
            $table->string('avatar')->nullable()->comment('user avatar');
            $table->string('confirm_code',64)->unique()->nullable()->comment('email confirm code');
            $table->boolean('is_active')->default(false)->comment('email is confirm or not 0 is no & 1 is yes');
            $table->boolean('is_admin')->default(false)->comment('sysytem administrator');
            $table->smallInteger('status')->default(1)->comment('user status in system 0 is close & 1 is open ');
            $table->string('github_id')->default('')->nullable()->comment('github id');
            $table->string('github_name')->default('')->nullable()->comment('github name');
            $table->string('weibo_name')->default('')->nullable()->comment('weibo name');
            $table->string('weibo_link')->default('')->nullable()->comment('weibo link');
            $table->string('website')->default('')->nullable()->comment('user personale website');
            $table->text('description')->default('')->nullable()->comment('personale description');
            $table->string('signature')->default('')->nullable()->comment('special signature');
            $table->integer('activeness')->default(0)->nullable()->comment('activeness in community');
            $table->integer('experience')->default(0)->nullable()->comment('experience in community');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
