Console Logging Helper
======================

Console helper is a tool created for easy logging and debuging your application using build in 
browser console such as in Chrome and Firefox (with Firebug). It provides simple methods for 
printing out your messages and variables

Requirements
------------

You will need to setup your browser, but in most case you probably use it before when debuging
your apps in javascript.

* For Google Chrome you should get ChromePHP extension from [http://www.chromephp.com](http://www.chromephp.com "ChromePHP") first.
  Besides that no other configuration is needed. All you have to do is to enable ChromePHP on your domain by clicking on its icon.
* For Firefox you should have [Firebug](http://getfirebug.com "Firebug") addon installed and new FirePHP Companion from 
  [http://www.christophdorn.com/Tools/#FirePHP Companion LITE](http://www.christophdorn.com/Tools/#FirePHP Companion LITE "FirePHP Companion").
  This module was designed to be as simple as possible so default settings for FirePHP allow debuging from any domain,
  none secret keys are set and so. Of course you may modify the default settings. To do so, just take a look at files
  in `vendor/firephp` and change your configs. Remember to authorize the current domain in Console tab after generating
  authorize key in Companion (Insight tab) window.
  
Configuration
-------------

Configuration before using the helper is really simple. Just add the module in your `bootstrap.php`, no other configuration
is required. 

If you want to use console logger simply add a line

    Kohana::$log->attach(new Kohana_Log_Console);
    
somewhere in your `bootstrap.php` after enabling the module.

Constructor automatically detects your browser and loads appropriate driver for its logging. If your browser does not support 
console logging ie. extensions not installed or you are viewing the page from other browser, messages will simply be not displayed.

Usage
-----

For now Console Logging Helper supports only few message types and options. Hopefully that will increase in the future. Those are:

* Log message - simple output to console
* Error message - usually when something went wrong, using `Kohana_Log_Console` this will be displayed if the type is `Kohana::ERROR` (`'ERROR'`)
* Warning message - using `Kohana_Log_Console` this will be displayed if the type is `Kohana::ALERT` (`'ALERT'`) or `Kohana::WARN` (this was added and the value is `WARN`)
* Info message - currently supported only in Firefox's FirePHP, using `Kohana_Log_Console` this will be displayed if the type is `Kohana::INFO` (`'INFO'`).
  In Chrome console it will be displayed as regular log message.
* Grouped messages - use this if you want to group your messages. You can make the group collapsed (currently not forking for FirePHP with no reason :( )
  
Any other message type will be displayed just like log message.

Examples
--------

All logging methods are chainable, so you can easily operate using one console object.

	$console = Console::instance();
	
	// For log message
	$console->log('log message');
	
	// For warning message
	$console->warn('warning message');

	// For error message
	$console->error('error message');

	// For info message (only in FirePHP)
	$console->info('info message');
	
	// For grouped messages
	$console->group_open('group1')
		->log('log')
		->warn('warn')
		->error('error')
		->group_end('group1');
		
	// For collapsed group
	$console->group_open('group2', TRUE)
		->log('grouped log message')
		->warn('grouped warning')
		->error('grouped error message')
		->group_end('group2');
		
	// Regular logging will work as well and you
	// will get all messages in your browser's console 
	Kohana::$log->add(Kohana::ALERT, 'warning message');
	Kohana::$log->add(Kohana::WARN, 'warning message');
	Kohana::$log->add(Kohana::ERROR, 'error message');
	Kohana::$log->add(Kohana::INFO, 'info message');
	Kohana::$log->add(Kohana::DEBUG, 'some other type message');