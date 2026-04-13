<?php

class Model_Task
{
    // goalに紐づくtask一覧を取得
    public static function find_by_goal($goal_id)
    {
        return DB::select()
            ->from('tasks')
            ->where('goal_id', '=', $goal_id)
            ->execute();
    }

    // taskを1件取得（goalとの紐付け確認）
    public static function find_by_task_and_goal($task_id, $goal_id)
    {
        return DB::select()
            ->from('tasks')
            ->where('id', '=', $task_id)
            ->where('goal_id', '=', $goal_id)
            ->execute()
            ->current();
    }

    // taskを新規作成
    public static function create($goal_id, $title, $deadline)
    {
        return DB::insert('tasks')->set([
            'goal_id' => $goal_id,
            'title' => $title,
            'deadline' => $deadline,
        ])->execute();
    }

    // taskを更新
    public static function update($title, $deadline, $task_id, $goal_id)
    {
        return DB::update('tasks')->set([
            'title' => $title,
            'deadline' => $deadline,
        ])
            ->where('id', '=', $task_id)
            ->where('goal_id', '=', $goal_id)
            ->execute();
    }

    // taskの完了状態を更新
    public static function update_status($new_status, $task_id, $goal_id)
    {
        return DB::update('tasks')
            ->set(['is_done' => $new_status])
            ->where('id', '=', $task_id)
            ->where('goal_id', '=', $goal_id)
            ->execute();
    }

    // taskを1件削除
    public static function delete($task_id, $goal_id)
    {
        return DB::delete('tasks')
            ->where('id', '=', $task_id)
            ->where('goal_id', '=', $goal_id)
            ->execute();
    }

    // goalに紐づくtaskを全削除
    public static function delete_by_goal($goal_id)
    {
        return DB::delete('tasks')
            ->where('goal_id', '=', $goal_id)
            ->execute();
    }

    // goal内の完了task数を取得
    public static function count_by_goal_and_status($goal_id)
    {
        return DB::select(DB::expr('COUNT(*) as count'))
            ->from('tasks')
            ->where('goal_id', '=', $goal_id)
            ->where('is_done', '=', 1)
            ->execute()
            ->current();
    }
}