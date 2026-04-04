<?php
class Controller_Goals extends Controller
{
    public function action_create()
    {
        $title = Input::post('title');
        $deadline = Input::post('deadline');

        # DBクラス
        DB::insert('goals')->set([
            'user_id' => 1,
            'title' => $title,
            'deadline' => $deadline,
        ])->execute();

        return Response::redirect('dashboard/index');
    }

    public function action_update()
    {
        $id = Input::post('id');
        $title = Input::post('title');
        $deadline = Input::post('deadline');

        DB::update('goals')->set([
            'title' => $title,
            'deadline' => $deadline,
        ])
        ->where('id' , '=', $id)
        ->execute();

        return Response::redirect('dashboard/index');
    }

    public function action_delete()
    {
        $id = Input::post('id');

        DB::delete('goals')
        ->where('id' , '=', $id)
        ->execute();

        return Response::redirect('dashboard/index');
    }
}