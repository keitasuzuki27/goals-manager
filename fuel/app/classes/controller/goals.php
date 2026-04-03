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
}