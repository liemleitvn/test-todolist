<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 11/6/18
 * Time: 5:01 PM
 */

/**
 * @param null $className
 * @return \App\Dependencies\App|mixed|object
 * @throws \App\Dependencies\Exception
 */
function app($className = null) {
    if ($className) {

        return (new App\Dependencies\App())->make($className);
    }
    return (new App\Dependencies\App());
}

function view($name, $params = []) {
    echo \App\Kernel::$blade->view()->make($name)->render();
}

//$apiHelper = app('App\Helpers\Api');
//$apiHelper = app()->make('App\Helpers\Api')

if (! function_exists('response')) {
    /**
     * @param string $content
     * @param int $status
     * @param array $headers
     * @return \App\Dependencies\App|mixed|object
     * @throws \App\Dependencies\Exception
     */
    function response()
    {
        return app(\App\Providers\ResponseProvider::class);
    }
}