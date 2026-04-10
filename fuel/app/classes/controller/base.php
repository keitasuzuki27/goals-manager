<?php


 // 認証が必要なControllerの共通処理
 // ログインしていない場合はログイン画面へリダイレクトする
 

class Controller_Base extends Controller
{
    public function before()
    {
        parent::before();

        if (!Session::get('user_id')) {
            return Response::redirect('/login');
        }
    }
}
