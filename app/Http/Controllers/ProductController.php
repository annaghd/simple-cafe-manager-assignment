<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 11/3/17
 * Time: 1:51 PM
 */

namespace App\Http\Controllers;

use App\Product;
use http\Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * view name
     * @var string
     */
    protected $view = "products";


    /**
     * model class
     * @var Product
     */
    protected $model_class = Product::class;

    /**
     * user  role
     * @var string
     */
    protected $role = "manager";

    /**
     * user  rule sets
     * @var array
     */
    protected $rulesets = [
        'name'  => 'string|required',
        'price' => 'numeric|required',
    ];


}