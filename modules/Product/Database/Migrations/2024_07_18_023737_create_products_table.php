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
            $table->string('name');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('sale_price');
            $table->string('short_desc')->default('');
            $table->text('description')->nullable();
            $table->unsignedInteger('total_review')->default(0);
            $table->unsignedInteger('total_star')->default(0);
            $table->float('rating')->default(5);
            $table->unsignedInteger('sold')->default(0);
            $table->string('slug');
            $table->text('thumbnail')->nullable();
            $table->unsignedSmallInteger('category_id');
            $table->unsignedInteger('shop_id');
            $table->unsignedBigInteger('user_created');
            $table->unsignedBigInteger('user_updated');
            $table->timestamps();
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
