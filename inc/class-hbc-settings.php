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

		$phoneRaw 	  = trim($input['phone'] ?? '');
		$zaloRaw 	  = trim($input['zalo'] ?? '');
		$viberRaw 	  = trim($input['viber'] ?? '');
		$whatsappRaw  = trim($input['whatsapp'] ?? '');

		// Phone
		if (isset($input['phone'])) {
			$phoneRaw = trim($input['phone']);

			if ($phoneRaw !== '') {
				if (!preg_match('/^\+?\d{9,15}$/', $phoneRaw)) {
					add_settings_error(
						'hupuna_button_contact_settings',
						'invalid_phone',
						__('Invalid phone number', 'hupuna-button-contact')
					);
				} else {
					$output['phone'] = preg_replace('/[^\d]/', '', $phoneRaw);
				}
			} else {
				unset($output['phone']);
			}
		}

		// Zalo
		if (isset($input['zalo'])) {
			$zaloRaw = trim($input['zalo']);

			if ($zaloRaw !== '') {
				if (!preg_match('/^\+?\d{9,15}$/', $zaloRaw)) {
					add_settings_error('hupuna_button_contact_settings', 'invalid_zalo', __('Invalid Zalo number', 'hupuna-button-contact'));
				} else {
					$output['zalo'] = preg_replace('/[^\d]/', '', $zaloRaw);
				}
			} else {
				unset($output['zalo']);
			}
		}

		// Viber
		if (isset($input['viber'])) {
			$viberRaw = trim($input['viber']);

			if ($viberRaw !== '') {
				if (!preg_match('/^\+?\d{9,15}$/', $viberRaw)) {
					add_settings_error('hupuna_button_contact_settings', 'invalid_viber', __('Invalid Viber number', 'hupuna-button-contact'));
				} else {
					$output['viber'] = preg_replace('/[^\d]/', '', $viberRaw);
				}
			} else {
				unset($output['viber']);
			}
		}

		// Whatsapp
		if (isset($input['whatsapp'])) {
			$whatsappRaw = trim($input['whatsapp']);

			if ($whatsappRaw !== '') {
				if (!preg_match('/^\+?\d{9,15}$/', $whatsappRaw)) {
					add_settings_error('hupuna_button_contact_settings', 'invalid_whatsapp', __('Invalid Whatsapp number', 'hupuna-button-contact'));
				} else {
					$output['whatsapp'] = preg_replace('/[^\d]/', '', $whatsappRaw);
				}
			} else {
				unset($output['whatsapp']);
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

		// Colors
		$color_fields = [
			'phone_color' 		 => '#00B840',
			'zalo_color' 		 => '#4D70FF',
			'viber_color' 		 => '#CE48FE',
			'whatsapp_color'	 => '#D7FED7',
			'telegram_color'	 => '#E6F6FF',
			'instagram_color' 	 => '#FFADC5',
			'youtube_color'	 	 => '#FF4242',
			'tiktok_color' 		 => '#202020',
			'fanpage_color' 	 => '#1877F2',
			'link_message_color' => '#D7FED7',
			'form_color' 		 => '#00b894',
		];

		// Color fields
		foreach ($color_fields as $key => $default) {
			if (array_key_exists($key, $input)) {
				$output[$key] = sanitize_hex_color($input[$key]) ?: $default;
			}
		}

		// URL fields
		$url_fields = ['telegram', 'instagram', 'youtube', 'tiktok', 'fanpage', 'link_message'];
		foreach ($url_fields as $key) {
			if (array_key_exists($key, $input)) {
				$val = trim($input[$key]);
				if ($val !== '') {
					$output[$key] = esc_url_raw($val);
				} else {
					unset($output[$key]);
				}
			}
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
		
		// Services
		$services = [
			'zalo' => [
				'label' 		=> __('Zalo', 'hupuna-button-contact'),
				'placeholder' 	=> '+84987654321',
				'default_color' => '#4D70FF',
			],
			'phone' => [
				'label' 		=> __('Phone', 'hupuna-button-contact'),
				'placeholder' 	=> '+84987654321',
				'default_color' => '#00B840',
			],
			'telegram' => [
				'label' 		=> __('Link Telegram', 'hupuna-button-contact'),
				'placeholder' 	=> 'Link Telegram',
				'default_color' => '#E6F6FF',
			],
			'instagram' => [
				'label' 		=> __('Link Instagram', 'hupuna-button-contact'),
				'placeholder' 	=> 'Link Instagram',
				'default_color' => '#FFADC5',
			],
			'youtube' => [
				'label' 		=> __('Link Youtube', 'hupuna-button-contact'),
				'placeholder' 	=> 'Link Youtube',
				'default_color' => '#FF4242',
			],
			'tiktok' => [
				'label' 		=> __('Link Tiktok', 'hupuna-button-contact'),
				'placeholder' 	=> 'Link Tiktok',
				'default_color' => '#202020',
			],
			'fanpage' => [
				'label' 		=> __('Link Fanpage', 'hupuna-button-contact'),
				'placeholder' 	=> 'Link Fanpage',
				'default_color' => '#1877F2',
			],
			'link_message' => [
				'label' 		=> __('Link Message', 'hupuna-button-contact'),
				'placeholder' 	=> 'Link Message',
				'default_color' => '#D7FED7',
			],
			'viber' => [
				'label' 		=> __('Viber', 'hupuna-button-contact'),
				'placeholder'	=> '+84987654321',
				'default_color' => '#CE48FE',
			],
			'whatsapp' => [
				'label' 		=> __('Whatsapp', 'hupuna-button-contact'),
				'placeholder' 	=> '+84987654321',
				'default_color' => '#D7FED7',
			],
		];

		include HUPUNA_BUTTON_CONTACT_PATH . 'templates/setting-page.php';
	}
}