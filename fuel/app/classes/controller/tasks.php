<?php
class Controller_Tasks extends Controller_Base
{
    // tasksのcreate
    public function post_create()
    {
        $goal_id = Input::post('goal_id');
        $title = Input::post('title');
        $deadline = Input::post('deadline');

        DB::insert('tasks')->set([
            'goal_id' => $goal_id,
            'title' => $title,
            'deadline' => $deadline,
        ])->execute();

        return Response::redirect('/dashboard?id=' . $goal_id);
    }

    // tasksのupdate
    public function post_update()
    {
        $goal_id = Input::post('goal_id');
        $task_id = Input::post('task_id');
        $title = Input::post('title');
        $deadline = Input::post('deadline');

        DB::update('tasks')->set([
            'title' => $title,
            'deadline' => $deadline,
        ])
            ->where('id', '=', $task_id)
            ->execute();

        return Response::redirect('/dashboard?id=' . $goal_id);
    }

    // tasksのdelete
    public function post_delete()
    {
        $goal_id = Input::post('goal_id');
        $task_id = Input::post('task_id');

        DB::delete('tasks')
            ->where('id', '=', $task_id)
            ->execute();

        return Response::redirect('/dashboard?id=' . $goal_id);
    }

    // tasksのis_doneをtoggle
    public function post_toggle()
    {
        $goal_id = Input::post('goal_id');
        $task_id = Input::post('task_id');

        $task = DB::select()
            ->from('tasks')
            ->where('id', '=', $task_id)
            ->execute()
            ->current();

        if ($task) {
            $new_status = $task['is_done'] ? 0 : 1;

            DB::update('tasks')
                ->set(['is_done' => $new_status])
                ->where('id', '=', $task_id)
                ->execute();
        }
        return Response::redirect('/dashboard?id=' . $goal_id);
    }
}
