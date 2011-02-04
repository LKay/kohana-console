<?php defined('SYSPATH') OR die('No direct access allowed.'); 
/**
 * Console log writer.
 *
 * @package    Kohana
 * @category   Logging
 * @author     Karol Janyst LKay
 * @copyright  (c) 2011 Karol Janyst LKay
 * @license    http://kohanaphp.com/license.html
 */
class Kohana_Log_Console extends Kohana_Log_Writer {
	
	/**
	 * @var  Console  instance of console logger
	 */
	protected $_console;
	
	/**
	 * Creates a new console logger.
	 * 
	 * @return  void
	 */
	public function __construct()
	{
		$this->_console = Console::instance();
	}
	
	/**
	 * Writes each of the messages to the console.
	 *
	 * @param   array   messages
	 * @return  void
	 */
	public function write(array $messages)
	{
		$browser = $this->_console->browser();
		
		if ($browser !== Console::OTHER)
		{
			// Write each message to firePHP
			foreach ($messages as $message)
			{
				$msg = $message['time'].' - '.$message['body'];
				switch ($message['type'])
				{
					case Kohana::ERROR :
						$this->_console->error($msg);	
						break;
					case Kohana::ALERT :
						$this->_console->warn($msg);	
						break;
					case Kohana::INFO :
						if ($browser === Console::CHROME)
						{
							$this->_console->log($msg);	
						}
						elseif ($browser === Console::FIREFOX)
						{
							$this->_console->info($msg);	
						}
						break;
					default :
						$this->_console->log($msg);	
				}
			}
		}
	}
}