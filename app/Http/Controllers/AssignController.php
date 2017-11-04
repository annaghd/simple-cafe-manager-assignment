<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 11/3/17
 * Time: 1:51 PM
 */

namespace App\Http\Controllers;

use App\Table;
use App\User;
use App\UserTable;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignController extends Controller
{
    /**
     * view name
     * @var string
     */
    protected $view = "assign";

    /**
     * model class
     * @var UserTable
     */
    protected $model_class = UserTable::class;


    /**
     * function for getting list data
     * @var Request $reqiest
     *
     * @return resource
     */
    public function getList(Request $request)
    {
        $assignments = UserTable::getListData($request->user()->authorizeRoles(['waiter']));
        $roles = [
            "is_manager" => $request->user()->authorizeRoles(['manager']),
            "is_waiter"  => $request->user()->authorizeRoles(['waiter']),
        ];

        return view('assign.index', compact('assignments', 'roles'))
            ->with('i', ($request->input('page', 1) - 1) * 30);
    }

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
        $assignment = new UserTable();
        if (!empty($id)) {
            if (is_numeric($id)) {
                $assignment = UserTable::find($id);
            }
        }
        $roles = [
            "is_manager" => $request->user()->authorizeRoles(['manager']),
            "is_waiter"  => $request->user()->authorizeRoles(['waiter']),
        ];

        // get free users
        $users = UserTable::getUsersList();
        // get free tables
        $tables = UserTable::getTablesList();
        $statuses = UserTable::getStatusList();

        return view('assign.create', compact('assignment', 'roles', 'users', 'tables', 'statuses'));
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
        $input = $request->only(["user_id", "table_id", "status"]);
        try {
            if (!empty($id)) {
                $this->validate($request, [
                    'user_id'  => 'int|required',
                    'status'   => 'string|required',
                ]);
                $user = UserTable::find($id)->update($input);
            } else {
                $this->validate($request, [
                    'user_id'  => 'int|required',
                    'table_id' => 'int|required',
                    'status'   => 'string|required',
                ]);
                $user = UserTable::create($input);
            }
        } catch (Exception $exception) {
            return redirect()->route('assign.create')
                             ->with('success', "User assignment failed");
        }

        return redirect()->route('assign.index')
                         ->with('success', "Success user assignment");

    }
}