<?php

class Model_User
{
    // user_idに紐づくuserを取得
    public static function find($user_id)
    {
        return DB::select()
            ->from('users')
            ->where('id', '=', $user_id)
            ->execute()
            ->current();
    }

    // emailに紐づくuserを取得
    public static function find_by_email($email)
    {
        return DB::select()
            ->from('users')
            ->where('email', '=', $email)
            ->execute()
            ->current();
    }
}
