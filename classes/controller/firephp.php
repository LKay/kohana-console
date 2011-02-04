<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_FirePHP extends Controller {
	
	public function action_server()
	{
		require_once Kohana::find_file('vendor', 'firephp/_init_');
	}
	
}