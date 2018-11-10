<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 11/7/18
 * Time: 11:20 AM
 */

namespace App\Models\Eloquents;


use App\Models\EloquentModelAbstract;

class Tasks extends EloquentModelAbstract
{
    /**
     * @var string
     */
    protected $table = 'tasks';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    public $fillable = ['name', 'start_date', 'end_date', 'status'];
}