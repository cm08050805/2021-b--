<?php

namespace Gondr\Controller;

use Gondr\App\{DB, Lib};

class UserController extends MasterController
{
    //회원가입 페이지를 보여주는 곳
    public function register()
    {
        $this->render("user/register");
    }

    //회원가입 처리를 하는 곳
    public function registerProcess()
    {
        $userid = $_POST['userid'];
        $password = $_POST['password'];
        $username = $_POST['username'];
        $email = $_POST['email'];

        $salt = Lib::createSalt();
        $hashedPassword = Lib::generateHash($userid, $password, $salt);

        $sql = "INSERT INTO `users` (`id`, `password`, `email`, `username`, `salt`, `register_date`) VALUES (?, ?, ?, ?, ?, NOW())";
        $cnt = DB::execute($sql, [$userid, $hashedPassword, $email, $username, $salt]);
        if($cnt == 1){
            Lib::redirect("/user/login", "회원가입이 성공적으로 이루어졌습니다.");
        }else {
            Lib::redirect("/user/register", "회원가입이 실패했습니다.");
        }
    }

    public function login(){
        $this->render("/user/login");
    }

    public function loginProcess()
    {
        $userid = $_POST['userid'];
        $password = $_POST['password'];

        $user = user()->login($userid, $password);

        if($user == null){
            Lib::redirect("/user/login", "아이디 또는 비밀번호가 올바르지 않습니다.");
        }

        session()->set("user", $user);
        Lib::redirect("/", "로그인 완료");
    }

    public function logout()
    {
        user()->logout();
        Lib::redirect("/", "로그아웃 완료");
    }


}