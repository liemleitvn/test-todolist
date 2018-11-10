<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 09/11/2018
 * Time: 01:06
 */

namespace App\Services;
use App\Repositories\TasksRepository;


class CreateTaskService
{
    private $taskRepo;
    public function __construct(TasksRepository $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }

    public function execute($task) {

        return $this->taskRepo->create($task);
    }

}