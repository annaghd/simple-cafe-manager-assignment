<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 11/3/17
 * Time: 1:50 PM
 */

namespace App\Http\Controllers;

use App\Table;
use App\User;
use http\Exception;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * view name
     * @var string
     */
    protected $view = "tables";


    /**
     * model class
     * @var Table
     */
    protected $model_class = Table::class;

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
        'number' => 'string|required',
    ];

}