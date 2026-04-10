<?php

class Controller_Dashboard extends Controller
{

    // beforeメソッドでログイン状態か確認
    public function before()
    {
        parent::before();

        if (!Session::get('user_id')) {
            Response::redirect('/login');
        }
    }

    public function action_index()
    {
        $goals = DB::select()
            ->from('goals')
            ->execute();

        $selected_goal = null;

        //urlからgoalのidを取得
        $goal_id = Input::get('id');

        if ($goal_id) {
            $selected_goal = DB::select()
                ->from('goals')
                ->where('id', '=', $goal_id)
                ->execute()
                ->current();
        }

        if (!$selected_goal && !empty($goals)) {
            $selected_goal = $goals[0];
        }

        //$selected_goalのidと紐付いたtasksを取得
        $tasks = [];

        if ($selected_goal) {
            $tasks = DB::select()
                ->from('tasks')
                ->where('goal_id', '=', $selected_goal['id'])
                ->where('deleted_at', 'IS', null)
                ->execute();
        }

        return Response::forge(
            View::forge('dashboard/index', [
                'goals' => $goals,
                'selected_goal' => $selected_goal,
                'tasks' => $tasks
            ], false)
        );
    }
}
