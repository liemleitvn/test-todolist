<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 09/11/2018
 * Time: 17:26
 */

namespace App\Services;

use App\Repositories\TasksRepository;

class DeleteTaskService
{
    private $taskRepo;

    public function __construct(TasksRepository $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }

    public function execute($id) {
        return $this->taskRepo->delete($id);
    }
}