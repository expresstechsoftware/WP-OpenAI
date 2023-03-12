<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://expresstechsoftwares.com
 * @since             1.0.0
 * @package           Connect_Ai_Discord
 *
 * @wordpress-plugin
 * Plugin Name:       Connect open Ai to discord
 * Plugin URI:        https://expresstechsoftwares.com
 * Description:       Connect Open AI to Discord
 * Version:           1.0.0
 * Author:            ExpressTech Softwares Solutions Pvt Ltd
 * Author URI:        https://expresstechsoftwares.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       connect-ai-discord
 * Domain Path:       /languages
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
define( 'CONNECT_AI_DISCORD_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-connect-ai-discord-activator.php
 */
function activate_connect_ai_discord() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-connect-ai-discord-activator.php';
	Connect_Ai_Discord_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-connect-ai-discord-deactivator.php
 */
function deactivate_connect_ai_discord() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-connect-ai-discord-deactivator.php';
	Connect_Ai_Discord_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_connect_ai_discord' );
register_deactivation_hook( __FILE__, 'deactivate_connect_ai_discord' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-connect-ai-discord.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_connect_ai_discord() {

	$plugin = new Connect_Ai_Discord();
	$plugin->run();

}
run_connect_ai_discord();
