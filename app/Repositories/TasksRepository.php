<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 07/11/2018
 * Time: 12:16
 */

namespace App\Repositories;

use App\Repositories\EloquentAbstract;
use App\Models\Eloquents\TasksModel;

class TasksRepository extends EloquentAbstract
{
    protected $tasks;

    public function __construct(TasksModel $tasks)
    {
        $this->$tasks = $tasks;
    }
}