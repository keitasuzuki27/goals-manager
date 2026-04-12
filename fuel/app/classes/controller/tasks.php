<?php
class Controller_Tasks extends Controller_Base
{
    // tasksのcreate
    public function post_create()
    {
        $goal_id = Input::post('goal_id');
        $title = Input::post('title');
        $deadline = Input::post('deadline');
        $user_id = Session::get('user_id');

        if (empty($goal_id)) {
            Session::set_flash('error', '対象の目標が見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

        if ($title === '') {
            Session::set_flash('error', 'タイトルを入力してください。');
            return Response::redirect('/dashboard?id=' . $goal_id);
        }

        if (empty($deadline)) {
            Session::set_flash('error', '締切日を入力してください。');
            return Response::redirect('/dashboard?id=' . $goal_id);
        }

        $goal = DB::select()
            ->from('goals')
            ->where('id', '=', $goal_id)
            ->where('user_id', '=', $user_id)
            ->execute()
            ->current();

        if (!$goal) {
            Session::set_flash('error', '対象の目標が見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

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
        $user_id = Session::get('user_id');

        if (empty($goal_id)) {
            Session::set_flash('error', '更新対象の目標が見つかりませんでした。');
            return Response::redirect('/dashboard');
        }
        if (empty($task_id)) {
            Session::set_flash('error', '更新対象のタスクが見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

        if ($title === '') {
            Session::set_flash('error', 'タイトルを入力してください。');
            return Response::redirect('/dashboard?id=' . $goal_id);
        }

        if (empty($deadline)) {
            Session::set_flash('error', '締切日を入力してください。');
            return Response::redirect('/dashboard?id=' . $goal_id);
        }

        $goal = DB::select()
            ->from('goals')
            ->where('id', '=', $goal_id)
            ->where('user_id', '=', $user_id)
            ->execute()
            ->current();

        if (!$goal) {
            Session::set_flash('error', '対象の目標が見つかりませんでした。');
            return Response::redirect('/dashboard');
        }


        $task = DB::select()
            ->from('tasks')
            ->where('id', '=', $task_id)
            ->where('goal_id', '=', $goal_id)
            ->execute()
            ->current();

        if (!$task) {
            Session::set_flash('error', '対象のタスクが見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

        DB::update('tasks')->set([
            'title' => $title,
            'deadline' => $deadline,
        ])
            ->where('id', '=', $task_id)
            ->where('goal_id', '=', $goal_id)
            ->execute();

        return Response::redirect('/dashboard?id=' . $goal_id);
    }

    // tasksのdelete
    public function post_delete()
    {
        $goal_id = Input::post('goal_id');
        $task_id = Input::post('task_id');
        $user_id = Session::get('user_id');

        if (empty($goal_id)) {
            Session::set_flash('error', '削除対象の目標が見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

        if (empty($task_id)) {
            Session::set_flash('error', '削除対象のタスクが見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

        $goal = DB::select()
            ->from('goals')
            ->where('id', '=', $goal_id)
            ->where('user_id', '=', $user_id)
            ->execute()
            ->current();

        if (!$goal) {
            Session::set_flash('error', '対象の目標が見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

        $task = DB::select()
            ->from('tasks')
            ->where('id', '=', $task_id)
            ->where('goal_id', '=', $goal_id)
            ->execute()
            ->current();

        if (!$task) {
            Session::set_flash('error', '対象のタスクが見つかりませんでした。');
            return Response::redirect('/dashboard');
        }

        DB::delete('tasks')
            ->where('id', '=', $task_id)
            ->where('goal_id', '=', $goal_id)
            ->execute();

        return Response::redirect('/dashboard?id=' . $goal_id);
    }

    // tasksのis_doneをtoggle
    // public function post_toggle()
    // {
    //     $goal_id = Input::post('goal_id');
    //     $task_id = Input::post('task_id');
    //     $user_id = Session::get('user_id');

    //     if (empty($goal_id)) {
    //         Session::set_flash('error', '対象の目標が見つかりませんでした。');
    //         return Response::redirect('/dashboard');
    //     }

    //     if (empty($task_id)) {
    //         Session::set_flash('error', '対象のタスクが見つかりませんでした。');
    //         return Response::redirect('/dashboard');
    //     }

    //     $goal = DB::select()
    //         ->from('goals')
    //         ->where('id', '=', $goal_id)
    //         ->where('user_id', '=', $user_id)
    //         ->execute()
    //         ->current();

    //     if (!$goal) {
    //         Session::set_flash('error', '対象の目標が見つかりませんでした。');
    //         return Response::redirect('/dashboard');
    //     }

    //     $task = DB::select()
    //         ->from('tasks')
    //         ->where('id', '=', $task_id)
    //         ->where('goal_id', '=', $goal_id)
    //         ->execute()
    //         ->current();

    //     if (!$task) {
    //         Session::set_flash('error', '対象のタスクが見つかりませんでした。');
    //         return Response::redirect('/dashboard');
    //     }

    //     // toggle処理
    //     $new_status = $task['is_done'] ? 0 : 1;

    //     DB::update('tasks')
    //         ->set(['is_done' => $new_status])
    //         ->where('id', '=', $task_id)
    //         ->where('goal_id', '=', $goal_id)
    //         ->execute();

    //     return $this->response([
    //         'status' => 'success',
    //         'is_done' => $new_status
    //     ]);

    //     // return Response::redirect('/dashboard?id=' . $goal_id);
    // }

    public function post_toggle()
    {
        $goal_id = Input::post('goal_id');
        $task_id = Input::post('task_id');
        $user_id = Session::get('user_id');

        if (empty($goal_id)) {
            return Response::forge(
                json_encode([
                    'status' => 'error',
                    'message' => '対象の目標が見つかりませんでした。'
                ]),
                400,
                ['Content-Type' => 'application/json']
            );
        }

        if (empty($task_id)) {
            return Response::forge(
                json_encode([
                    'status' => 'error',
                    'message' => '対象のタスクが見つかりませんでした。'
                ]),
                400,
                ['Content-Type' => 'application/json']
            );
        }

        $goal = DB::select()
            ->from('goals')
            ->where('id', '=', $goal_id)
            ->where('user_id', '=', $user_id)
            ->execute()
            ->current();

        if (!$goal) {
            return Response::forge(
                json_encode([
                    'status' => 'error',
                    'message' => '対象の目標が見つかりませんでした。'
                ]),
                404,
                ['Content-Type' => 'application/json']
            );
        }

        $task = DB::select()
            ->from('tasks')
            ->where('id', '=', $task_id)
            ->where('goal_id', '=', $goal_id)
            ->execute()
            ->current();

        if (!$task) {
            return Response::forge(
                json_encode([
                    'status' => 'error',
                    'message' => '対象のタスクが見つかりませんでした。'
                ]),
                404,
                ['Content-Type' => 'application/json']
            );
        }

        $new_status = $task['is_done'] ? 0 : 1;

        DB::update('tasks')
            ->set(['is_done' => $new_status])
            ->where('id', '=', $task_id)
            ->where('goal_id', '=', $goal_id)
            ->execute();

        // is_doneがtrueのtasksの合計を数える
        $done_count = DB::select(DB::expr('COUNT(*) as count'))
            ->from('tasks')
            ->where('goal_id', '=', $goal_id)
            ->where('is_done', '=', 1)
            ->execute()
            ->current();

        $done = (int) $done_count['count'];


        return Response::forge(
            json_encode([
                'status' => 'success',
                'is_done' => $new_status,
                'done_count' => $done,
            ]),
            200,
            ['Content-Type' => 'application/json']
        );
    }
}
