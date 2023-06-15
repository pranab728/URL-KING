<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('slug');
            $table->integer('days')->nullable();
            $table->double('price')->nullable();
            $table->tinyInteger('free')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->longText('details')->nullable();
            $table->bigInteger('allowed_url')->nullable();
            $table->bigInteger('click_limit')->nullable();
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
        Schema::dropIfExists('subscriptions');
    }
}
