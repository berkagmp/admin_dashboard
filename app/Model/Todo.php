<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'todo', 'done', 'finish', 'due', 'user_id'
    ];

    /**
     * Validation Rule for Creating and Updating.
     *
     * @var array
     */
    public static $validation_rule = [
        'todo'      => 'required|string',
        'done'      => 'nullable|boolean',
        'due'       => 'nullable|date',
        'finish'    => 'nullable|date_format:Y-m-d H:i:s',
        'user_id'   => 'required|exists:users,id',
    ];
}
