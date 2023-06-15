<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
             $table->bigInteger('user_id')->nullable();
             $table->string('alias')->nullable();
             $table->string('custom')->nullable();
             $table->string('url')->nullable();
             $table->string('location')->nullable();
             $table->string('devices')->nullable();
             $table->string('domain')->nullable();
             $table->text('description')->nullable();
             $table->bigInteger('click')->default(0);
             $table->string('meta_title')->nullable();
             $table->longText('meta_description')->nullable();
             $table->tinyInteger('status')->default(0);
             $table->bigInteger('expire_day')->nullable();
             $table->bigInteger('planid')->nullable();
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
        Schema::dropIfExists('links');
    }
}
