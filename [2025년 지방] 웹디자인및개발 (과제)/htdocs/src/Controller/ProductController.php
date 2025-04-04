<?php

namespace Gondr\Controller;

use Gondr\App\DB;
use Gondr\App\Lib;

class ProductController extends MasterController
{
    public function index()
    {
        $sql = "SELECT * FROM categories";
        $categoryList = DB::fetchAll($sql);

        foreach ($categoryList as $cat)
        {
            $sql = "SELECT * FROM products WHERE category = ?"; //나중에 여기서 Hit순으로 정렬
            $cat->products = DB::fetchAll($sql, [$cat->code]);
        }

        $this->render("product/index", ['list'=>$categoryList]);
    }





    //이건 값 초기화용
    public function insertProductFromJson()
    {
        $products = $_POST["products"];
        $categories = $_POST['categories'];
        $notices = $_POST['notices'];

        $sql = "TRUNCATE products";
        DB::execute($sql);

        foreach ($products as $pro)
        {
            $sql = "INSERT INTO products (title, description, discountOption, discountValue, price, shipPrice, benefits, image, category)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            DB::execute($sql,
                [$pro["title"], $pro["description"], $pro["discountOption"], $pro["discountValue"],
                    $pro["price"], $pro["shipPrice"], implode(",", $pro["benefits"]), $pro["image"], $pro["category"]]);
            //id, title, description, discountOption, discountValue, price,shipPrice, benefits, image, category,
        }

        $sql = "TRUNCATE categories";
        DB::execute($sql);

        foreach ($categories as $cat)
        {
            $sql = "INSERT INTO categories (code, name) VALUES (?, ?)";
            DB::execute($sql, [$cat["code"], $cat["name"]]);
        }


        //관리자 삽입

        $salt = Lib::createSalt();
        $hashedPassword = Lib::generateHash("admin", "1111", $salt);

        $sql = "INSERT INTO `users` (`id`, `password`, `email`, `username`, `salt`, `register_date`) VALUES (?, ?, ?, ?, ?, NOW())";
        DB::execute($sql, ["admin", $hashedPassword, "admin@admin", "관리자", $salt]);

        //공지사항 삽입
        $sql = "TRUNCATE notices";
        DB::execute($sql);
        foreach ($notices as $notice)
        {
            $sql = "INSERT INTO notices(category, content, date) VALUES (?, ?, ?)";
            DB::execute($sql, [$notice["category"], $notice["content"], $notice["date"]]);
        }
    }
}