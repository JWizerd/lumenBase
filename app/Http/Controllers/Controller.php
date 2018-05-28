<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public $modelClass;

    public function index()
    {
        return response()->json($this->modelClass::all());
    }

    /**
     * Shows a single model.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json($this->modelClass::find($id));
    }

    /**
     * Creates and returns an Model.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $model = $this->modelClass::create($request->all());
        return response()->json($model, 201);
    }

    /**
     * Updates and returns a model.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $model = $this->modelClass::findOrFail($id);
        if ($model->update($request->all())) {
            return response()->json($model, 200);
        } else {
            abort(400, "Model not updated correctly, please let us know if this keeps happening.");
        }

    }

    /**
     * Deletes an account.
     *
     * @param $id
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function delete($id)
    {
        if ($this->modelClass::findOrFail($id)->delete()) {
            return response('Deleted Successfully', 200);
        } else {
            abort(400, 'Model not deleted correctly, please let us know if this keeps happening.');
        }
    }
}
