<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/Kohana/Core'.EXT;

if (is_file(APPPATH.'classes/Kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/Kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/Kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/timezones
 */
date_default_timezone_set('Asia/Shanghai');

/**
 * Set the default locale.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/function.setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @link http://kohanaframework.org/guide/using.autoloading
 * @link http://www.php.net/manual/function.spl-autoload-register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Optionally, you can enable a compatibility auto-loader for use with
 * older modules that have not been updated for PSR-0.
 *
 * It is recommended to not enable this unless absolutely necessary.
 */
//spl_autoload_register(array('Kohana', 'auto_load_lowercase'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @link http://www.php.net/manual/function.spl-autoload-call
 * @link http://www.php.net/manual/var.configuration#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

/**
 * Set the mb_substitute_character to "none"
 *
 * @link http://www.php.net/manual/function.mb-substitute-character.php
 */
mb_substitute_character('none');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('en-us');

if (isset($_SERVER['SERVER_PROTOCOL']))
{
	// Replace the default protocol.
	HTTP::$protocol = $_SERVER['SERVER_PROTOCOL'];
}

/**
 * Set the environment status by the domain.
 */
if (strpos($_SERVER['HTTP_HOST'], '99scholars.net') !== FALSE)
{
    $_SERVER['KOHANA_ENV'] = 'production';
 
    // Turn off notices and strict errors
    error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
}
else
{
	$_SERVER['KOHANA_ENV'] = 'development';
}

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV']))
{
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - integer  cache_life  lifetime, in seconds, of items cached              60
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 * - boolean  expose      set the X-Powered-By header                        FALSE
 */
Kohana::init(array(
	'base_url' => '/99scholars/',
	'index_file' => FALSE,
	'kopauth'=>'/',
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
// Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
// Kohana::$config->attach();
Kohana::$config->attach(new Config_File);
Kohana::$config->attach(new Config_File('config/'.$_SERVER['KOHANA_ENV']));
// echo DEBUG::vars(new Config_File('config/'.$_SERVER['KOHANA_ENV']));exit;
/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	'auth'       => MODPATH.'auth',       // Basic authentication
	// 'cache'      => MODPATH.'cache',      // Caching with multiple backends
	// 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
	 'database'   => MODPATH.'database',   // Database access
	// 'image'      => MODPATH.'image',      // Image manipulation
	// 'minion'     => MODPATH.'minion',     // CLI Tasks
	 'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	// 'unittest'   => MODPATH.'unittest',   // Unit testing
	// 'userguide'  => MODPATH.'userguide',  // User guide and API documentation
	'pagination' => MODPATH.'pagination', // Paging of results
	'kopauth'	=> MODPATH.'kopauth',
	'crud'  => MODPATH.'crud',
	// 'firephp'	=> MODPATH.'firephp',
	));

Cookie::$salt = 'foobar';
// echo DEBUG::vars(Kohana::$config);exit;
/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::set('create', 'new/<controller>')
	->filter(function($route, $params, $request)
	{
		if ($request->method() == HTTP_Request::POST)
		{
			$params['action'] = 'create';
			return $params;
		}
		else
		{
			// This route only matches POST requests
			return FALSE;
		}
	});
	
Route::set('opauth', 'oauth(/<action>(/<strategy>(/<callback>)))')
    ->defaults(array(
        'controller' => 'signup',
        'action'     => 'authenticate',
    ));

Route::set('default', '(<controller>(/<action>(/<id>)))')
    ->defaults(array(
            'controller' => 'home',
            'action'     => 'index',
    ));

Route::set('conference', '(<controller>(/<action>(/<id>(/<session>(/<session_id>)))))',
	array(
		'controller' => 'conference',
		'session' => 'session'
	))
	->defaults(array(
		'action'     => 'index',
	));

Route::set('actionstatistics' , '(<controller>(/<action>(/<page_num>(/<per_page>(/<action_filter>(/<user_filter>(/<start_date>)))))))')
	->defaults(
		array(
			'controller' => 'actionstatistics',
			'action' => 'index',
			'page_num' => '1',
			'per_page' => '20',
			'action_filter' => 'All',
	));
/*
Route::set('profile', '<id>' , array('id' => '.*'))
	->defaults(array(
		'controller' => 'profile',
		'action'     => 'index',
	));	
*/	


