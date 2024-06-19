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
        Schema::table('product_variant_items', function (Blueprint $table) {
            $table->dropUnique('product_variant_items_name_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        //
    }
};
