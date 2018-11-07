<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 11/6/18
 * Time: 5:07 PM
 */

defined("ROOT_PATH") or define("ROOT_PATH", __DIR__ . '/../');

require __DIR__ . '/../vendor/autoload.php';

$kernel = new \App\Kernel();
$kernel->load();
error_reporting(E_ALL);
ini_set('display_errors', 1);