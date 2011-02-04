<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * FirePHP logging driver.
 *
 * @package    Console
 * @category   Logging
 * @author     Karol Janyst LKay
 * @copyright  (c) 2011 Karol Janyst LKay
 * @license    http://kohanaphp.com/license.html
 */
class Console_FirePHP extends Console_Driver {
	
	// FirePHP object
	protected $_fire;
	
	// Inspector object
	protected $_inspector;

	// Firebug console object
	protected $_console;
	
	/**
	 * Creates an instance of FirePHP and stores it locally.
	 *
	 * @return  void
	 */
	public function __construct()
	{
		$this->_fire = FirePHP::getInstance(TRUE);
		$this->_inspector = FirePHP::to('page');
		$this->_console = $this->_inspector->console();
	}
	
	/**
	 * Outputs log message to the console.
	 *
	 * @param  string  message
	 * @return  void
	 */
	public function log()
	{
		call_user_func_array(array($this->_console, 'log'), func_get_args());
	}

	/**
	 * Outputs warn message to the console.
	 *
	 * @param  string  message
	 * @return  void
	 */
	public function warn()
	{
		call_user_func_array(array($this->_console, 'warn'), func_get_args());
	}

	/**
	 * Outputs error message to the console.
	 *
	 * @param  string  message
	 * @return  void
	 */
	public function error()
	{
		call_user_func_array(array($this->_console, 'error'), func_get_args());
	}

	/**
	 * Outputs info message to the console.
	 *
	 * @param  string  message
	 * @return  void
	 */
	public function info()
	{
		call_user_func_array(array($this->_console, 'info'), func_get_args());
	}
	
    /**
     * Opens and sends group log.
     *
     * @param  string  name
     * @param  bool  collapsed
	 * @return  void
	 * @uses  Arr::get
     */
	
	// TODO: Collapsing does not work correctly -> FirePHP BUG? 
    public function group_open()
    {
    	$args = func_get_args();

    	$collapsed = FALSE;
    	
    	if (count($args) == 2)
    	{
    		$collapsed = (bool) array_pop($args);
    		list($args[0], $args[1], $args[2]) = array(arr::get($args, 0), arr::get($args, 0), arr::get($args, 1));
    	}
    	
    	if ($collapsed)
    	{
    		$this->_console->expand();
    	}
    	
        $group = call_user_func_array(array($this->_console, 'group'), $args);
        $group->open();
        $this->log(Arr::get($args, 0));
    }
    
	/**
	 * Closes messages group.
	 *
	 * @param  string  name
	 * @return  void
	 */
    public function group_end()
    {
    	$group = call_user_func_array(array($this->_console, 'group'), func_get_args());
		$group->close();
    }
	
}