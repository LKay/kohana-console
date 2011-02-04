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
	
}