<?php
    session_start();

    function session()
    {
        return new \Gondr\App\Session();
    }

    function user()
    {
        return new \Gondr\App\User();
    }

    define("__ROOT",  dirname(__DIR__) );
    define("__SRC", __ROOT . "/src");

    include_once __ROOT . "/autoload.php";
    include_once __ROOT . "/web.php";

    Gondr\App\Route::route();