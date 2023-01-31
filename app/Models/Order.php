<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Order extends Model
{
    use HasFactory;

    protected $table = "tbl_order";
    protected $guard = [];

    protected $fillable = [
        'user_id', 'total_price', 'token', 'processed', 'transaction_status', 'payment_type', 'payment_url', 'transaction_time', 'settlement_time', 'delivery_status', 'delivery_addres'
    ];


    public function detail_order()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id')
            ->join('tbl_order', 'tbl_order.id', 'tbl_order_detail.order_id')
            ->join('tbl_products', 'tbl_products.id', 'tbl_order_detail.product_id')
            ->join('tbl_products_image', 'tbl_products_image.product_id', 'tbl_products.id')
            ->where('tbl_products_image.is_primary', 1);
    }
    public function detail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id')
            ->join('tbl_order', 'tbl_order.id', 'tbl_order_detail.order_id')
            ->join('tbl_products', 'tbl_products.id', 'tbl_order_detail.product_id');
    }


    // public function product_image()
    // {
    //     return $this->hasMany(OrderDetail::class, 'product_id', 'id')
    //         ->join('tbl_products', 'tbl_products.id', 'tbl_order_detail.product_id')
    //         ->join('tbl_products_image', 'tbl_products_image.product_id', 'tbl_products.id')
    //         ->where('tbl_products_image.is_primary', 1);
    // }
}
