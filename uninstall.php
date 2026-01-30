<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following:
 *
 * - This file should be as self-contained as possible.
 * - This file should not call any functions from the plugin or theme.
 * - This file should only contain code that runs when the plugin is uninstalled.
 *
 * @link       https://hupuna.com/
 * @package    Hupuna_Button_Contact
 */

// If uninstall not called from WordPress, die.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/**
 * Cleanup logic for the intern:
 * 1. Delete options from the database.
 * 2. Delete any custom tables if they exist.
 * 3. Delete any other plugin-specific data.
 */

// Example: Delete the main settings option
delete_option( 'hupuna_button_contact_settings' );
// delete_site_option( 'hupuna_button_contact_settings' ); // For multisite
