<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 08/11/2018
 * Time: 16:37
 */

namespace App\Providers;


use Symfony\Component\HttpFoundation\Response;

class ResponseProvider
{
    public function __construct()
    {
    }

    public function view($view) {
        require_once ROOT_PATH . "/views/$view.php";
    }

    public function json($data) {
        echo json_encode($data);
    }
}