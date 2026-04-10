<?php

use Fuel\Core\Response;

class Controller_Auth extends Controller 
{
    public function action_register()
    {
        return Response::forge(
            View::forge('auth/register')
        );
    }
}