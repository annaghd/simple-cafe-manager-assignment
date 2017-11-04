<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mockery\Exception;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * provide a many-to-many relationship between User and Role.
     *
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


    /**
     * @param string|array $roles
     *
     * @return mixed
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles);
        }

        return $this->hasRole($roles) || abort(401, 'This action is unauthorized.');
    }

    /**
     * Check multiple roles
     *
     * @param array $roles
     *
     * @return mixed
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Check one role
     *
     * @param string $role
     *
     * @return mixed
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    /**
     * Get users list
     *
     * @return mixed
     */
    public static function getList()
    {
        try {
            $users = self::with(["roles"])->orderBy('id', 'DESC')->paginate(30);
            return $users;
        } catch (Exception $e) {
            //todo
        }
    }

    /**
     * Get user
     *
     * @return mixed
     */
    public static function getOne($id)
    {
        try {
            $user = new User();
            $user->role_id = null;
            if (!empty($id)) {
                if (is_numeric($id)) {
                    $user = User::with("roles")->find($id);
                    $user->password = "";
                    $user->role_id = $user->roles[0]->id;
                }
            }
            return $user;
        } catch (Exception $e) {
            //todo
        }
    }


}
