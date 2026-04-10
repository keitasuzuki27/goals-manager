<?php
return array(
	'_root_'  => 'welcome/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	'dashboard' => 'dashboard/index', // /dashboardでclasses/controllerのdashboard.phpのaction_index()を呼ぶ
	'register' => 'auth/register',	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);
