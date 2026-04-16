<?php

class Controller_Base extends Controller
{
    // 認証が必要なControllerの共通処理
    // ログインしていない場合はログイン画面へリダイレクトする
    public function before()
    {
        parent::before();

        if (!Session::get('user_id')) {
            return Response::redirect('/login');
        }
    }

    //フラッシュしてリダイレクト
    protected function redirect_with_error($message, $url = '/dashboard')
    {
        Session::set_flash('error', $message);
        return Response::redirect($url);
    }

    // タイトルと締切のバリデーション（成功時は true、失敗時は Response を返す）
    protected function validate_title_and_deadline_or_redirect($title, $deadline, $redirect_url)
    {
        if ($title === '') {
            return $this->redirect_with_error('タイトルを入力してください。', $redirect_url);
        }

        if (empty($deadline)) {
            return $this->redirect_with_error('締切日を入力してください。', $redirect_url);
        }
        return true;
    }

    // goal の存在とユーザー所有チェック（成功時は goal を返す、失敗時は Response を返す）
    protected function ensure_goal_belongs_to_user_or_redirect($goal_id, $user_id, $redirect_url = '/dashboard')
    {
        // 更新対象の存在チェック
        if (empty($goal_id)) {
            return $this->redirect_with_error('対象の目標が見つかりませんでした。', $redirect_url);
        }

        // ログインしているユーザーのgoalか確認
        $goal = Model_Goal::find_by_user_and_id($goal_id, $user_id);
        if (!$goal) {
            return $this->redirect_with_error('対象の目標が見つかりませんでした。', $redirect_url);
        }
        return $goal;
    }

    // taskの存在とgoalに属しているかをチェック（成功時は task 、失敗時は Response を返す）
    protected function ensure_task_belongs_to_goal_or_redirect($task_id, $goal_id, $redirect_url = '/dashboard')
    {
        // 更新対象の存在チェック
        if (empty($task_id)) {
            return $this->redirect_with_error('対象のタスクが見つかりませんでした。', $redirect_url);
        }

        // taskがgoalに属しているかチェック
        $task = Model_Task::find_by_task_and_goal($task_id, $goal_id);
        if (!$task) {
            return $this->redirect_with_error('対象のタスクが見つかりませんでした。', $redirect_url);
        }
        return $task;
    }
}
