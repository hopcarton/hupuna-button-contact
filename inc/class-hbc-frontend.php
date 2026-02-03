<?php if (!defined('ABSPATH'))
	exit();

/**
 * HBC Frontend Class
 */
if (!class_exists('HBC_Frontend', false)) {

	class HBC_Frontend
	{

		/**
		 * Constructor
		 */
		public function __construct()
		{
			add_action('wp_footer', array($this, 'render_button'));
		}

		/**
		 * Render button
		 */
		public function render_button()
		{
			$opts 			  = get_option('hupuna_button_contact_settings', []);
			$services 		  = HBC_Settings::get_services();
			
			$formColor 	      = $opts['form_color'] ?? '#00b894';
			$cf7_form_id 	  = $opts['cf7_form_id'] ?? 0;
			$position 	      = $opts['position'] ?? 'bottom-left';
			$sizeScale 	      = isset($opts['size_scale']) ? floatval($opts['size_scale']) : 1;
			$hide_on 	      = $opts['hide_on'] ?? [];

			$contact_button_type = 'text';
			$contact_button_text = $opts['contact_button_text'] ?? __('CONTACT', 'hupuna-button-contact');
			$form_template       = $opts['form_template'] ?? 'default';

			// Template data
			$tpl_data = [
				'logo'        => $opts['form_logo'] ?? '',
				'heading'     => $opts['form_heading'] ?? '',
				'subheading'  => $opts['form_subheading'] ?? '',
				'description' => $opts['form_description'] ?? '',
			];

			$buttons = [];
			$has_active_btn = false;

			foreach ($services as $key => $config) {
				$val = $opts[$key] ?? '';
				if (empty($val)) continue;

				$has_active_btn = true;
				$color = $opts[$key . '_color'] ?? $config['default_color'];
				$href = $val;
				$target = true;

				switch ($key) {
					case 'phone':
						$href = 'tel:' . $val;
						$target = false;
						break;
					case 'zalo':
						$href = 'https://zalo.me/' . $val;
						break;
					case 'viber':
						$href = 'viber://chat?number=' . $val;
						break;
					case 'whatsapp':
						$href = 'https://wa.me/' . $val;
						break;
					case 'email':
						$href = 'mailto:' . $val;
						$target = false;
						break;
				}

				$buttons[$key] = [
					'show'  => true,
					'href'  => $href,
					'class' => 'hbc-' . str_replace('_', '-', $key) . '-btn',
					'color' => $color,
					'target'=> $target,
				];
			}

			if (!$has_active_btn && empty($cf7_form_id)) return;

			$hide_class = '';
			if (in_array('desktop', $hide_on)) $hide_class .= ' hbc-hide-desktop';
			if (in_array('tablet', $hide_on))  $hide_class .= ' hbc-hide-tablet';
			if (in_array('mobile', $hide_on))  $hide_class .= ' hbc-hide-mobile';

			include HUPUNA_BUTTON_CONTACT_PATH . 'templates/frontend-page.php';
		}
	}
}
