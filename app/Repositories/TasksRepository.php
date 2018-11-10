<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 07/11/2018
 * Time: 12:16
 */

namespace App\Repositories;

use App\Models\Eloquents\Tasks;

class TasksRepository extends EloquentAbstract
{
    protected $model;

    public function __construct(Tasks $tasks)
    {
        $this->model = $tasks;
    }
}