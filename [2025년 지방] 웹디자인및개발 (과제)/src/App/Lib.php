<?php

namespace Gondr\App;


class Lib
{
    public static function redirect(string $url, string $msg = "")
    {
        session()->set("msg", $msg);
        header("location: {$url}");

        exit;
    }

    public static function back(string $msg = "")
    {
        echo "<script>";
        if($msg != "")
            echo "alert('". $msg . "');";

        echo "history.back();";
        echo "</script>";
    }

    public static function json($value)
    {
        header('Content-Type: application/json');
        echo json_encode($value, JSON_UNESCAPED_UNICODE);
        exit;
    }

    public static function dump($var)
    {
        echo "<div style='width:450px;box-shadow:2px 2px 5px #ddd;padding:4px;'>";
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        echo "</div>";
    }

    public static function createSalt()  //랜덤 솔트 제조
    {
        $salt = md5(uniqid(rand(), true));
        return substr($salt, 0, 10);
    }

    public static function generateHash($id, $password, $salt)
    {
        return hash("sha256", $salt . $id . $password);
    }
}