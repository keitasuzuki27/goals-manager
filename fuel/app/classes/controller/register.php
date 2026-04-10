<?php
class Controller_Register extends Controller
{
    // usersのcreate
    public function action_create()
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
}
