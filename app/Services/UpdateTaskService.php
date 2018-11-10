<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 08/11/2018
 * Time: 17:17
 */

namespace App\Services;

use App\Repositories\TasksRepository;


class UpdateTaskService
{
    private $tasksRepo;

    public function __construct(TasksRepository $tasksRepo) {
        $this->tasksRepo = $tasksRepo;
    }

    public function execute ($data) {
        $id = $data['id'];
        unset($data['id']);

        return $this->tasksRepo->update($data, $id);

    }
}