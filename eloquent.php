<?php
/**
 * This file sets eloquent up using the WordPress installation database config.
 */
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

require_once( ABSPATH . 'wp-config.php' );

global $wpdb;
global $table_prefix;

define('DB_PREFIX', $table_prefix);

$db = new DB;

$db->addConnection([
	'driver'    => 'mysql',
	'host'      => DB_HOST,
	'database'  => DB_NAME,
	'username'  => DB_USER,
	'password'  =>DB_PASSWORD,
	'charset'   => DB_CHARSET ?: 'utf8mb4',
	'collation' => DB_COLLATE ?: 'utf8mb4_unicode_ci',
	'prefix'    => DB_PREFIX,
]);

// Set the event dispatcher used by Eloquent models.
$db->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods.
$db->setAsGlobal();

// Setup the Eloquent ORM.
$db->bootEloquent();