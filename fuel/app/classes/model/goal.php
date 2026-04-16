<?php

class Model_Goal
{
    // userに紐づくgoal一覧を取得
    public static function find_by_user($user_id)
    {
        return DB::select()
            ->from('goals')
            ->where('user_id', '=', $user_id)
            ->execute();
    }

    // goalを1件取得
    public static function find($goal_id)
    {
        return DB::select()
            ->from('goals')
            ->where('id', '=', $goal_id)
            ->execute()
            ->current();
    }

    // user_idも条件に含めてgoalを1件取得
    public static function find_by_user_and_id($goal_id, $user_id)
    {
        return DB::select()
            ->from('goals')
            ->where('id', '=', $goal_id)
            ->where('user_id', '=', $user_id)
            ->execute()
            ->current();
    }

    // goalを新規作成
    public static function create($user_id, $title, $deadline)
    {
        return DB::insert('goals')->set([
            'user_id' => $user_id,
            'title' => $title,
            'deadline' => $deadline,
        ])->execute();
    }

    // goalを更新
    public static function update($title, $deadline, $goal_id, $user_id)
    {
        return DB::update('goals')->set([
            'title' => $title,
            'deadline' => $deadline,
        ])
            ->where('id', '=', $goal_id)
            ->where('user_id', '=', $user_id)
            ->execute();
    }

    // goalを削除
    public static function delete($goal_id, $user_id)
    {
        return DB::delete('goals')
            ->where('id', '=', $goal_id)
            ->where('user_id', '=', $user_id)
            ->execute();
    }
}