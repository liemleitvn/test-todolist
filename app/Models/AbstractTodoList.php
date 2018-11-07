<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 07/11/2018
 * Time: 10:32
 */

namespace App\Models;


abstract class AbstractTodoList
{

    protected $db;

    /**
     * get data from database
     * @param string $table
     * @param array $where
     * @return Exception|\Exception|false|\voku\db\Result
     * @throws \voku\db\exceptions\QueryException
     */
    public function get($table = 'list', $where = []) {
        if(!empty($where)) {
            $result = $this->db->select($table, $where);
        } else {
            $result = $this->db->select($table);
        }

        return $result;
    }
}