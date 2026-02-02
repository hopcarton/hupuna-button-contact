<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function hbc_load_textdomain() {
    load_plugin_textdomain(
        'hupuna-button-contact',
        false,
        dirname( plugin_basename( HUPUNA_BUTTON_CONTACT_PATH . 'hupuna-button-contact.php' ) ) . '/languages'
    );
}

add_action( 'plugins_loaded', 'hbc_load_textdomain' );