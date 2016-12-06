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
 * Version:           1.0.0
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

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-buddypress-share-activator.php
 */
function activate_buddypress_share() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-buddypress-share-activator.php';
    Buddypress_Share_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-buddypress-share-deactivator.php
 */
function deactivate_buddypress_share() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-buddypress-share-deactivator.php';
    Buddypress_Share_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_buddypress_share');
register_deactivation_hook(__FILE__, 'deactivate_buddypress_share');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-buddypress-share.php';

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
run_buddypress_share();
