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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('thumb_image');
            $table->integer('vendor_id');
            $table->integer('category_id');
            $table->integer('sub_category_id')->default(0);
            $table->integer('child_category_id')->default(0);
            $table->integer('brand_id');
            $table->string('quantity');
            $table->text('short_description');
            $table->text('long_description');
            $table->text('video_link')->nullable();
            $table->string('sku')->nullable();
            $table->double('price');
            $table->double('offer_price')->nullable();
            $table->date('offer_start_date')->format('Y-m-d')->nullable();
            $table->date('offer_end_date')->format('Y-m-d')->nullable();
            $table->string('product_type')->nullable();
            $table->boolean('status');
            $table->integer('is_approved')->default(0);
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('products');
    }
};
