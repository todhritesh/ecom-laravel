<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'pro_title',
'category_id',
'user_margin',
'retail_margin',
'pro_image',
'pro_qty',
'pro_description',
'pro_price',
    ];
    function category(){
        return $this->HasOne(Category::class,"id","category_id");
    }
}
