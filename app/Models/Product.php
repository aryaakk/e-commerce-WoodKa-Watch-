<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'tbl_products';

    protected $fillable = [
        'name', 'sku', 'description', 'stock', 'unit', 'weight', 'price', 'category_id', 'is_active'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')
            ->join('tbl_products','tbl_products.category_id' ,'tbl_categories.id');
    }

    public function product_image()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id')
            ->join('tbl_products', 'tbl_products.id', 'tbl_products_image.product_id')
            ->where('is_primary', 1);
    }
    public function product_image_detail()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id')
            ->join('tbl_products', 'tbl_products.id', 'tbl_products_image.product_id');
    }
}
