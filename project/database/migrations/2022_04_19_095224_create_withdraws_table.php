<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('method')->nullable();
            $table->string('acc_email')->nullable();
            $table->string('iban')->nullable();
            $table->string('country')->nullable();
            $table->string('acc_name')->nullable();
            $table->text('adress')->nullable();
            $table->string('swift')->nullable();
            $table->text('reference')->nullable();
            $table->double('amount', 8, 2)->nullable();
            $table->double('fee', 8, 2)->default(0.00);
            $table->enum('status',['pending','completed','rejected'])->default('pending');
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
        Schema::dropIfExists('withdraws');
    }
}
