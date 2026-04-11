<?php
class Controller_Goals extends Controller_Base
{
    // goalsのcreate
    public function post_create()
    {
        $title = Input::post('title');
        $deadline = Input::post('deadline');
        $user_id = Session::get('user_id');

        if ($title === '') {
            Session::set_flash('error', 'タイトルを入力してください。');
            return Response::redirect('/dashboard');
        }

        if (empty($deadline)) {
            Session::set_flash('error', '締切日を入力してください。');
            return Response::redirect('/dashboard');
        }

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
        $user_id = Session::get('user_id');

        if (empty($goal_id)) {
            Session::set_flash('error', '更新対象の目標が見つかりませんでした。');
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

        DB::update('goals')->set([
            'title' => $title,
            'deadline' => $deadline,
        ])
            ->where('id', '=', $goal_id)
            ->where('user_id', '=', $user_id)
            ->execute();

        return Response::redirect('/dashboard?id=' . $goal_id);
    }

    // goalsのdelete
    public function post_delete()
    {
        $goal_id = Input::post('goal_id');
        $user_id = Session::get('user_id');

        if (empty($goal_id)) {
            Session::set_flash('error', '削除対象の目標が見つかりませんでした。');
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

        // tasksを先に消去
        DB::delete('tasks')
            ->where('goal_id', '=', $goal_id)
            ->execute();

        DB::delete('goals')
            ->where('id', '=', $goal_id)
            ->where('user_id', '=', $user_id)
            ->execute();

        return Response::redirect('/dashboard');
    }
}
