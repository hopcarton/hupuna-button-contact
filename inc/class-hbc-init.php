<?php
if (!defined('ABSPATH')) {
    exit;
}

function hbc_load_textdomain()
{
    load_plugin_textdomain(
        'hupuna-button-contact',
        false,
        dirname(plugin_basename(HUPUNA_BUTTON_CONTACT_PATH . 'hupuna-button-contact.php')) . '/languages'
    );
    add_filter(
        'plugin_action_links_' . plugin_basename(HUPUNA_BUTTON_CONTACT_PATH . 'hupuna-button-contact.php'),
        'hbc_add_settings_link'
    );
}

// Add settings link in plugins page
function hbc_add_settings_link($links)
{
    return array_merge([
        '<a href="admin.php?page=hupuna-button-contact">' .
        esc_html__('Settings', 'hupuna-button-contact') .
        '</a>'
    ], $links);
}


// Load common assets js and css for both admin and frontend
function hbc_enqueue_common_assets($hook = null)
{

    // if admin page but not our settings page, return
    if (is_admin() && $hook !== 'toplevel_page_hupuna-button-contact') {
        return;
    }

    wp_enqueue_style(
        'hbc-common',
        HUPUNA_BUTTON_CONTACT_URL . 'assets/css/button-contact.css',
        [],
        HUPUNA_BUTTON_CONTACT_VERSION
    );

    wp_enqueue_script(
        'hbc-common',
        HUPUNA_BUTTON_CONTACT_URL . 'assets/js/button-contact.js',
        ['jquery'],
        HUPUNA_BUTTON_CONTACT_VERSION,
        true
    );
}

add_action('plugins_loaded', 'hbc_load_textdomain');
add_action('wp_enqueue_scripts', 'hbc_enqueue_common_assets');