<?php

namespace App\Services;

class Router
{
    private static $link = [];

    public static function page($uri, $page)
    {
        self::$link[] = [
            'uri' => $uri,
            'page' => $page
        ];
    }

    public static function post($uri, $class, $method, $formdata = false, $files = false)
    {
        self::$link[] = [
            'uri' => $uri,
            'class' => $class,
            'method' => $method,
            'post' => true,
            'formdata' => $formdata,
            'files' => $files
        ];
    }

    public static function ebable()
    {
        $query = isset($_GET['q']) ? $_GET['q'] : '';

        foreach (self::$link as $route) {
            if ($route['uri'] == "/" . $query) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST' and $route['post'] === true) {
                    $action = new $route['class'];
                    $method = $route['method'];
                    if ($route['formdata'] and $route['files']) {
                        $action->$method($_POST, $_FILES);
                        die();
                    } elseif ($route['formdata'] and !$route['files']) {
                        $action->$method($_POST);
                        die();
                    } else {
                        $action->$method();
                        die();
                    }
                } else {
                    require_once "views/page/" . $route['page'] . ".php";
                    die();
                }
            }
        }

        self::error('404');
    }

    public static function error($error)
    {
        require_once 'views/errors/' . $error . '.php';
    }

    public static function redirect($page)
    {
        require_once "views/page/" . $page . ".php";
        die();
    }
}
