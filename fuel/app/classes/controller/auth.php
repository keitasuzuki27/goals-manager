<?php

class Controller_Auth extends Controller
{
    public function action_register()
    {
        return Response::forge(
            View::forge('auth/register')
        );
    }

    public function action_login()
    {
        return Response::forge(
            View::forge('auth/login')
        );
    }

    // usersのcreate
    public function post_create()
    {
        $name = Input::post('name');
        $email = Input::post('email');
        $password = Input::post('password');

        if (!$name || !$email || !$password) {
            return Response::redirect('/register');
        }

        // ハッシュ化
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        DB::insert('users')->set([
            'name' => $name,
            'email' => $email,
            'password_hash' => $password_hash,
        ])->execute();

        return Response::redirect('/dashboard');
    }

    // ログイン処理（POST /login）
    public function post_login()
    {
        $email = Input::post('email');
        $password = Input::post('password');

        // 入力チェック
        if (!$email || !$password) {
            return Response::redirect('/login');
        }

        // ユーザー取得
        $user = DB::select()
            ->from('users')
            ->where('email', $email)
            ->execute()
            ->current();

        // ユーザーがいない
        if (!$user) {
            return Response::redirect('/login');
        }

        // パスワード確認
        if (!password_verify($password, $user['password_hash'])) {
            return Response::redirect('/login');
        }

        // ログイン成功 → セッション保存
        Session::set('user_id', $user['id']);

        return Response::redirect('/dashboard');
    }

    public function post_logout() 
    {
        Session::destroy();

        return Response::redirect('/login');
    }
}
 