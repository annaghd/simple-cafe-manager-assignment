<?php

namespace App;

use http\Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status', 'user_id', 'table_id', 'user_table_id'];

    /**
     * Get orders list
     *
     * @return mixed
     */
    public static function getListData()
    {
        $orders = DB::table("orders")
                    ->join('users', 'orders.user_id', '=', 'users.id')
                    ->join('tables', 'orders.table_id', '=', 'tables.id')
                    ->select([
                        DB::raw("users.name as user_name"),
                        DB::raw("tables.number as table_number"),
                        DB::raw("tables.id as table_id"),
                        DB::raw("orders.status as status"),
                        DB::raw("orders.id as id"),
                    ]);


        $id = Auth::user()->id;
        $orders->where("users.id", "=", $id);

        $orders = $orders->paginate(30);

        return $orders;
    }

    /**
     * Get order
     *
     * @return mixed
     */
    public static function getOne($id)
    {
        try {
            $order = new Order();
            if (!empty($id)) {
                if (is_numeric($id)) {
                    $order = Order::find($id);
                }
            }
            return $order;
        } catch (Exception $e) {
            //todo
        }
    }

    public static function getOrderStatuses()
    {
        return [
            "active"   => "Active",
            "canceled" => "Canceled",
            "completed" => "Completed",
        ];
    }

}
