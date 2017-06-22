<?php
/**
 * @package MWD Plugin
 * @version 0.1
 */
/*
Plugin Name: MWD Plugin
Description: A starter plugin with all the boilerplate done for Vuejs and some useful PHP libraries.
Author: Ross Cooper
Version: 0.1.0
Author URI: http://ross-cooper.co.uk
License:     GPL2
 
MWD Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
MWD Plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with MWD Plugin. If not, see https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html.
*/

//Require composer autoload file.

use MWDPlugin\Example;

require 'vendor/autoload.php';

global $mwd_db_version;
$mwd_db_version = '0.1.0';

add_action( 'admin_menu', 'mwd_register_menu_page' );

/**
 * Register a custom menu page.
 */
function mwd_register_menu_page() {
	add_menu_page(
		'MWD Plugin',
		'MWD Plugin',
		'manage_options',
		'mwd-plugin/admin.php',
		'',
		'dashicons-lightbulb',
		6
	);
}

register_activation_hook( __FILE__, 'mwd_install' );

/**
 *  Runs when the plugin is activated.
 *
 *  Creates the database tables and inserts some test data.
 */
function mwd_install() {
	global $wpdb;
	global $mwd_db_version;
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	//Note: we have to add the prefix on manually here.
	$example_table = DB_PREFIX . ( new Example() )->getTable();
	$wpdb_collate    = $wpdb->collate;
	//Create mwd_examples table
	$sql =
		"CREATE TABLE {$example_table} (
         id mediumint(8) unsigned NOT NULL auto_increment ,
         name varchar(255) NULL,
         created_at TIMESTAMP NULL,
         updated_at TIMESTAMP NULL,
         deleted_at TIMESTAMP NULL,
         PRIMARY KEY  (id)
         )
         COLLATE {$wpdb_collate};";
	dbDelta( $sql );
	//Insert some examples into the database.
	Example::create(['name' => 'Example 1']);
	Example::create(['name' => 'Example 2']);
	Example::create(['name' => 'Example 3']);
	//Useful for keeping track of database versions.
	add_option( "mwd_db_version", $mwd_db_version );
}

register_uninstall_hook( __FILE__, 'mwd_uninstall' );

/**
 *  Runs when the plugin is uninstalled.
 */
function mwd_uninstall() {
	global $wpdb;
    $example_table = DB_PREFIX . ( new Example() )->getTable();
	//Drop mwd_* tables
	$sql = "DROP TABLE IF EXISTS {$example_table};";
	$wpdb->query( $sql );
}

add_action( 'wp_enqueue_scripts', 'mwd_enqueue' );
add_action( 'admin_enqueue_scripts', 'mwd_enqueue' );

/**
 *  Enqueues and loads scripts on plugin admin page only.
 */
function mwd_enqueue($hook) {
    if ( 'mwd-plugin/admin.php' != $hook ) {
        return;
    }
	wp_enqueue_script( 'smartquestions', plugin_dir_url( __FILE__ ) . 'assets/js/build.js' );
	wp_enqueue_style( 'smartquestions', plugin_dir_url( __FILE__ ) . 'assets/css/app.css' );
}
