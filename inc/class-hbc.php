<?php if ( !defined( 'ABSPATH' ) ) exit();

/**
 * HBC Core Class
 */
if ( !class_exists( 'HBC', false ) ) {

	class HBC {
		private static $instance = null;

		/**
		 * Get instance
		 */
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		private function __construct() {
			$this->includes();
			$this->init_hooks();
		}

		/**
		 * Includes
		 */
		private function includes() {
			require_once HUPUNA_BUTTON_CONTACT_PATH . 'inc/class-hbc-settings.php';
			require_once HUPUNA_BUTTON_CONTACT_PATH . 'inc/class-hbc-frontend.php';
		}

		/**
		 * Init hooks
		 */
		private function init_hooks() {
			if ( is_admin() ) {
				new HBC_Settings();
			}
			new HBC_Frontend();
		}
	}
}
