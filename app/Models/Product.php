<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "product_name",
        "category_id_fk",
        "product_price",
        "product_mrp",
        "product_qty",
        "product_image",
        "short_desc",
        "description",
        "meta_title",
        "meta_desc",
        "meta_keyword",
        "status",

    ];

    public function categories(){
        return $this->belongsTo(Category::class,"category_id_fk","id");
    }
}
