<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserTable extends Model
{
    /**
     * The model table.
     *
     * @var string
     */
    protected $table = "user_table";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'table_id', 'status',
    ];

    /**
     * Get user tables list
     * @parsm bool $is_waiter
     *
     * @return mixed
     */
    public static function getListData($is_waiter)
    {
        $assignments = DB::table("user_table")
                         ->join('users', 'user_table.user_id', '=', 'users.id')
                         ->join('tables', 'user_table.table_id', '=', 'tables.id')
                         ->select([
                             DB::raw("users.name as user_name"),
                             DB::raw("tables.number as table_number"),
                             DB::raw("tables.id as table_id"),
                             DB::raw("user_table.status as status"),
                             DB::raw("user_table.id as id"),
                         ]);

        if ($is_waiter) {
            $id = Auth::user()->id;
            $assignments->where("users.id", "=", $id);
            $assignments->where("user_table.status", "=", "pending");
        }

        $assignments = $assignments->paginate(30);

        return $assignments;
    }

    /**
     * Get free users
     *
     * @return array
     */
    public static function getUsersList()
    {
        // get free users
        $users = DB::table('users')
                        ->select('users.name', 'users.id')
                        ->leftJoin("role_user", "role_user.user_id", "=", "users.id")
                        ->leftJoin("roles", "roles.id", "=", "role_user.role_id")
                        ->where("roles.name", "=", "waiter")
                        ->pluck('name', 'id')->toArray();


        return $users;
    }

    /**
     * Get free tables
     *
     * @return array
     */
    public static function getTablesList()
    {
        // get tables
        $tables = DB::table('tables')
                         ->select('tables.number', 'tables.id')
                         ->leftJoin(DB::raw('(SELECT id, table_id FROM user_table WHERE user_table.status="open" OR user_table.status="pending") user_table'), function ($join) {
                             $join->on('tables.id', '=', 'user_table.table_id');
                         })
                         ->whereNull("user_table.id")
                         ->pluck('number', 'id')->toArray();;


        return $tables;
    }

    /**
     * Get statuses
     *
     * @return array
     */
    public static function getStatusList()
    {
        return [
            "pending"  => "Pending",
            //"active"   => "Active",
            "canceled" => "Canceled",
            "completed" => "Completed",
        ];
    }

}
