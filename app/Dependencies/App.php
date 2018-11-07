<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 11/6/18
 * Time: 4:16 PM
 */
namespace App\Dependencies;

class App
{
    public function __construct()
    {
        ////
    }

    public function __call($name, $arguments) {
        if (method_exists($this, $name)
            && is_callable(array($this, $name)))
        {
            call_user_func(
                array($this, $name)
            );
        }
    }

    /**
     * @param $className
     * @return mixed|object
     * @throws Exception
     */
    public static function make($className) {
        $container = new Container();
        $container->set($className);
        return $container->get($className);
    }
}