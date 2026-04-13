<?php

class Controller_Tasks extends Controller_Base
{
    // tasksの新規作成（POST）
    public function post_create()
    {
        // フォームから値取得
        $goal_id = Input::post('goal_id');
        $title = Input::post('title');
        $deadline = Input::post('deadline');
        $user_id = Session::get('user_id');

        // バリデーション（goal存在チェック）
        if (empty($goal_id)) {
            Session::set_flash('error', '対象の目標が見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

        // バリデーション
        if ($title === '') {
            Session::set_flash('error', 'タイトルを入力してください。');
            return Response::redirect('/dashboard?id=' . $goal_id);
        }

        if (empty($deadline)) {
            Session::set_flash('error', '締切日を入力してください。');
            return Response::redirect('/dashboard?id=' . $goal_id);
        }

        // ログインしているユーザーのgoalか確認
        $goal = Model_Goal::find_by_user_and_id($goal_id, $user_id);

        if (!$goal) {
            Session::set_flash('error', '対象の目標が見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

        // DBにinsert
        Model_Task::create($goal_id, $title, $deadline);

        return Response::redirect('/dashboard?id=' . $goal_id);
    }

    // tasksの更新（POST）
    public function post_update()
    {
        // フォームから値取得
        $goal_id = Input::post('goal_id');
        $task_id = Input::post('task_id');
        $title = Input::post('title');
        $deadline = Input::post('deadline');
        $user_id = Session::get('user_id');

        // 対象の存在チェック
        if (empty($goal_id)) {
            Session::set_flash('error', '更新対象の目標が見つかりませんでした。');
            return Response::redirect('/dashboard');
        }
        if (empty($task_id)) {
            Session::set_flash('error', '更新対象のタスクが見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

        // バリデーション
        if ($title === '') {
            Session::set_flash('error', 'タイトルを入力してください。');
            return Response::redirect('/dashboard?id=' . $goal_id);
        }

        if (empty($deadline)) {
            Session::set_flash('error', '締切日を入力してください。');
            return Response::redirect('/dashboard?id=' . $goal_id);
        }

        // ログインしているユーザーのgoalか確認
        $goal = Model_Goal::find_by_user_and_id($goal_id, $user_id);

        if (!$goal) {
            Session::set_flash('error', '対象の目標が見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

        // taskがそのgoalに属しているか確認
        $task = Model_Task::find_by_task_and_goal($task_id, $goal_id);

        if (!$task) {
            Session::set_flash('error', '対象のタスクが見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

        // 更新処理
        Model_Task::update($title, $deadline, $task_id, $goal_id);

        return Response::redirect('/dashboard?id=' . $goal_id);
    }

    // tasksの削除（POST）
    public function post_delete()
    {
        // フォームから値取得
        $goal_id = Input::post('goal_id');
        $task_id = Input::post('task_id');
        $user_id = Session::get('user_id');

        // 対象の存在チェック
        if (empty($goal_id)) {
            Session::set_flash('error', '削除対象の目標が見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

        if (empty($task_id)) {
            Session::set_flash('error', '削除対象のタスクが見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

        // ログインしているユーザーのgoalか確認
        $goal = Model_Goal::find_by_user_and_id($goal_id, $user_id);

        if (!$goal) {
            Session::set_flash('error', '対象の目標が見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

        // taskがそのgoalに属しているか確認
        $task = Model_Task::find_by_task_and_goal($task_id, $goal_id);

        if (!$task) {
            Session::set_flash('error', '対象のタスクが見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

        // 削除処理
        Model_Task::delete($task_id, $goal_id);

        return Response::redirect('/dashboard?id=' . $goal_id);
    }

    // tasksの完了/未完了の切り替え
    public function post_toggle()
    {
        // フォームから値取得
        $goal_id = Input::post('goal_id');
        $task_id = Input::post('task_id');
        $user_id = Session::get('user_id');

        // バリデーション（JSONで返す）
        if (empty($goal_id)) {
            return Response::forge(json_encode([
                'status' => 'error',
                'message' => '対象の目標が見つかりませんでした。'
            ]), 400, ['Content-Type' => 'application/json']);
        }

        if (empty($task_id)) {
            return Response::forge(json_encode([
                'status' => 'error',
                'message' => '対象のタスクが見つかりませんでした。'
            ]), 400, ['Content-Type' => 'application/json']);
        }

        // ログインしているユーザーのgoalか確認
        $goal = Model_Goal::find_by_user_and_id($goal_id, $user_id);

        if (!$goal) {
            return Response::forge(json_encode([
                'status' => 'error',
                'message' => '対象の目標が見つかりませんでした。'
            ]), 404, ['Content-Type' => 'application/json']);
        }

        // task存在確認
        $task = Model_Task::find_by_task_and_goal($task_id, $goal_id);

        if (!$task) {
            return Response::forge(json_encode([
                'status' => 'error',
                'message' => '対象のタスクが見つかりませんでした。'
            ]), 404, ['Content-Type' => 'application/json']);
        }

        // 完了状態を反転
        $new_status = $task['is_done'] ? 0 : 1;

        Model_Task::update_status($new_status, $task_id, $goal_id);

        // 完了済みタスク数を取得
        $done_count = Model_Task::count_by_goal_and_status($goal_id);

        $done = (int) $done_count['count'];

        // JSONレスポンスを返す
        return Response::forge(json_encode([
            'status' => 'success',
            'is_done' => $new_status,
            'done_count' => $done,
        ]), 200, ['Content-Type' => 'application/json']);
    }
}