<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 08/11/2018
 * Time: 11:17
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://test-todolist.local/tasks/update",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\n\t\"id\":\"1\",\n\t\"name\": \"React\"\n}\n",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Postman-Token: 6c17824e-ce15-464b-b67a-07e840088e84",
        "cache-control: no-cache"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

var_dump($response);
