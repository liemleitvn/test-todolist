<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 11/6/18
 * Time: 5:54 PM
 */
namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use App\Services\ListWork;

class ListController extends Controller
{
    private $listWork;

    public function __construct()
    {
        $this->listWork = app(ListWork::class);
    }

    public function index () {
        require_once ROOT_PATH.'/views/show.php';
    }

    public function get() {

        $lists = $this->listWork->execute();

        echo json_encode($lists);
    }
}