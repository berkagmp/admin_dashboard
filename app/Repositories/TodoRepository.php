<?php

namespace App\Repositories;

interface TodoRepository
{
    /**
     * Get's a todo by it's ID
     *
     * @param int
     */
    public function get(int $todo_id);

    /**
     * Get's all todos.
     *
     * @return mixed
     */
    public function all();

    /**
     * Create a todo.
     *
     * @param int
     * @param array
     */
    public function create(array $todo_data);

    /**
     * Updates a todo.
     *
     * @param int
     * @param array
     */
    public function update(int $todo_id, array $todo_data);

    /**
     * Deletes a todo.
     *
     * @param int
     */
    public function delete(int $todo_id);
}
