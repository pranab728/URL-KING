<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagesettings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_info')->nullable();
            $table->string('hero_title')->nullable();
            $table->string('hero_text')->nullable();
            $table->string('brand_title')->nullable();
            $table->string('brand_text')->nullable();
            $table->string('pricing_title')->nullable();
            $table->string('pricing_text')->nullable();
            $table->string('contact_info')->nullable();
            $table->string('contact_title')->nullable();
            $table->string('contact_text')->nullable();
            $table->string('stress')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('pagesettings');
    }
}
