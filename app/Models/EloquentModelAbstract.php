<?php
/**
 * Created by PhpStorm.
 * User: phanxicopeter
 * Date: 11/7/18
 * Time: 11:16 AM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

abstract class EloquentModelAbstract extends Model
{
    /**
     * @var
     */
    protected $connection;

    /**
     * @var
     */
    protected $table;

    /**
     * @var
     */
    protected $primaryKey;
}