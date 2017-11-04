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
    protected $rulesets = [
        'number' => 'string|required',
    ];

    public function getList(Request $request)
    {
        $request->user()->authorizeRoles('manager');
        $tables = Table::getList();
        $roles = [
            "is_manager" => $request->user()->authorizeRoles(['manager']),
            "is_waiter"  => $request->user()->authorizeRoles(['waiter']),
        ];

        return view('tables.index', compact('tables', 'roles'))
            ->with('i', ($request->input('page', 1) - 1) * 30);
    }

    public function getOne(Request $request, $id = null)
    {
        $request->user()->authorizeRoles('manager');
        $table = Table::getOne($id);
        $roles = [
            "is_manager" => $request->user()->authorizeRoles(['manager']),
            "is_waiter"  => $request->user()->authorizeRoles(['waiter']),
        ];
        return view('tables.create', compact('table', 'roles'));
    }

    public function store(Request $request, $id = null)
    {
        $request->user()->authorizeRoles('manager');
        $this->validate($request, $this->rulesets);
        $input = $request->only(["number"]);

        try {
            if (!empty($id)) {
                $table = Table::find($id)->update($input);
            } else {
                $table = Table::create($input);
            }
        } catch (Exception $exception) {
            return redirect()->route('tables.index')
                             ->with('success', "Table creation failed");
        }

        return redirect()->route('tables.index')
                         ->with('success', "Table created");
    }
}