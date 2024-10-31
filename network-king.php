<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://sabrinazeidan.com/
 * @since             1.0.0
 * @package           Network_King
 *
 * @wordpress-plugin
 * Plugin Name:       Network King
 * Plugin URI:        http://wordpress.org/plugins/network-king/
 * Description:       Adds detailed publishing statistics for each blog in your WordPress Multisite Network.
 * Version:           0.2
 * Author:            Sabrina Zeidan
 * Author URI:        http://sabrinazeidan.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       network-king
 * Domain Path:       /languages
 * Network: true
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '0.1.2' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-network-king-activator.php
 */
function activate_network_king() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-network-king-activator.php';
	Network_King_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-network-king-deactivator.php
 */
function deactivate_network_king() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-network-king-deactivator.php';
	Network_King_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_network_king' );
register_deactivation_hook( __FILE__, 'deactivate_network_king' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-network-king.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_network_king() {

	$plugin = new Network_King();
	$plugin->run();

}
run_network_king();
