<?php

namespace App\Repositories;

use App\Model\Todo;

class TodoRepositoryImpl implements TodoRepository
{

    /**
     * Get's a todo by it's ID
     *
     * @param int
     */
    public function get(int $todo_id)
    {
        return Todo::findOrFail($todo_id);
    }

    /**
     * Get's all todos.
     *
     * @return mixed
     */
    public function all()
    {
        return Todo::paginate();
    }

    /**
     * Create a todo.
     *
     * @param int
     * @param array
     */
    public function create(array $todo_data)
    {
        return Todo::create($todo_data);
    }

    /**
     * Updates a todo.
     *
     * @param int
     * @param array
     */
    public function update(int $todo_id, array $todo_data)
    {
        return Todo::findOrFail($todo_id)->update($todo_data);
    }

    /**
     * Deletes a todo.
     *
     * @param int
     */
    public function delete(int $todo_id)
    {
        Todo::findOrFail($todo_id)->delete();
    }
}
