<?php

namespace App\Http\Controllers;

use http\Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * view namw
     * @var string
     */
    protected $view;


    /**
     * model class
     * @var Model
     */
    protected $model_class;

    /**
     * user  role
     * @var string
     */
    protected $role;

    /**
     * user  rule sets
     * @var array
     */
    protected $rulesets;


    /**
     * function for getting list data
     * @var Request $reqiest
     *
     * @return resource
     */
    public function getList(Request $request)
    {
        $request->user()->authorizeRoles($this->role);
        $model_class = $this->model_class;
        $data = $model_class::getList();
        $roles = [
            "is_manager" => $request->user()->authorizeRoles(['manager']),
            "is_waiter"  => $request->user()->authorizeRoles(['waiter']),
        ];

        return view($this->view . '.index', compact('data', 'roles'))
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
        $request->user()->authorizeRoles($this->role);
        $model_class = $this->model_class;
        $data = $model_class::getOne($id);

        $roles = [
            "is_manager" => $request->user()->authorizeRoles(['manager']),
            "is_waiter"  => $request->user()->authorizeRoles(['waiter']),
        ];

        return view($this->view . '.create', compact('data', 'roles'));
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
        $request->user()->authorizeRoles($this->role);
        $this->validate($request, $this->rulesets);
        $input = $request->all();
        $model_class = $this->model_class;
        try {
            if (!empty($id)) {
                $model_class::find($id)->update($input);
            } else {
                $model_class::create($input);
            }
        } catch (Exception $exception) {
            return redirect()->route($this->view . '.index')
                             ->with('error', "Creation failed");
        }

        return redirect()->route($this->view . '.index')
                         ->with('success', "Successfully created");
    }
}
