<?php

class Controller_Dashboard extends Controller
{
    public function action_index()
    {
        $goals = DB::select()
            ->from('goals')
            ->execute();

        $selected_goal = null;

        #urlのidを取得
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

        return Response::forge(
            View::forge('dashboard/index', [
                'goals' => $goals,
                'selected_goal' => $selected_goal,
            ], false)
        );
    }
}
