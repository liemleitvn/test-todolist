<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 06/11/2018
 * Time: 22:53
 */

namespace App\Models;

use voku\db\DB;
use App\Models\AbstractTodoList;


class TodoLists extends AbstractTodoList
{
    protected $db;

    public function __construct()
    {
        $this->db = $this->connection();
    }

    /**
     * connection database use composer voku/simple-mysqli
     * @return DB
     */
    public function connection () {
        return DB::getInstance('localhost','root','123456@##Ss1','todolist');
    }

}