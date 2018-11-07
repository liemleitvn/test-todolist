<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 11/6/18
 * Time: 5:13 PM
 */
namespace App;


use App\Providers\RouteProvider;
use Jenssegers\Blade\Blade;

class Kernel
{
    static $blade;

    public function load() {
        try {
//            $bladeViewsDirectory = __DIR__ . '/../views';
//            $bladeCacheDirectory = __DIR__ . '/../bootstrap/cache';
//
//            static::$blade = new Blade($bladeViewsDirectory, $bladeCacheDirectory);
//            echo static::$blade->make('welcome', ['name' => 'John Doe']);
//            die("xxx");

            require_once __DIR__ . '/../bootstrap/app.php';

            $router = app(RouteProvider::class);

            require_once __DIR__ . '/../routes/web.php';

            $router->dispatch();
        } catch(\Exception $e) {
            var_dump($e);
            die;
        }
    }
}