<?php

$db = new \PDO("mysql:host=localhost; dbname=todopage; charset=utf8mb4", "root", "", [\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ]);

$q = $db->prepare("SELECT * FROM users");

$q->execute();

$list = $q->fetchAll();


foreach ($list as $item){
    echo $item->id;
}