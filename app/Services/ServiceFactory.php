<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 08/11/2018
 * Time: 17:29
 */

namespace App\Services;


use App\Dependencies\Exception;

class ServiceFactory
{
    protected function __construct()
    {
    }

    public static function create ($provider) {
        $providers = ServiceProvider::register();

        if(!isset($providers[$provider])) {
            throw new Exception("Provider {$provider} is not found!");
        }

        $className = $providers[$provider];

        if(!class_exists($className)) {
            throw new Exception("Class {$className} is not found!");
        }

        return app($className);
    }
}