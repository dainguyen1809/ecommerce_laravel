<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('paypal_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->boolean('mode');
            $table->string('country_name');
            $table->string('currency_name');
            $table->string('currency_rate');
            $table->string('client_id');
            $table->string('secret_key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('paypal_settings');
    }
};
