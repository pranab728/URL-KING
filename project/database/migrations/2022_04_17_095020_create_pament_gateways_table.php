<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePamentGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pament_gateways', function (Blueprint $table) {
            $table->id();
            $table->string('subtitle')->nullable();
            $table->string('title')->nullable();
            $table->text('details')->nullable();
            $table->string('name')->nullable();
            $table->tinyInteger('type')->default('0');
            $table->mediumText('information')->nullable();
            $table->string('keyword')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('pament_gateways');
    }
}
