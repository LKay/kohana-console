<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Console logging helper.
 *
 * @package    Console
 * @category   Logging
 * @author     Karol Janyst LKay
 * @copyright  (c) 2011 Karol Janyst LKay
 * @license    http://kohanaphp.com/license.html
 */
class Console {
	
	// Browsers
	const OTHER   = 0;
	const CHROME  = 1;
	const FIREFOX = 2;
	
	/**
	 * @var  Console  instance of console
	 */
	protected static $_instance;

	/**
	 * @var  int  detected browser
	 */
	protected $_browser;

	// Appropriate logger
	protected $_logger = NULL;
	
	/**
	 * Get a singleton Console instance. 
	 *
	 *     // Get the instance
	 *     $console = Console::instance();
	 *
	 * @return  Console
	 */
	public static function instance()
	{
		if ( ! (static::$_instance instanceof static))
		{
			static::$_instance = new static();
		}
		return static::$_instance;
	}
	
	/**
	 * Stores the database configuration locally and name the instance.
	 *
	 * [!!] This method cannot be accessed directly, you must use [Console::instance].
	 *
	 * @return  void
	 * @uses    UTF8::strtolower
	 * @uses    UTF8::strpos
	 */
	protected function __construct()
	{
		$driver = NULL;
		$user_agent = UTF8::strtolower(getenv('HTTP_USER_AGENT'));
		if (UTF8::strpos($user_agent, 'chrom') !== FALSE)
		{
			$this->_browser = self::CHROME;
			$driver = 'Console_ChromePhp';
			if ( ! class_exists('ChromePhp', FALSE))
			{
				// Load ChromePhp
				require_once Kohana::find_file('vendor', 'chromephp/ChromePhp');
			}
			define('MSG_LOG',       'log');
			define('MSG_ERROR',     'error');
			define('MSG_WARN',      'warn');
			define('MSG_DEBUG',     NULL);
			define('MSG_INFO',      NULL);
			define('MSG_GROUP',     'group');
			define('MSG_GROUP_END', 'groupEnd');
		}
		elseif (UTF8::strpos($user_agent, 'firefox') !== FALSE)
		{
			$this->_browser = self::FIREFOX;			
			$driver = 'Console_FirePHP';
			if ( ! class_exists('FirePHP', FALSE))
			{
				// Load FirePHP
				require_once Kohana::find_file('vendor', 'firephp/_init_');
			}
			define('MSG_LOG',       'LOG');
			define('MSG_ERROR',     'ERROR');
			define('MSG_WARN',      'WARN');
			define('MSG_DEBUG',     NULL);
			define('MSG_INFO',      'INFO');
			define('MSG_GROUP',     'GROUP_START');
			define('MSG_GROUP_END', 'GROUP_END');
		}
		else
		{
			$this->_browser = self::OTHER;						
		}
		
		$this->_logger = $driver ? new $driver : NULL;
	}

	/**
	 * Destroying the object
	 *
	 * @return  void
	 */
	final public function __destruct() {} 

	/**
	 * Prevents from cloning the object
	 *
	 * @return  void
	 */
	final public function __clone() {} 
	
	/**
	 * Returns browser id
	 *
	 * @return  int
	 */
	public function browser()
	{
		return $this->_browser;
	} 
	
	/**
	 * Forwards call to logger.
	 * 
	 * @param  string  method  Method name
	 * @param  array  args  Method arguments
	 * @return  Console
	 */
	public function __call($method, array $args)
	{
		if ($this->_browser() !== static::OTHER)
		{
			call_user_func_array(array($this->_logger, $method), $args);
		}
		return $this;
	}
	
}