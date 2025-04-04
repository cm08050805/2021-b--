<?php

namespace Gondr\Controller;

use Gondr\App\DB;
use Gondr\App\Lib;

class BoardController extends MasterController
{
    //글쓰기 페이지 보는 곳
    public function write()
    {
        $this->render("todo/write");
    }

    //실제 글이 쓰여지는 곳
    public function writeProcess()
    {
        $title = $_POST['title'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $content = $_POST['content'];

        if($title == "" || $date == "" || $content == "") {
            Lib::json(['success'=>false, 'msg'=>'필수 값이 비어있습니다.']);
        }
        $dateTime = $date . " " . ($time == "" ? "00:00:00"  : $time . ":00");


        $sql = "INSERT INTO todos(`title`, `content`, `owner`, `date`) VALUES (?, ?, ?, ?)";
        $result = DB::execute($sql, [$title, $content, user()->get()->id, $dateTime]);

        if($result != 1){
            //Lib::redirect("/todo/write", "데이터베이스 입력중 오류 발생");
            echo $result;
        }else {
            //Lib::redirect("/", "성공적으로 작성되었습니다.");
            Lib::json(['success'=>true, 'msg'=>'성공적으로 작성되었습니다.']);
        }
    }

    public function list($idx = 0)
    {
        $user = user();
        if(!$user->checkLogin()){
            Lib::json(['success'=>false, 'msg'=>'로그인 후 시도하세요']);
        }else {
            $sql = "SELECT * FROM todos WHERE owner = ? AND date >= NOW() ORDER BY date LIMIT {$idx}, 6";
            $list = DB::fetchAll($sql, [$user->get()->id]);

            Lib::json(['success'=>true, 'list'=>$list]);
        }
    }

    public function delete($id)
    {
        //Lib::json(['success'=>false, 'msg' => '권한이 없거나 존재하지 않는 일정입니다.']);
        $user = user();

        $sql = "SELECT * FROM todos WHERE owner = ? AND id = ?";
        $todo = DB::fetch($sql, [$user->get()->id, $id]);

        if($todo == null){
            Lib::json(['success'=>false, 'msg' => '권한이 없거나 존재하지 않는 일정입니다.']);
        }

        $sql = "DELETE * FROM todos id = ?";
        DB::execute($sql, [$id]);
        Lib::json(['success'=>true, 'msg' => '삭제 완료']);
    }
}