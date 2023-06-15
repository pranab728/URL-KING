<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generalsettings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('favicon');
            $table->string('title');
            $table->text('header_email')->nullable();
            $table->text('header_phone')->nullable();
            $table->text('footer');
            $table->text('copyright');
            $table->string('colors')->nullable();
            $table->string('loader')->nullabel();
            $table->string('admin_loader')->nullabel();
            $table->tinyInteger('is_talkto')->default(1);
            $table->text('talkto')->nullable();
            $table->tinyInteger('is_language')->default(1);
            $table->tinyInteger('is_loader')->default(1);
            $table->text('map_key')->nullable();
            $table->tinyInteger('is_disqus')->default(0);
            $table->longText('disqus')->nullable();
            $table->tinyInteger('is_contact')->default(0);
            $table->tinyInteger('currency_format')->default(0);
            $table->string('mail_host')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_pass')->nullable();
            $table->string('from_email')->nullable();
            $table->string('from_name')->nullable();
            $table->tinyInteger('is_smtp')->default(0);
            $table->tinyInteger('is_currency')->default(1);
            $table->tinyInteger('is_affilate')->default(1);
            $table->integer('affilate_charge')->default(0);
            $table->string('affilate_banner')->nullable();
            $table->tinyInteger('is_admin_loader')->default(0);
            $table->tinyInteger('is_verification_email')->default(0);
            $table->tinyInteger('is_capcha')->default(0);
            $table->tinyInteger('is_cookie')->default(0);
            $table->string('error_banner')->nullable();
            $table->tinyInteger('is_popup')->default(0);
            $table->text('popup-background')->nullable();
            $table->integer('popup_time')->default(0);
            $table->string('invoice_logo')->nullable();
            $table->tinyInteger('is_secure')->default(0);
            $table->string('footer_logo')->nullable();
            $table->string('email_encryption')->nullable();
            $table->tinyInteger('is_maintain')->default(0);
            $table->text('maintain_text')->nullable();
            $table->string('breadcumb_banner')->nullable();
            $table->integer('register_id')->default(0);
            $table->integer('preloaded')->default(0);
            $table->string('mail_driver')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->text('deactive_text')->nullable();
            $table->tinyInteger('is_notify_popup')->default(0);
            $table->string('user_image')->nullable();
            $table->integer('tax')->default(0);
            $table->string('captcha_site_key');
            $table->string('captcha_secret_key');
            $table->string('captcha_url');
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
        Schema::dropIfExists('generalsettings');
    }
}
