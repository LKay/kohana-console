<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * ChromePhp logging driver.
 *
 * @package    Console
 * @category   Logging
 * @author     Karol Janyst LKay
 * @copyright  (c) 2011 Karol Janyst LKay
 * @license    http://kohanaphp.com/license.html
 */
class Console_ChromePhp extends Console_Driver {
	
	// ChromePhp object
	protected $_chrome;
	
	/**
	 * Creates an instance of ChromePhp and stores it locally.
	 *
	 * @return  void
	 */
	public function __construct()
	{
		$this->_chrome = ChromePhp::getInstance();
	}

	/**
	 * Outputs log message to the console.
	 *
	 * @param  string  label
	 * @param  mixed  value
	 * @param  string  severity
	 * @return  void
	 */
	public function log()
	{
		call_user_func_array('Chromephp::log', func_get_args());
	}
	
	/**
	 * Outputs warning message to the console.
	 *
	 * @param  string  label
	 * @param  mixed  value
	 * @return  void
	 */
    public function warn()
    {
		call_user_func_array('Chromephp::warn', func_get_args());
    }

    /**
	 * Outputs error message to the console
	 *
	 * @param  string  label
	 * @param  mixed  value
	 * @return  void
	 */
    public function error()
    {
		call_user_func_array('Chromephp::error', func_get_args());
    }

    /**
     * Opens and sends group log.
     *
     * @param  string  value
     * @param  bool  expanded
	 * @return  void
     */
    public function group_open()
    {
    	$args = func_get_args();
        $expanded = count($args) == 2 ? array_pop($args) : FALSE;
        
        if ($expanded === TRUE)
        {
			call_user_func_array('Chromephp::group', $args);
        }
        else
        {
			call_user_func_array('Chromephp::groupCollapsed', $args);        	
        }
    }

	/**
	 * Closes messages group.
	 *
	 * @param  string  value
	 * @return  void
	 */
    public function group_end()
    {
		call_user_func_array('Chromephp::groupEnd', func_get_args());
    }

}