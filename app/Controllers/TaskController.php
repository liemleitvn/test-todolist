<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 11/6/18
 * Time: 5:54 PM
 */
namespace App\Controllers;

use http\Env\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Services\GetTaskService;

class TaskController extends Controller
{
    private $taskService;

    public function __construct(GetTaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index () {

        require_once ROOT_PATH.'/views/show.php';
    }

    public function get() {

        $tasks = $this->taskService->execute();

        echo json_encode([
            'data' => $tasks,
            'message' => ''
        ]);
    }

    public function update($request) {
        echo json_encode(["ok"=>$request->all()]) ;
    }
}