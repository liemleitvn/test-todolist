<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 08/11/2018
 * Time: 17:26
 */

namespace App\Services;

class ServiceProvider
{
    public function __construct()
    {
    }

    public static function register() {
        return [
            'get_task'=>GetTaskService::class,
            'update_task'=>UpdateTaskService::class,
            'create_task'=>CreateTaskService::class,
            'delete_task'=>DeleteTaskService::class
        ];
    }
}