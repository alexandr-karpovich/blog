<?php

namespace Core;

use Controller\DefaultController;

class Router
{
    /**
     * @var array
     */
    public static $errorAction = [
        'controller' => DefaultController::class,
        'action' => 'errorAction'
    ];

    /**
     * Match routes
     *
     * @return mixed
     * @throws \Exception
     */
    public static function handleRequest()
    {
        $currentRoute = explode('?', $_SERVER['REQUEST_URI']);
        $currentRoute = $currentRoute[0];

        $routes = require_once(BASE_DIR.'/app/Config/Routes.php');

        $action = ( array_key_exists($currentRoute, $routes) ) ? $routes[$currentRoute] : self::$errorAction;

        return self::callController($action);
    }

    /**
     *
     * @param $action
     * @return mixed
     * @throws \Exception
     */
    public static function callController($action)
    {
        $object = new $action['controller'];
        if ( !class_exists($action['controller']) )
            throw new \Exception('Class "'.$action['controller'].'" does not exists');


        if ( !method_exists($object, $action['action']) )
            throw new \Exception('Method "'.$action['action'].'" does not exists in class "'.$action['controller'].'"');

        return call_user_func([$object, $action['action']]);
    }
}
?>