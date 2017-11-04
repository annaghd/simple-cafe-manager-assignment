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
    protected $rulesets = [
        'name'  => 'string|required',
        'price' => 'numeric|required',
    ];

    public function getList(Request $request)
    {
        $request->user()->authorizeRoles('manager');
        $products = Product::getList();
        $roles = [
            "is_manager" => $request->user()->authorizeRoles(['manager']),
            "is_waiter"  => $request->user()->authorizeRoles(['waiter']),
        ];

        return view('products.index', compact('products', 'roles'))
            ->with('i', ($request->input('page', 1) - 1) * 30);
    }

    public function getOne($id = null, Request $request)
    {
        $request->user()->authorizeRoles('manager');
        $product = Product::getOne($id);
        $roles = [
            "is_manager" => $request->user()->authorizeRoles(['manager']),
            "is_waiter"  => $request->user()->authorizeRoles(['waiter']),
        ];

        return view('products.create', compact('product', 'roles'));
    }

    public function store(Request $request, $id = null)
    {
        $request->user()->authorizeRoles('manager');
        $this->validate($request, $this->rulesets);
        $input = $request->only(["name", "price", "description"]);

        try {
            if (!empty($id)) {
                $product = Product::find($id)->update($input);
            } else {
                $product = Product::create($input);
            }
        } catch (Exception $exception) {
            return redirect()->route('products.index')
                             ->with('success', "Product creation failed");
        }

        return redirect()->route('products.index')
                         ->with('success', "Product created");
    }
}