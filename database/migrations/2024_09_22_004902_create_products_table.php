<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->text('image');
            $table->text('image_list');
            $table->text('short_description')->nullable(); //
            $table->text('description');
            $table->text('details')->nullable();
            $table->integer('old_price')->default(0);
            $table->integer('price')->default(0);
            $table->integer('min_price')->default(0); //
            $table->integer('max_price')->default(0); //
            $table->integer('has_variation')->default(0); //
            $table->integer('stock_qty')->default(1);
            $table->bigInteger('brand_id');
            $table->bigInteger('category_id');
            $table->integer('status')->default(1);
            $table->integer('featured')->default(0);
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->integer('views')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
