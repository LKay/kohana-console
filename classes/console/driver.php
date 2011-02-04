<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Console logging driver.
 *
 * @package    Console
 * @category   Logging
 * @author     Karol Janyst LKay
 * @copyright  (c) 2011 Karol Janyst LKay
 * @license    http://kohanaphp.com/license.html
 */
abstract class Console_Driver {

	/**
	 * Outputs log message.
	 * 
	 * @return  void
	 */
	public function log() { }

	/**
	 * Outputs debug message.
	 * 
	 * @return  void
	 */
	public function debug() { }

	/**
	 * Outputs error message.
	 * 
	 * @return  void
	 */
	public function error() { }

	/**
	 * Outputs warning message.
	 * 
	 * @return  void
	 */
	public function warn() { }
	
	/**
	 * Outputs info message.
	 * 
	 * @return  void
	 */
	public function info() { }
	
	/**
	 * Opens messages group.
	 * 
	 * @return  void
	 */
	public function group_open() { }
	
	/**
	 * Closes messages group.
	 * 
	 * @return  void
	 */
	public function group_end() { }
	
	/**
	 * Handles any other call.
	 *
	 * @param  string  method  Method name
	 * @param  array  args  Method arguments
	 * @return  void
	 * @throws  Console_Exception
	 */
	public function __call($method, array $args)
	{
		throw new Console_Exception('Invalid method :method called in :class',
			array(':method' => $method, ':class' => get_class($this)));
	}
}