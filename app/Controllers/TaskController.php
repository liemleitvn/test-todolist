<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 11/6/18
 * Time: 5:54 PM
 */
namespace App\Controllers;

use http\Env\Response;
use function MongoDB\BSON\toJSON;
use Symfony\Component\HttpFoundation\Request;
use App\Services\ServiceFactory;

class TaskController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Author: Liem Le <liemleitvn@gmail.com>
     * @return mixed
     * @throws \App\Dependencies\Exception
     */
    public function index () {

        return response()->view('show');
    }

    /**
     * @author Liem Le <liemleitvn@gmail.com>
     * @return mixed
     * @throws \App\Dependencies\Exception
     */
    public function get() {

        $tasks = ServiceFactory::create('get_task')->execute();

        return response()->json([
            'data' => $tasks,
            'message' => ''
        ]);
    }

    /**
     * Author: Liem Le <liemleitvn@gmail.com>
     * @param $request
     * @return mixed
     * @throws \App\Dependencies\Exception
     */
    public function store($request) {

        $data = $request['_request']->request->all();

        $result = ServiceFactory::create('create_task')->execute($data);

        return response()->json(['data' => $result, 'message' => '']);
    }

    /**
     * Author: Liem Le <liemleitvn@gmail.com>
     * @param $request
     * @return mixed
     * @throws \App\Dependencies\Exception
     */
    public function update($request) {

        $data = $request['_request']->request->all();

        $result = ServiceFactory::create('update_task')->execute($data);

        return response()->json(['data' => $result, 'message' => '']);
    }

    /**
     * Author: Liem Le <liemleitvn@gmail.com>
     * @param $request
     * @return mixed
     * @throws \App\Dependencies\Exception
     */
    public function destroy($request) {

        $id = $request['id'];

        $result = ServiceFactory::create('delete_task')->execute($id);

        return response()->json(['data' => $result, 'message' => '']);
    }
}