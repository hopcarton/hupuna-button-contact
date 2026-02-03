<?php
if (!defined('ABSPATH'))
	exit;

class HBC_Settings
{
	public function __construct()
	{
		add_action('admin_menu', [$this, 'add_admin_menu']);
		add_action('admin_init', [$this, 'register_settings']);
	}

	/**
	 * Add admin menu
	 */
	public function add_admin_menu()
	{
		add_menu_page(
			'Button Contact',
			'Button Contact',
			'manage_options',
			'hupuna-button-contact',
			[$this, 'settings_page_html'],
			'dashicons-phone',
			90
		);
	}

	/**
	 * Register settings
	 */
	public function register_settings()
	{
		register_setting(
			'hupuna_button_contact_group',
			'hupuna_button_contact_settings',
			[
				'sanitize_callback' => [$this, 'sanitize_settings']
			]
		);
	}

	/**
	 * Register settings
	 */
	public function sanitize_settings($input)
	{
		$old 		  = get_option('hupuna_button_contact_settings', []);
		$output 	  = is_array($old) ? $old : [];

		$services = self::get_services();

		foreach ($services as $key => $config) {
			// URL/Phone Sanitization
			if (isset($input[$key])) {
				$val = trim($input[$key]);
				if ($val === '') {
					unset($output[$key]);
				} else {
					if ($config['type'] === 'phone') {
						$clean = preg_replace('/(?!^\+)[^\d]/', '', $val);
						if (!preg_match('/^\+?\d{9,15}$/', $clean)) {
							add_settings_error(
								'hupuna_button_contact_settings',
								'invalid_' . $key,
								sprintf(__('Invalid %s number', 'hupuna-button-contact'), $config['label'])
							);
						} else {
							$output[$key] = $clean;
						}
					} elseif ($config['type'] === 'email') {
						$output[$key] = sanitize_email($val);
					} else {
						$output[$key] = esc_url_raw($val);
					}
				}
			}

			// Color Sanitization
			$color_key = $key . '_color';
			if (isset($input[$color_key])) {
				$output[$color_key] = sanitize_hex_color($input[$color_key]) ?: $config['default_color'];
			}
		}

		// Settings fields
		// Hide on
		if (array_key_exists('hide_on', $input)) {
			$output['hide_on'] = is_array($input['hide_on'])
				? array_map('sanitize_key', $input['hide_on'])
				: [];
		}

		// Size scale
		if (isset($input['size_scale'])) {
			$scale = floatval(value: $input['size_scale']);

			if ($scale < 0.5 || $scale > 2) {
				add_settings_error(
					'hupuna_button_contact_settings',
					'invalid_size_scale',
					__('Size scale must be between 0.5 and 2', 'hupuna-button-contact')
				);
			} else {
				$output['size_scale'] = $scale;
			}
		}


		// Position
		if (isset($input['position'])) {
			$output['position'] = sanitize_text_field($input['position']);
		}


		// CF7 Color
		if (isset($input['form_color'])) {
			$output['form_color'] = sanitize_hex_color($input['form_color']) ?: '#00b894';
		}


		// CF7
		if (isset($input['cf7_form_id'])) {
			$form_id = absint($input['cf7_form_id']);
			if ($form_id && get_post_type($form_id) !== 'wpcf7_contact_form') {
				add_settings_error('hupuna_button_contact_settings', 'invalid_cf7', __('Invalid Contact Form selected', 'hupuna-button-contact'));
			} else {
				$output['cf7_form_id'] = $form_id;
			}
		}

		return $output;
	}


	/**
	 * Settings page HTML
	 */
	public function settings_page_html()
	{
		$opts = get_option('hupuna_button_contact_settings', []);
		// CF7 forms
		$cf7_forms = post_type_exists('wpcf7_contact_form')
			? get_posts([
				'post_type' => 'wpcf7_contact_form',
				'posts_per_page' => -1,
				'post_status' => 'publish',
				'suppress_filters' => true,
			])
			: [];

		// Active tab
		$active_tab = $_GET['tab'] ?? 'button';
		
		$services = self::get_services();

		include HUPUNA_BUTTON_CONTACT_PATH . 'templates/setting-page.php';
	}

	/**
	 * Get services configuration
	 */
	public static function get_services()
	{
		return [
			'zalo' => [
				'label' 		=> __('Zalo', 'hupuna-button-contact'),
				'placeholder' 	=> '+84987654321',
				'default_color' => '#4D70FF',
				'type'			=> 'phone',
			],
			'phone' => [
				'label' 		=> __('Phone', 'hupuna-button-contact'),
				'placeholder' 	=> '+84987654321',
				'default_color' => '#4caf50',
				'type'			=> 'phone',
			],
			'telegram' => [
				'label' 		=> __('Telegram', 'hupuna-button-contact'),
				'placeholder' 	=> 'Link Telegram',
				'default_color' => '#039be5',
				'type'			=> 'url',
			],
			'instagram' => [
				'label' 		=> __('Instagram', 'hupuna-button-contact'),
				'placeholder' 	=> 'Link Instagram',
				'default_color' => '#d71599',
				'type'			=> 'url',
			],
			'youtube' => [
				'label' 		=> __('YouTube', 'hupuna-button-contact'),
				'placeholder' 	=> 'Link YouTube',
				'default_color' => '#fe0101',
				'type'			=> 'url',
			],
			'tiktok' => [
				'label' 		=> __('TikTok', 'hupuna-button-contact'),
				'placeholder' 	=> 'Link TikTok',
				'default_color' => '#202020',
				'type'			=> 'url',
			],
			'fanpage' => [
				'label' 		=> __('Facebook', 'hupuna-button-contact'),
				'placeholder' 	=> 'Link Facebook',
				'default_color' => '#1877f2',
				'type'			=> 'url',
			],
			'messenger' => [
				'label' 		=> __('Messenger', 'hupuna-button-contact'),
				'placeholder' 	=> 'Link Messenger',
				'default_color' => '#0084ff',
				'type'			=> 'url',
			],
			'viber' => [
				'label' 		=> __('Viber', 'hupuna-button-contact'),
				'placeholder'	=> '+84987654321',
				'default_color' => '#6f3faa',
				'type'			=> 'phone',
			],
			'whatsapp' => [
				'label' 		=> __('WhatsApp', 'hupuna-button-contact'),
				'placeholder' 	=> '+84987654321',
				'default_color' => '#29a71a',
				'type'			=> 'phone',
			],
			'email' => [
				'label' 		=> __('Email', 'hupuna-button-contact'),
				'placeholder' 	=> 'example@gmail.com',
				'default_color' => '#d8d8d8',
				'type'			=> 'email',
			],
		];
	}
}
