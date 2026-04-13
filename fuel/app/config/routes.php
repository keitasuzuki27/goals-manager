<?php
return array(
	'_root_'  => 'dashboard/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	'dashboard' => 'dashboard/index', // /ダッシュボード画面
	'register' => 'auth/register', // 新規登録画面
	'login' => 'auth/login', // ログイン画面
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);
