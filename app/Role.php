<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * provide a many-to-many relationship between User and Role.
     *
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get roles
     *
     * @return array
     */
    public static function getRolesList()
    {
        $roles_list = self::pluck('name', 'id')->toArray();

        return ["0" => "-Select-"] + $roles_list;
    }
}
