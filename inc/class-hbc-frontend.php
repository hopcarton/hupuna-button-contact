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
			add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
		}

		/**
		 * Enqueue assets
		 */
		public function enqueue_assets()
		{
			
		}

		/**
		 * Render button
		 */
		public function render_button()
		{
			$opts = get_option('hupuna_button_contact_settings', []);

			$phone = $opts['phone'] ?? '';
			$phoneColor = $opts['phone_color'] ?? '#E6F0FF';

			$zalo = $opts['zalo'] ?? '';
			$zaloColor = $opts['zalo_color'] ?? '#FFE6E6';

			$telegram = $opts['telegram'] ?? '';
			$telegramColor = $opts['telegram_color'] ?? '#E6F6FF';

			$instagram = $opts['instagram'] ?? '';
			$instagramColor = $opts['instagram_color'] ?? '#FFF0E6';

			$youtube = $opts['youtube'] ?? '';
			$youtubeColor = $opts['youtube_color'] ?? '#FFECEC';

			$tiktok = $opts['tiktok'] ?? '';
			$tiktokColor = $opts['tiktok_color'] ?? '#F2F2F2';

			$fanpage = $opts['fanpage'] ?? '';
			$fanpageColor = $opts['fanpage_color'] ?? '#E7F0FF';

			$linkMessage = $opts['link_message'] ?? '';
			$linkMessageColor = $opts['link_message_color'] ?? '#E6FFFA';

			$viber = $opts['viber'] ?? '';
			$viberColor = $opts['viber_color'] ?? '#F2E9FF';

			$whatsapp = $opts['whatsapp'] ?? '';
			$whatsappColor = $opts['whatsapp_color'] ?? '#E9FFF1';

			$formColor = $opts['form_color'] ?? '#00b894';
			$cf7_form_id = $opts['cf7_form_id'] ?? 0;
			$position = $opts['position'] ?? 'bottom-left';


			if (
            empty($phone) && empty($zalo) && empty($telegram) &&
            empty($instagram) && empty($youtube) && empty($tiktok) &&
            empty($fanpage) && empty($linkMessage) && empty($viber) &&
            empty($whatsapp) && empty($cf7_form_id)
        	) return;

			$zaloLink = $zalo ? 'https://zalo.me/' . $zalo : '';

			include plugin_dir_path(__FILE__) . '../templates/frontend-page.php';
		}
	}
}
