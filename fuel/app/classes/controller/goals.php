<?php
class Controller_Goals extends Controller_Base
{
    // goalsの新規作成（POST）
    public function post_create()
    {
        // フォームから値取得
        $title = Input::post('title');
        $deadline = Input::post('deadline');
        $user_id = Session::get('user_id');

        // バリデーション
        if ($title === '') {
            Session::set_flash('error', 'タイトルを入力してください。');
            return Response::redirect('/dashboard');
        }

        if (empty($deadline)) {
            Session::set_flash('error', '締切日を入力してください。');
            return Response::redirect('/dashboard');
        }

        // DBにinsertし、生成されたidを取得
        list($insert_id) = Model_Goal::create($user_id, $title, $deadline);

        // 作成したgoalを選択状態にしてリダイレクト
        return Response::redirect('/dashboard?id=' . $insert_id);
    }

    // goalsの更新（POST）
    public function post_update()
    {
        // フォームから値取得
        $goal_id = Input::post('goal_id');
        $title = Input::post('title');
        $deadline = Input::post('deadline');
        $user_id = Session::get('user_id');

        // 更新対象の存在チェック
        if (empty($goal_id)) {
            Session::set_flash('error', '更新対象の目標が見つかりませんでした。');
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

        // 更新処理
        Model_Goal::update($title, $deadline, $goal_id, $user_id);

        return Response::redirect('/dashboard?id=' . $goal_id);
    }

    // goalsの削除（POST）
    public function post_delete()
    {
        // フォームから値取得
        $goal_id = Input::post('goal_id');
        $user_id = Session::get('user_id');

        // 削除対象の存在チェック
        if (empty($goal_id)) {
            Session::set_flash('error', '削除対象の目標が見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

        // ログインしているユーザーのgoalか確認
        $goal = Model_Goal::find_by_user_and_id($goal_id, $user_id);

        if (!$goal) {
            Session::set_flash('error', '対象の目標が見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

        // 関連するtasksを先に削除（外部キー対策）
        Model_Task::delete_by_goal($goal_id);

        // goal削除
        Model_Goal::delete($goal_id, $user_id);

        return Response::redirect('/dashboard');
    }
}
