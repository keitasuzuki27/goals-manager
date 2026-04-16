<?php

class Controller_Dashboard extends Controller_Base
{

    // ユーザーIDと紐づいたgoals, tasksを取得
    public function action_index()
    {
        $user_id = Session::get('user_id');

        // Modelから取得
        $user = Model_User::find($user_id);
        $goals = Model_Goal::find_by_user($user_id);

        $selected_goal = null;

        // urlからgoal_idを受け取った場合は、$selected_goalを設定
        $goal_id = Input::get('id');

        if ($goal_id) {
            $selected_goal = Model_Goal::find_by_user_and_id($goal_id, $user_id);
        }

        // $selected_goal = nullの場合、最初のgoalを設定
        if (!$selected_goal && !empty($goals)) {
            $selected_goal = $goals[0];
        }

        // $selected_goalのidと紐付いたtasksを取得
        $tasks = [];

        if ($selected_goal) {
            $tasks = Model_Task::find_by_goal($selected_goal['id']);
        }

        return Response::forge(
            View::forge('dashboard/index', [
                'user' => $user,
                'goals' => $goals,
                'selected_goal' => $selected_goal,
                'tasks' => $tasks
            ], false)
        );
    }
}
