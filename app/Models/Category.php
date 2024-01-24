<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = ['cat_name','status','month_of_the_category'];

    public function products(){
        return $this->hasMany(Product::class,"category_id_fk","id");
    }
}
