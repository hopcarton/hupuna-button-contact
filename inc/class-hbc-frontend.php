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
			$opts 			  = get_option('hupuna_button_contact_settings', []);

			$phone 			  = $opts['phone'] ?? '';
			$phoneColor 	  = $opts['phone_color'] ?? '#00B840';

			$zalo 			  = $opts['zalo'] ?? '';
			$zaloColor 		  = $opts['zalo_color'] ?? '#4D70FF';

			$telegram 		  = $opts['telegram'] ?? '';
			$telegramColor 	  = $opts['telegram_color'] ?? '#E6F6FF';

			$instagram 		  = $opts['instagram'] ?? '';
			$instagramColor   = $opts['instagram_color'] ?? '#FFADC5';

			$youtube 		  = $opts['youtube'] ?? '';
			$youtubeColor 	  = $opts['youtube_color'] ?? '#FF4242';

			$tiktok 		  = $opts['tiktok'] ?? '';
			$tiktokColor 	  = $opts['tiktok_color'] ?? '#202020';

			$fanpage 		  = $opts['fanpage'] ?? '';
			$fanpageColor 	  = $opts['fanpage_color'] ?? '#1877F2';

			$linkMessage 	  = $opts['link_message'] ?? '';
			$linkMessageColor = $opts['link_message_color'] ?? '#D7FED7';

			$viber 			  = $opts['viber'] ?? '';
			$viberColor 	  = $opts['viber_color'] ?? '#CE48FE';

			$whatsapp 		  = $opts['whatsapp'] ?? '';
			$whatsappColor 	  = $opts['whatsapp_color'] ?? '#D7FED7';

			$formColor 	      = $opts['form_color'] ?? '#00b894';
			$cf7_form_id 	  = $opts['cf7_form_id'] ?? 0;
			$position 	      = $opts['position'] ?? 'bottom-left';


			if (
            empty($phone) && empty($zalo) && empty($telegram) &&
            empty($instagram) && empty($youtube) && empty($tiktok) &&
            empty($fanpage) && empty($linkMessage) && empty($viber) &&
            empty($whatsapp) && empty($cf7_form_id)
        	) return;

			$zaloLink 	= $zalo ? 'https://zalo.me/' . $zalo : '';

			$hide_on 	= $opts['hide_on'] ?? [];
			$hide_class = '';
			$sizeScale 	= isset($opts['size_scale']) ? floatval($opts['size_scale']) : 1;

			if (in_array('desktop', $hide_on)) $hide_class .= ' hbc-hide-desktop';
			if (in_array('tablet', $hide_on))  $hide_class .= ' hbc-hide-tablet';
			if (in_array('mobile', $hide_on))  $hide_class .= ' hbc-hide-mobile';

			$buttons = [
				'zalo' => [
					'show'  => $zalo,
					'href'  => $zaloLink,
					'class' => 'hbc-zalo-btn',
					'color' => $zaloColor,
					'target'=> true,
				],
				'phone' => [
					'show'  => $phone,
					'href'  => 'tel:' . $phone,
					'class' => 'hbc-call-btn',
					'color' => $phoneColor,
					'target'=> false,
				],
				'telegram' => [
					'show'  => $telegram,
					'href'  => $telegram,
					'class' => 'hbc-telegram-btn',
					'color' => $telegramColor,
					'target'=> true,
				],
				'instagram' => [
					'show'  => $instagram,
					'href'  => $instagram,
					'class' => 'hbc-instagram-btn',
					'color' => $instagramColor,
					'target'=> true,
				],
				'youtube' => [
					'show'  => $youtube,
					'href'  => $youtube,
					'class' => 'hbc-youtube-btn',
					'color' => $youtubeColor,
					'target'=> true,
				],
				'tiktok' => [
					'show'  => $tiktok,
					'href'  => $tiktok,
					'class' => 'hbc-tiktok-btn',
					'color' => $tiktokColor,
					'target'=> true,
				],
				'fanpage' => [
					'show'  => $fanpage,
					'href'  => $fanpage,
					'class' => 'hbc-fanpage-btn',
					'color' => $fanpageColor,
					'target'=> true,
				],
				'link_message' => [
					'show'  => $linkMessage,
					'href'  => $linkMessage,
					'class' => 'hbc-link-message-btn',
					'color' => $linkMessageColor,
					'target'=> true,
				],
				'viber' => [
					'show'  => $viber,
					'href'  => 'viber://chat?number=' . $viber,
					'class' => 'hbc-viber-btn',
					'color' => $viberColor,
					'target'=> true,
				],
				'whatsapp' => [
					'show'  => $whatsapp,
					'href'  => 'https://wa.me/' . $whatsapp,
					'class' => 'hbc-whatsapp-btn',
					'color' => $whatsappColor,
					'target'=> true,
				],
			];

			include HUPUNA_BUTTON_CONTACT_PATH . 'templates/frontend-page.php';
		}
	}
}
