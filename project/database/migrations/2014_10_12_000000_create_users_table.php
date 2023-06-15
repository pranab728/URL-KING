<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('username')->nullable()->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('photo')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('ban')->default(0);
            $table->string('api')->nullable();
            $table->tinyInteger('public')->default(0);
            $table->string('domain')->nullable();
            $table->tinyInteger('media')->default(0);
            $table->integer('planid')->default(0);
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
