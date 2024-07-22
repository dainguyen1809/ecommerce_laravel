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
        Schema::table('vendors', function (Blueprint $table) {
            if (Schema::hasColumn('vendors', 'vendors')) {
                $table->boolean('vendors')->after('user_id')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::table('vendors', function (Blueprint $table) {
            //
        });
    }
};
