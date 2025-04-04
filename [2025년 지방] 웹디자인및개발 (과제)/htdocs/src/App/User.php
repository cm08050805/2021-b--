<?php
namespace Gondr\App;

use Gondr\App\Lib;

class User
{
    public function checkLogin() : bool
    {
        return session()->has("user");
    }

    public function isAdmin() : bool
    {
        if(!$this->checkLogin()) return false;
        return $this->get()->id === "admin";
    }

    public function login(string $id, string $password)
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $user = DB::fetch($sql, [$id]);

        if($user == null)
            return false;

        $hashValue = Lib::generateHash($id,$password, $user->salt);

        if($hashValue !== $user->password)
            return false;

        session()->set("user", $user);
        return $user;
    }

    public function get()
    {
        return session()->get('user', true);
    }

    public function logout()
    {
        session()->remove("user");
    }

}