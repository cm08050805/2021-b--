<?php

namespace Gondr\Controller;

use Gondr\App\DB;
use Gondr\App\Lib;

class MainController extends MasterController
{
    public function index()
    {
        $this->render("main");
    }

    public function getNotices()
    {
        $sql = "SELECT * FROM notices ORDER BY date DESC";
        $notices = DB::fetchAll($sql);
        return Lib::json(['notices' => $notices]);
    }
}