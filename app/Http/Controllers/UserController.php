<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 11/3/17
 * Time: 1:51 PM
 */

namespace App\Http\Controllers;

use App\Role;
use App\User;
use http\Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * view name
     * @var string
     */
    protected $view = "users";


    /**
     * model class
     * @var User
     */
    protected $model_class = User::class;

    /**
     * user  role
     * @var string
     */
    protected $role = "manager";

    /**
     * function for getting row data
     * @var Request $reqiest
     * @var mixed $id
     *
     * @return resource
     */
    public function getOne(Request $request, $id = null)
    {
        $request->user()->authorizeRoles('manager');
        $user = User::getOne($id);

        $roles_list = Role::getRolesList();
        $roles = [
            "is_manager" => $request->user()->authorizeRoles(['manager']),
            "is_waiter"  => $request->user()->authorizeRoles(['waiter']),
        ];

        return view('users.create', compact('user', 'roles', 'roles_list'));
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
        $request->user()->authorizeRoles('manager');
        $input_user_data = $request->only(["name", "email"]);
        $password = $request->get("password");

        if (!empty($password)) {
            $input_user_data["password"] = bcrypt($password);
        }

        $input_role = $request->only(["role_id"]);
        $role = Role::where('id', '=', $input_role)->first();
        try {
            if (!empty($id)) {
                $this->validate($request, [
                    'name'  => 'string|required',
                    'email' => 'string|required',
                ]);

                $user = User::find($id)->update($input_user_data);
            } else {
                $this->validate($request, [
                    'name'     => 'string|required',
                    'email'    => 'string|required',
                    'password' => 'string|required',
                ]);
                $user = User::create($input_user_data);
                $user->roles()->attach($role);
            }
        } catch (Exception $exception) {
            return redirect()->route('users.create')
                             ->with('success', "User creation failed");
        }

        return redirect()->route('users.index')
                         ->with('success', "User created");

    }
}