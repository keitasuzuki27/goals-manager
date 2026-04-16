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

        // タイトルと期日のバリデーション
        $valid = $this->validate_title_and_deadline_or_redirect($title, $deadline, '/dashboard');
        if ($valid !== true) {
            return $valid;
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

        // goalの存在と所有チェック
        $goal_or_resp = $this->ensure_goal_belongs_to_user_or_redirect($goal_id, $user_id, 'dashboard');
        if ($goal_or_resp instanceof Response) {
            return $goal_or_resp;
        }

        // タイトルと期日のバリデーション
        $valid = $this->validate_title_and_deadline_or_redirect($title, $deadline, '/dashboard?id=' . $goal_id);
        if ($valid !== true) {
            return $valid;
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

        // goalの存在と所有チェック
        $goal_or_resp = $this->ensure_goal_belongs_to_user_or_redirect($goal_id, $user_id, 'dashboard');
        if ($goal_or_resp instanceof Response) {
            return $goal_or_resp;
        }

        // 関連するtasksを先に削除（外部キー対策）
        Model_Task::delete_by_goal($goal_id);

        // goal削除
        Model_Goal::delete($goal_id, $user_id);

        return Response::redirect('/dashboard');
    }
}
