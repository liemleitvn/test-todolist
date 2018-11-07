<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 07/11/2018
 * Time: 12:19
 */

namespace App\Services;

use App\Repositories\TasksRepository;

class GetTaskService
{
    private $tasksRepo;

    public function __construct(TasksRepository $tasksRepo)
    {
        $this->tasksRepo = $tasksRepo;
    }

    public function execute() {
        $result =  $this->tasksRepo->all('*',100);

        if(count($result)>0) {
            return $result;
        }
        else {
            return ['message'=>'Get data fail'];
        }
    }
}