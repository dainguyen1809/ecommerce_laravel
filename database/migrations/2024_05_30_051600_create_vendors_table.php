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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('banner');
            $table->string('phone', 20);
            $table->string('email');
            $table->string('address');
            $table->text('description');
            $table->string('fb_link')->nullable();
            $table->string('ins_link')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('vendors');
    }
};
