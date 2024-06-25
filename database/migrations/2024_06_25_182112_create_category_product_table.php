<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->foreignUuid('category_id')->constrained();
            $table->foreignUuid('product_id')->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_product');
    }
};
