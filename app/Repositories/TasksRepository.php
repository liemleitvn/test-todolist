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
    // Lam chi tam bay r
    // $tasks ni ơ dau r
    // npó hải trung voi $model ở lớp cha thì lớp cha mới dùng được chứ

    public function __construct(Tasks $tasks)
    {
        $this->model = $tasks;
    }
}