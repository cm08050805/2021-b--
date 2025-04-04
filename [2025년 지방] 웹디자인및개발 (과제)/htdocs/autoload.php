<?php

function myLoader($name)
{
    //기능대회에서는 만들어 쓰는게 맞는데...
    //현업에서는 composer(npm like package manager) 가 만들어줘

    $prefix = "Gondr\\";
    $base_dir = __DIR__ . "/src/";
    $prefixLen = strlen($prefix);

    if(strncmp($prefix, $name, $prefixLen) == 0) {
        //여기에 들어왔다라는 것은 클래스 이름이 Gondr\로 시작한 것
        //클래스 이름에서 Prefix 길이만큼 짤라낸다.
        //ex) Gondr\App\DB  => App\DB
        $realName = substr($name, $prefixLen);
        $realName = str_replace("\\", "/", $realName);

        $file = "{$base_dir}{$realName}.php";
        if (file_exists($file)) {
            include_once $file;
        }
    }
}

spl_autoload_register("myLoader");