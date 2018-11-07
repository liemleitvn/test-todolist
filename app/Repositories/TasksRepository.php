<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 07/11/2018
 * Time: 12:16
 */

namespace App\Repositories;

use App\Repositories\Eloquents\EloquentAbstract;
use App\Services\ListWork;

class TasksRepository extends EloquentAbstract
{
    protected $listWork;

    public function __construct(ListWork $listWork)
    {
        $this->listWork = $listWork;
    }
}