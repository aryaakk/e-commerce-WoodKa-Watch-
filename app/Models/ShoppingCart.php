<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $guard = [];

    protected $table = 'tbl_shopping_cart';

    protected $fillable = [
        'user_id', 'product_id', 'quantity'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id')
            ->join('tbl_shopping_cart', 'tbl_shopping_cart.product_id', 'tbl_products.id')
            ->join('tbl_categories', 'tbl_products.category_id', 'tbl_categories.id')
            ->join('tbl_products_image', 'tbl_products_image.product_id', 'tbl_products.id')
            ->where('tbl_products_image.is_primary', 1);
    }

    // public function category(){
    //     return $this->belongsTo(Category::class, 'category_id', 'id')
    //         ->join('tbl_products', 'tbl_products.category_id', 'tbl_categories.id');
    // }
}
