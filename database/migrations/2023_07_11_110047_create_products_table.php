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
            $table->unsignedBigInteger("category_id_fk");
            $table->string("product_name");
            $table->float("product_mrp");
            $table->float("product_price");
            $table->integer("product_qty");
            $table->string("product_image");
            $table->string("short_desc",2000);
            $table->text("description");
            $table->text("meta_title");
            $table->string("meta_desc",2000);
            $table->string("meta_keyword",2000);
            $table->tinyInteger("status");
            $table->foreign("category_id_fk")->references("id")->on("categories");
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
