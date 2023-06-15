<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminpanelLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminpanel_languages', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('is_default')->default(0);
            $table->string('language');
            $table->string('file');
            $table->string('name');
            $table->tinyInteger('rtl')->default(0);
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
        Schema::dropIfExists('adminpanel_languages');
    }
}
