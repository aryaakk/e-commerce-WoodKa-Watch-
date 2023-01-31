<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'tbl_products_image';

    protected $fillable = [
        'product_id', 'image', 'is_primary'
    ];

    public function product()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id')
            ->join('tbl_products', 'tbl_products_image.product_id', 'tbl_products.id');
    }
}
