<?php

class Controller_Dashboard extends Controller
{
    public function action_index()
    {
        $goals = DB::select()
            ->from('goals')
            ->execute();

        return Response::forge(
            View::forge('dashboard/index', [
                'goals' => $goals
            ])
            );
    }
}