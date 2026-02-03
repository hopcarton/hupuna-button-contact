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
			add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );
			add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_frontend_assets' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_assets' ] );

			if ( is_admin() ) {
				new HBC_Settings();
				add_filter( 'plugin_action_links_' . plugin_basename( HUPUNA_BUTTON_CONTACT_PATH . 'hupuna-button-contact.php' ), [ $this, 'add_settings_link' ] );
			}
			new HBC_Frontend();
		}

		/**
		 * Load text domain
		 */
		public function load_textdomain() {
			load_plugin_textdomain(
				'hupuna-button-contact',
				false,
				dirname( plugin_basename( HUPUNA_BUTTON_CONTACT_PATH . 'hupuna-button-contact.php' ) ) . '/languages'
			);
		}

		/**
		 * Add settings link in plugins page
		 */
		public function add_settings_link( $links ) {
			$settings_link = sprintf(
				'<a href="%s">%s</a>',
				admin_url( 'admin.php?page=hupuna-button-contact' ),
				esc_html__( 'Settings', 'hupuna-button-contact' )
			);
			array_unshift( $links, $settings_link );
			return $links;
		}

		/**
		 * Enqueue frontend assets
		 */
		public function enqueue_frontend_assets() {
			wp_enqueue_style( 'dashicons' );
			wp_enqueue_style(
				'hbc-frontend',
				HUPUNA_BUTTON_CONTACT_URL . 'assets/css/button-contact.css',
				[],
				HUPUNA_BUTTON_CONTACT_VERSION
			);

			// Inject dynamic colors
			$opts = get_option('hupuna_button_contact_settings', []);
			$form_color = $opts['form_color'] ?? '#0068ff'; 
			$custom_css = ":root { --primary-color: {$form_color}; }";
			wp_add_inline_style('hbc-frontend', $custom_css);

			wp_enqueue_script(
				'hbc-frontend',
				HUPUNA_BUTTON_CONTACT_URL . 'assets/js/button-contact.js',
				[], // Removed jQuery dependency
				HUPUNA_BUTTON_CONTACT_VERSION,
				true
			);
		}

		/**
		 * Enqueue admin assets
		 */
		public function enqueue_admin_assets( $hook ) {
			if ( $hook !== 'toplevel_page_hupuna-button-contact' ) {
				return;
			}

			wp_enqueue_style(
				'hbc-admin',
				HUPUNA_BUTTON_CONTACT_URL . 'assets/css/button-contact.css',
				[],
				HUPUNA_BUTTON_CONTACT_VERSION
			);
		}
	}
}
