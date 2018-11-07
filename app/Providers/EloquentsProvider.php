<?php
/**
 * Created by PhpStorm.
 * User: phanxicopeter
 * Date: 11/7/18
 * Time: 11:08 AM
 */

namespace App\Providers;


use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class EloquentsProvider
{
    public function boot()
    {
        $capsule = new Capsule;

        $config = require_once ROOT_PATH . '/config/database.php';

        $capsule->addConnection($config);

        // Set the event dispatcher used by Eloquent models... (optional)
        $capsule->setEventDispatcher(new Dispatcher(new Container));

        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
    }
}