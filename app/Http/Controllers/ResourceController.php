<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * @template T
 */
abstract class ResourceController extends Controller
{
    /**
     * The model class used by the resource.
     *
     * @var class-string<T> $modelClass
     */
    private string $modelClass;

    public function __construct()
    {
        $this->modelClass = $this->defineModel();
    }

    /**
     * Define Model to use
     * @return class-string<T>
     */
    abstract protected function defineModel();
    /**
     * @param T $item
     * @return T
     */
    abstract protected function beforeSend($item);

    /**
     * Summary of test
     * @return T
     */
    public function test() {
        $modelClass = $this->modelClass;
        return new $modelClass();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modelClass = $this->modelClass;
        /** @var T[] */
        $instances = $modelClass::all()->all();
        $result = [];
        foreach ($instances as $instance) {
            $result[] = $this->beforeSend($instance);
        }
        return $this->sendResponse($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $modelClass = $this->modelClass;
        $model = $modelClass::create($request->all()['item']);
        $model = $this->beforeSend($model);
        return $this->sendResponse($model);
    }

    /**
     * Display the specified resource.
     * @param T $model
     */
    public function show(Model $model)
    {
        $model = $this->beforeSend($model);
        return $this->sendResponse($model);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {
        $modelClass = $this->modelClass;
        $model = $modelClass::find($id);
        $model->update($request->all()['item']);
        $model = $this->beforeSend($model);
        return $this->sendResponse($model);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $modelClass = $this->modelClass;
        $result = $modelClass::destroy($id);
        return $this->sendResponse($result == 1);
    }
}
