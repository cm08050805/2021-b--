<?php

namespace Gondr\App;


class Session
{
    public function set(string $key, $data)
    {
        $_SESSION[$key] = $data;
    }

    public function has(string $key) : bool
    {
        return isset($_SESSION[$key]);
    }

    public function remove(string $key)
    {
        unset($_SESSION[$key]);
    }

    public function get(string $key, bool $save = false)
    {
        if($this->has($key)) {
            $data = $_SESSION[$key];

            if(!$save){
                $this->remove($key);
            }
            return $data;
        }else {
            return false;
        }
    }
}