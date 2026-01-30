<?php
/**
 * Plugin Name:       Hupuna Button Contact
 * Plugin URI:        https://github.com/hopcarton/hupuna-button-contact
 * Description:       A professional contact button plugin for WordPress, including Hotline, Zalo, Telegram, and social media links.
 * Version:           1.0.0
 * Author:            Hupuna
 * Author URI:        https://hupuna.com/
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       hupuna-button-contact
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'HUPUNA_BUTTON_CONTACT_VERSION', '1.0.0' );
define( 'HUPUNA_BUTTON_CONTACT_PATH', plugin_dir_path( __FILE__ ) );
define( 'HUPUNA_BUTTON_CONTACT_URL', plugin_dir_url( __FILE__ ) );

require_once HUPUNA_BUTTON_CONTACT_PATH . 'inc/class-hbc.php';

function hupuna_button_contact_init() {
	HBC::get_instance();
}
add_action( 'plugins_loaded', 'hupuna_button_contact_init' );
