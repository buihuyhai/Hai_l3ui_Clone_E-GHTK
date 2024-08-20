<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media_files', function (Blueprint $table) {
            $table->id();
            $table->string("file_name")->nullable();
            $table->string("file_path")->nullable();
            $table->float("file_size")->nullable();
            $table->string("file_type")->nullable();
            $table->string("file_extension")->nullable();
            $table->string("url")->nullable();
            $table->bigInteger("user_create")->nullable();
            $table->bigInteger("user_update")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_files');
    }
};
