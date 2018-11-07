<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 07/11/2018
 * Time: 12:19
 */

namespace App\Services;

use App\Repositories\TasksRepository;

class GetListTaskService
{
    private $tasks;

    public function __construct(TasksRepository $tasks)
    {
        $this->tasks = $tasks;
    }

    public function execute() {
        return $this->tasks->all('',100);
    }
}