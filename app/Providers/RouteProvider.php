<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 11/6/18
 * Time: 4:46 PM
 */
namespace App\Providers;


use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request;

class RouteProvider
{
    /**
     * @var $this
     */
    private $context;

    /**
     * @var RouteCollection
     */
    private $routes;

    private $currentRouteName;

    public function __construct() {
        $context = new RequestContext();
        $this->context = $context->fromRequest(Request::createFromGlobals());
        $this->routes = new RouteCollection();
    }

    /**
     * @param $key
     * @param $regex
     */
    public function where($key, $regex) {
        $this->routes->get($this->currentRouteName)->setRequirement($key, $regex);
    }

    /**
     * @param $method
     * @param $path
     * @param $controller
     * @param array $options
     * @param array $requirements
     * @return $this
     */
    public function route($method, $path, $controller, $options = [], $requirements = []) {

        if(!isset($options['name'])) {
            $options['name'] = $path;
        }

        $this->currentRouteName = $options['name'];

        $this->routes->add($options['name'], new Route(
            $path,
            [ '_controller' => $controller ], // controller option
            $requirements, // requirement of parameter, for example, id must be integer ('id' => '[0-9]')
            [], // not care
            '', // not care
            [], // not care
            $method // GET|POST|PUT|PATCH|DELETE
        ));

        return $this;
    }

    /**
     * @param $path
     * @param $options
     * @param $requirements
     * @return RouteProvider
     * @throws \Exception
     */
    public function get($path, $options, $requirements = []) {
        return $this->route('GET', $path, $options, $requirements);
    }

    /**
     * @param $path
     * @param $options
     * @param array $requirements
     * @return RouteProvider
     * @throws \Exception
     */
    public function post($path, $options, $requirements = []) {
        return $this->route('POST', $path, $options, $requirements);
    }

    /**
     * @param $path
     * @param $options
     * @param $requirements
     * @return RouteProvider
     * @throws \Exception
     */
    public function put($path, $options, $requirements) {
        return $this->route('PUT', $path, $options, $requirements);
    }

    /**
     * @param $path
     * @param $options
     * @param $requirements
     * @return RouteProvider
     * @throws \Exception
     */
    public function patch($path, $options, $requirements) {
        return $this->route('PATCH', $path, $options, $requirements);
    }

    /**
     * @param $path
     * @param $options
     * @param $requirements
     * @return RouteProvider
     * @throws \Exception
     */
    public function delete($path, $options, $requirements) {
        return $this->route('DELETE', $path, $options, $requirements);
    }

    /**
     * @throws \App\Dependencies\Exception
     */
    public function dispatch() {
        $matcher = new UrlMatcher($this->routes, $this->context);

        try {
            $matcher = $matcher->match($_SERVER['REQUEST_URI']);

            if(is_string($matcher['_controller']) && strpos($matcher['_controller'], '::') !== false) {
                $extracter = explode('::', $matcher['_controller']);
                if(!class_exists($extracter[0])) {
                    throw new RouteNotFoundException("Controller not found!");
                }

                if (count($extracter) == 1){
                    $extracter[1] = 'index';
                }

                $queryString = $_SERVER['QUERY_STRING'];
                parse_str($queryString, $query);

                $matcher['_request'] = new Request($query);

                foreach ($matcher as $key => $value) {
                    if (strpos($value, "?") !== false) {
                        $splitter = explode('?', $value);
                        $matcher[$key] = $splitter[0];
                    }
                }

                call_user_func([app($extracter[0]), $extracter[1]], $matcher);
            } else {
                call_user_func_array($matcher['_controller'], $matcher);
            }
        } catch (MethodNotAllowedException $e) {
            ///
            echo 'Route method is not allowed.';
        } catch (ResourceNotFoundException $e) {
            ///
            echo 'Route does not exist.';
        }
    }
}