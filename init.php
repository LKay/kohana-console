<?php defined('SYSPATH') OR die('No direct access allowed.');

Route::set('firephp-server', 'firephp-server')
	->defaults(array(
		'controller' => 'firephp',
		'action'     => 'server',
	));