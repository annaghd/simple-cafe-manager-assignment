<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    /**
     * table name
     *
     * @var string
     */
    protected $table = "product_order";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status', 'order_id', 'product_id', 'quantity'];

    public static function getOrderProducts($order_id)
    {
        $order_products = self::where("order_id", "=", $order_id )->where("status", "=", "open")->get();
        // create
        $data = [];
        foreach($order_products as $order_product){
            $data[$order_product->product_id] = $order_product->quantity;
        }
        return $data;
    }

}
