<?php

namespace App;

use http\Exception;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['number', 'user_id'];
    /**
     * Get tables list
     *
     * @return mixed
     */
    public static function getList()
    {
        try {
            $tables = self::orderBy('id', 'DESC')->paginate(30);
            return $tables;
        } catch (Exception $e) {
            //todo
        }
    }

    /**
     * Get table
     *
     * @return mixed
     */
    public static function getOne($id)
    {
        try {
            $table = new Table();
            if (!empty($id)) {
                if (is_numeric($id)) {
                    $table = Table::find($id);
                }
            }
            return $table;
        } catch (Exception $e) {
            //todo
        }
    }

}
