<?php
class Controller_Goals extends Controller_Base
{
    // goalsのcreate
    public function post_create()
    {
        $title = Input::post('title');
        $deadline = Input::post('deadline');
        $user_id = Input::post('user_id');

        list($insert_id) = DB::insert('goals')->set([
            'user_id' => $user_id,
            'title' => $title,
            'deadline' => $deadline,
        ])->execute();

        return Response::redirect('/dashboard?id=' . $insert_id);
    }

    // goalsのupdate
    public function post_update()
    {
        $goal_id = Input::post('goal_id');
        $title = Input::post('title');
        $deadline = Input::post('deadline');

        DB::update('goals')->set([
            'title' => $title,
            'deadline' => $deadline,
        ])
            ->where('id', '=', $goal_id)
            ->execute();

        return Response::redirect('/dashboard?id=' . $goal_id);
    }

    // goalsのdelete
    public function post_delete()
    {
        $goal_id = Input::post('goal_id');

        // tasksを先に消去
        DB::delete('tasks')
            ->where('goal_id', '=', $goal_id)
            ->execute();

        DB::delete('goals')
            ->where('id', '=', $goal_id)
            ->execute();

        return Response::redirect('/dashboard');
    }
}
