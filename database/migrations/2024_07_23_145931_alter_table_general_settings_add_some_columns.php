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
        if (! Schema::hasColumn('general_settings', 'contact_phone')) {
            Schema::table('general_settings', function (Blueprint $table) {
                $table->string('contact_phone')->nullable()->after('contact_email');
            });

            Schema::table('general_settings', function (Blueprint $table) {
                $table->string('contact_address')->nullable()->after('contact_phone');
            });

            Schema::table('general_settings', function (Blueprint $table) {
                $table->text('map')->nullable()->after('contact_address');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        if (Schema::hasColumn('general_settings', 'contact_phone')) {
            Schema::table('general_settings', function (Blueprint $table) {
                $table->dropColumn('contact_phone');
            });
        }
        if (Schema::hasColumn('general_settings', 'contact_phone')) {
            Schema::table('general_settings', function (Blueprint $table) {
                $table->string('contact_address')->nullable()->after('contact_phone');
            });
        }
        if (Schema::hasColumn('general_settings', 'contact_phone')) {
            Schema::table('general_settings', function (Blueprint $table) {
                $table->string('map')->nullable()->after('contact_address');
            });
        }
    }
};
