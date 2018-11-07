<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 11/6/18
 * Time: 5:54 PM
 */
namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use App\Services\GetListTaskService;

class ListController extends Controller
{
    private $listTaskService;

    public function __construct(GetListTaskService $listTaskService)
    {
        $this->listTaskService = $listTaskService;
    }

    public function index () {
        require_once ROOT_PATH.'/views/show.php';
    }

    public function get() {

        $lists = $this->listTaskService->execute();

        echo json_encode($lists);
    }
}