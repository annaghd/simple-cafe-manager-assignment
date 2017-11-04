<?php

namespace App;

use http\Exception;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'description',
    ];

    /**
     * Get products list
     *
     * @return mixed
     */
    public static function getList()
    {
        try {
            $products = self::orderBy('id', 'DESC')->paginate(30);
            return $products;
        } catch (Exception $e) {
            //todo
        }
    }

    /**
     * Get product
     *
     * @return mixed
     */
    public static function getOne($id)
    {
        try {
            $product = new Product();
            if (!empty($id)) {
                if (is_numeric($id)) {
                    $product = Product::find($id);
                }
            }
            return $product;
        } catch (Exception $e) {
            //todo
        }
    }



}
