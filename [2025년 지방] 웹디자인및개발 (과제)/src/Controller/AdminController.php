<?php

namespace Gondr\Controller;

use Gondr\App\DB;
use Gondr\App\Lib;

class AdminController extends MasterController
{
    public function noticeManage()
    {
        $sql = "SELECT * FROM notices ORDER BY date DESC";
        $notices = DB::fetchAll($sql);

        $this->render("admin/notice", ['notices'=>$notices]);
    }

    public function deleteNotice($id)
    {
        $sql = "DELETE FROM notices WHERE id = ?";
        DB::execute($sql, [$id]);

        Lib::redirect("/admin/notice", "삭제 완료");
    }

    public function noticeCreatePage()
    {
        $this->render("admin/notice_create", ['id'=>0, 'category'=>"일반", 'content'=>"" ]);
    }

    public function noticeCreate()
    {
        $category = $_POST['category'];
        $content = $_POST['content'];

        $sql = "INSERT INTO notices (category, content, date) VALUES(?, ?, NOW())";
        DB::execute($sql, [$category, $content]);
        Lib::redirect("/admin/notice", "생성 완료");
    }

    public function noticeModifyPage($id)
    {
        $sql = "SELECT * FROM notices WHERE id = ?";
        $notice = DB::fetch($sql, [$id]);
        $this->render("admin/notice_create", ['id'=>$id, 'category'=>$notice->category, 'content'=> $notice->content]);
    }

    public function noticeModify($id)
    {
        $category = $_POST['category'];
        $content = $_POST['content'];

        $sql = "UPDATE notices SET category = ?, content = ? WHERE id = ?";
        DB::execute($sql, [$category, $content, $id]);
        Lib::redirect("/admin/notice", "수정 완료");
    }
}