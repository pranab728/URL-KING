<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('subscription_id');
            $table->string('title');
            $table->double('price');
            $table->integer('days');
            $table->bigInteger('allowed_url');
            $table->bigInteger('click_limit');
            $table->string('method');
            $table->string('txnid');
            $table->string('charge_id')->nullable();
            $table->text('payment_number')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('user_subscriptions');
    }
}
