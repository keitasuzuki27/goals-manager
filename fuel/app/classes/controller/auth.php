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

    // userの新規登録
    public function post_create()
    {
        $name = Input::post('name');
        $email = Input::post('email');
        $password = Input::post('password');

        $errors = [];

        // ユーザー名のバリデーション
        if (empty($name)) {
            $errors['username'] = 'ユーザー名を入力してください';
        }

        // メールアドレスのバリデーション
        if (empty($email)) {
            $errors['email'] = 'メールアドレスを入力してください';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = '正しいメールアドレスを入力してください';
        }

        // パスワードのバリデーション
        if (strlen($password) < 8) {
            $errors['password'] = 'パスワードは8文字以上にしてください';
        }

        // 同じemailを使ったアカウントが無いかを確認
        if (empty($errors['email'])) {
            $existing_user = Model_User::find_by_email($email);

            if ($existing_user) {
                $errors['email'] = 'そのメールアドレスはすでに使われています';
            }
        }

        // エラーメッセージとinputの入力値を返す
        if (!empty($errors)) {
            return Response::forge(View::forge('auth/register', [
                'errors' => $errors,
                'old' => [
                    'username' => $name,
                    'email' => $email,
                ]
            ]));
        }

        // ハッシュ化
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // 戻り値からuser_idを取得後、sessionに保存
        list($user_id) = DB::insert('users')->set([
            'name' => $name,
            'email' => $email,
            'password_hash' => $password_hash,
        ])->execute();

        Session::set('user_id', $user_id);
        return Response::redirect('/dashboard');
    }

    // ログイン処理
    public function post_login()
    {
        $email = Input::post('email');
        $password = Input::post('password');

        $errors = [];

        // メールアドレスのバリデーション
        if (empty($email)) {
            $errors['email'] = 'メールアドレスを入力してください';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = '正しいメールアドレスを入力してください';
        }

        // パスワードのバリデーション
        if (empty($password)) {
            $errors['password'] = 'パスワードを入力してください';
        }

        if (!empty($email) && !empty($password)) {

            // ユーザー取得
            $user = Model_User::find_by_email($email);

            // メールアドレス、またはパスワードが違う
            if (!$user || !password_verify($password, $user['password_hash'])) {
                $errors['login'] = 'メールアドレスまたはパスワードが正しくありません';
            }
        }

        // エラーがある場合はエラーメッセージと入力されたメールアドレスを返す
        if (!empty($errors)) {
            return Response::forge(View::forge('auth/login', [
                'errors' => $errors,
                'old' => [
                    'email' => $email,
                ],
            ]));
        }

        // ログイン成功 → セッション保存
        Session::set('user_id', $user['id']);

        return Response::redirect('/dashboard');
    }

    // ログアウト処理
    public function post_logout()
    {
        Session::destroy();

        return Response::redirect('/login');
    }
}
