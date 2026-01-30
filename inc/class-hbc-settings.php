<?php if ( !defined( 'ABSPATH' ) ) exit();

/**
 * HBC Settings Class
 */
if ( !class_exists( 'HBC_Settings', false ) ) {

	class HBC_Settings {
		
		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
			add_action( 'admin_init', array( $this, 'register_settings' ) );
		}

		/**
		 * Add admin menu
		 */
		public function add_admin_menu() {
			add_menu_page(
				'Button Contact',
				'Button Contact',
				'manage_options',
				'hupuna-button-contact',
				array( $this, 'settings_page_html' ),
				'dashicons-phone',
				90
			);
		}

		/**
		 * Register settings
		 */
		public function register_settings() {
			register_setting( 'hupuna_button_contact_group', 'hupuna_button_contact_settings' );

			// Intern: Add settings sections and fields here
		}

		/**
		 * Settings page HTML
		 */
		public function settings_page_html() {
			?>
			<div class="wrap">
				<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
				<form action="options.php" method="post">
					<?php
					settings_fields( 'hupuna_button_contact_group' );
					do_settings_sections( 'hupuna-button-contact' );
					submit_button();
					?>
				</form>
			</div>
			<?php
		}
	}
}
