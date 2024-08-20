<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name');
            $table->string('thumbnail');
            $table->string('slug');
            $table->text('description');
            $table->timestamps();
        });

        $storageLink = 'category/';

        DB::table('categories')->insert([
            [
                'name' => 'Thời trang',
                'thumbnail' => "{$storageLink}thoi-trang.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'thoi-trang',
            ],
            [
                'name' => 'Điện tử',
                'thumbnail' => "{$storageLink}dien-tu.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'dien-tu',
            ],
            [
                'name' => 'Điện thoại',
                'thumbnail' => "{$storageLink}dien-thoai.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'dien-thoai',
            ],
            [
                'name' => 'Đồ chơi',
                'thumbnail' => "{$storageLink}do-choi.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'do-choi',
            ],
            [
                'name' => 'Đồng hồ',
                'thumbnail' => "{$storageLink}dong-ho.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'dong-ho',
            ],
            [
                'name' => 'Gia dụng',
                'thumbnail' => "{$storageLink}gia-dung.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'gia-dung',
            ],
            [
                'name' => 'Giặt dũ',
                'thumbnail' => "{$storageLink}giat-du.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'giat-du',
            ],
            [
                'name' => 'Giày dép nam',
                'thumbnail' => "{$storageLink}giay-dep-nam.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'giay-dep-nam',
            ],
            [
                'name' => 'Làm đẹp',
                'thumbnail' => "{$storageLink}lam-dep.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'lam-dep',
            ],
            [
                'name' => 'Laptop',
                'thumbnail' => "{$storageLink}laptop.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'laptop',
            ],
            [
                'name' => 'Máy ảnh',
                'thumbnail' => "{$storageLink}may-anh.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'may-anh',
            ],
            [
                'name' => 'Mô hình',
                'thumbnail' => "{$storageLink}mo-hinh.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'mo-hinh',
            ],
            [
                'name' => 'Nước hoa',
                'thumbnail' => "{$storageLink}nuoc-hoa.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'nuoc-hoa',
            ],
            [
                'name' => 'Phụ kiện',
                'thumbnail' => "{$storageLink}phu-kien.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'phu-kien',
            ],
            [
                'name' => 'Sách',
                'thumbnail' => "{$storageLink}sach.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'sach',
            ],
            [
                'name' => 'Sức khoẻ',
                'thumbnail' => "{$storageLink}suc-khoe.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'suc-khoe',
            ],
            [
                'name' => 'Thể thao',
                'thumbnail' => "{$storageLink}the-thao.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'the-thao',
            ],
            [
                'name' => 'Trang sức',
                'thumbnail' => "{$storageLink}trang-suc.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'trang-suc',
            ],
            [
                'name' => 'Ví & Balo',
                'thumbnail' => "{$storageLink}vi-balo.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'vi-balo',
            ],
            [
                'name' => 'Xe máy',
                'thumbnail' => "{$storageLink}xe-may.png",
                'description' => 'Danh mục sản phẩm',
                'slug' => 'xe-may',
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
