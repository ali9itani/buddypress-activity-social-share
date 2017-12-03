<?php

/**
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://wbcomdesigns.com
 * @since             1.0.0
 * @package           Buddypress_Share
 *
 * @wordpress-plugin
 * Plugin Name:       BuddyPress Activity Social Share
 * Plugin URI:        http://www.wbcomdesigns.com
 * Description:       This plugin will add an extended feature to the big name “BuddyPress” that will allow to share Activity “Post Updates” to the social sites.
 * Version:           1.0.5
 * Author:            Wbcom Designs<admin@wbcomdesigns.com>
 * Author URI:        http://www.wbcomdesigns.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       buddypress-share
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined('WPINC')) {
    die;
}
define( 'BP_SHARE', 'buddypress-share' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-buddypress-share-activator.php
 * @access public
 * @author   Wbcom Designs
 * @since    1.0.0
*/

function activate_buddypress_share() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-buddypress-share-activator.php';
    Buddypress_Share_Activator::activate();
}

register_activation_hook(__FILE__, 'activate_buddypress_share');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-buddypress-share.php';

/**
 * Adding setting link on plugin listing page
 */
add_filter('plugin_action_links_'.plugin_basename(__FILE__),'bp_activity_share_plugin_actions', 10, 2);

/**
 * @desc Adds the Settings link to the plugin activate/deactivate page
 */
function bp_activity_share_plugin_actions($links, $file) {
	$settings_link = '<a href="' . admin_url("admin.php?page=buddypress-share") . '">' . __('Settings', BP_SHARE ) . '</a>';
	array_unshift($links, $settings_link); // before other links
	return $links;
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function run_buddypress_share() {

    $plugin = new Buddypress_Share();
    $plugin->run();

}

/**
 * Check plugin requirement on plugins loaded
 * this plugin requires buddypress to be installed and active
 */
add_action('plugins_loaded', 'bpshare_plugin_init');
function bpshare_plugin_init() {
	$bp_active = in_array('buddypress/bp-loader.php', get_option('active_plugins'));
	if ( current_user_can('activate_plugins') && $bp_active !== true ) {
		add_action('admin_notices', 'bpshare_plugin_admin_notice');
	} else {
		run_buddypress_share();
	}
}

function bpshare_plugin_admin_notice() {
	$bpshare_plugin = __( 'BuddyPress Activity Social Share', BP_SHARE );
	$bp_plugin      = __( 'BuddyPress', BP_SHARE );

	echo '<div class="error"><p>' . sprintf(__('%1$s is ineffective now as it requires %2$s to be installed and active.', BP_SHARE), '<strong>' . esc_html($bpshare_plugin) . '</strong>', '<strong>' . esc_html($bp_plugin) . '</strong>') . '</p></div>';
	if (isset($_GET['activate'])) unset($_GET['activate']);
}
