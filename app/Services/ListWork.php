<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 06/11/2018
 * Time: 23:11
 */

namespace App\Services;

use App\Models\TodoLists;

class ListWork
{
    private $todolist;

    public function __construct()
    {
        $this->todolist = app(TodoLists::class);

    }

    public function execute () {

        $result = $this->todolist->get('list');

        $lists = [];

        if(count($result) > 0) {
            foreach ($result as $list) {
                $lists[] = [
                    'id'=>$list['id'],
                    'name'=>$list['name'],
                    'start_date'=>$list['start_date'],
                    'end_date'=>$list['end_date'],
                    'status'=>$list['status'],
                ];
            }
        }
        return $lists;
    }

}