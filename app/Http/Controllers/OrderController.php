<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 11/3/17
 * Time: 1:51 PM
 */

namespace App\Http\Controllers;


use App\Order;
use App\Product;
use App\ProductOrder;
use App\UserTable;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * view name
     * @var string
     */
    protected $view = "orders";


    /**
     * model class
     * @var Order
     */
    protected $model_class = Order::class;

    /**
     * user  role
     * @var string
     */
    protected $role = "waiter";

    /**
     * function for getting row data
     * @var Request $reqiest
     * @var mixed $id
     *
     * @return resource
     */
    public function getOne(Request $request, $id = null)
    {
        $input = $request->all();
        $table_id = isset($input["table_id"]) ? $input["table_id"] : 0;
        $user_table_id = isset($input["user_table_id"]) ? $input["user_table_id"] : 0;
        $order = Order::getOne($id);

        $statuses = Order::getOrderStatuses();
        $products = Product::pluck("name", "id")->toArray();

        $order_products = ProductOrder::getOrderProducts($id);

        $roles = [
            "is_manager" => $request->user()->authorizeRoles(['manager']),
            "is_waiter"  => $request->user()->authorizeRoles(['waiter']),
        ];

        return view('orders.create', compact('order', 'products', 'statuses', 'roles', 'table_id', 'order_products', 'user_table_id'));
    }
    /**
     * function for storing  data
     * @var Request $reqiest
     * @var mixed $id
     *
     * @return resource
     */
    public function store(Request $request, $id = null)
    {
        $input = $request->all();
        try {
            DB::transaction(function () use ($input, $id) {
                $product_id = isset($input["product_id"]) ? $input["product_id"] : [];
                $status = 'open';
                if (!empty($id)) {
                    DB::table('product_order')->where('order_id', '=', $id)->delete();
                    $order = Order::find($id);
                    $order->status = $input["status"];
                    $order->save();

                    if ($input["status"] != 'active') {
                        $status = "completed";
                    }
                    $user_table_id = $order->user_table_id;
                } else {
                    $order = Order::create([
                        "status"        => $input["status"],
                        "user_id"       => Auth::user()->id,
                        "table_id"      => $input["table_id"],
                        "user_table_id" => $input["user_table_id"],
                    ]);
                    $id = $order->id;
                    $user_table_id = $input["user_table_id"];
                }

                UserTable::find($user_table_id)->update([
                    "status" => $status
                ]);
                foreach ($product_id as $product) {
                    $quantity = $input["quantity" . $product];
                    $order_product_data = [
                        "product_id" => $product,
                        "quantity"   => $quantity,
                        "order_id"   => $id,
                        "status"     => $status,
                    ];
                    ProductOrder::create($order_product_data);
                }
            });

        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->route('orders.index')
                             ->with('success', "Order creation error");
        }

        return redirect()->route('orders.index')
                         ->with('success', "Order created");
    }

}