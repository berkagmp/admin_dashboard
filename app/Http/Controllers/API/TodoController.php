<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\TodoResource;
use App\Model\Todo;
use App\Repositories\TodoRepositoryInterface;
use Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends ResponseController
{
    private $todoRepo;

    /**
     * TodoController constructor.
     *
     * @param TodoRepositoryInterface $todoRepo
     */
    public function __construct(TodoRepositoryInterface $todoRepo)
    {
        $this->todoRepo = $todoRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return TodoResource::collection($this->todoRepo->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), Todo::$validation_rule);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $todo = $this->todoRepo->create($request->all());

        if ($todo) {
            return $this->sendResponse($todo, Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $todo_id
     * @return \Illuminate\Http\Response
     */
    public function get(int $todo_id)
    {
        return $this->todoRepo->get($todo_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(int $todo_id, Request $request)
    {
        $validator = Validator::make($request->all(), Todo::$validation_rule);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $todo = $this->todoRepo->update($todo_id, $request->all());

        if ($todo) {
            return $this->sendResponse($todo, Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function delete(int $todo_id)
    {
        $this->todoRepo->delete($todo_id);
    }
}
