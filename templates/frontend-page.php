<?php if (!defined('ABSPATH')) exit; ?>

<?php
$hide_on = $opts['hide_on'] ?? [];
$hide_class = '';

$sizeScale = isset($opts['size_scale']) ? floatval($opts['size_scale']) : 1;

if (in_array('desktop', $hide_on)) $hide_class .= ' hide-desktop';
if (in_array('tablet', $hide_on))  $hide_class .= ' hide-tablet';
if (in_array('mobile', $hide_on))  $hide_class .= ' hide-mobile';
?>

<div class="float-container pos-<?php echo esc_attr($position); ?> <?php echo esc_attr($hide_class); ?>"
    style="transform: scale(<?php echo esc_attr($sizeScale); ?>); transform-origin: bottom left;">

    <?php
    $buttons = [
        'zalo' => [
            'show'  => $zalo,
            'href'  => $zaloLink,
            'class' => 'zalo-btn',
            'color' => $zaloColor,
            'target'=> true,
        ],
        'phone' => [
            'show'  => $phone,
            'href'  => 'tel:' . $phone,
            'class' => 'call-btn',
            'color' => $phoneColor,
            'target'=> false,
        ],
        'telegram' => [
            'show'  => $telegram,
            'href'  => $telegram,
            'class' => 'telegram-btn',
            'color' => $telegramColor,
            'target'=> true,
        ],
        'instagram' => [
            'show'  => $instagram,
            'href'  => $instagram,
            'class' => 'instagram-btn',
            'color' => $instagramColor,
            'target'=> true,
        ],
        'youtube' => [
            'show'  => $youtube,
            'href'  => $youtube,
            'class' => 'youtube-btn',
            'color' => $youtubeColor,
            'target'=> true,
        ],
        'tiktok' => [
            'show'  => $tiktok,
            'href'  => $tiktok,
            'class' => 'tiktok-btn',
            'color' => $tiktokColor,
            'target'=> true,
        ],
        'fanpage' => [
            'show'  => $fanpage,
            'href'  => $fanpage,
            'class' => 'fanpage-btn',
            'color' => $fanpageColor,
            'target'=> true,
        ],
        'link_message' => [
            'show'  => $linkMessage,
            'href'  => $linkMessage,
            'class' => 'link-message-btn',
            'color' => $linkMessageColor,
            'target'=> true,
        ],
        'viber' => [
            'show'  => $viber,
            'href'  => 'viber://chat?number=' . $viber,
            'class' => 'viber-btn',
            'color' => $viberColor,
            'target'=> true,
        ],
        'whatsapp' => [
            'show'  => $whatsapp,
            'href'  => 'https://wa.me/' . $whatsapp,
            'class' => 'whatsapp-btn',
            'color' => $whatsappColor,
            'target'=> true,
        ],
    ];

    foreach ($buttons as $btn):
        if (empty($btn['show'])) continue;
    ?>
        <a href="<?php echo esc_url($btn['href']); ?>"
           class="float-btn <?php echo esc_attr($btn['class']); ?>"
           data-color="<?php echo esc_attr($btn['color']); ?>"
           style="background:<?php echo esc_attr($btn['color']); ?>; color:<?php echo esc_attr($btn['color']); ?>;"
           <?php echo $btn['target'] ? 'target="_blank"' : ''; ?>>
        </a>
    <?php endforeach; ?>

    <!-- Contact Form -->
    <?php if ($cf7_form_id): ?>
        <button class="float-btn contact-btn"
                data-color="<?php echo esc_attr($formColor); ?>"
                style="background:<?php echo esc_attr($formColor); ?>; color:<?php echo esc_attr($formColor); ?>;">
        </button>
    <?php endif; ?>
</div>

<!-- Popup CF7 -->
<?php if ($cf7_form_id && post_type_exists('wpcf7_contact_form')): ?>
    <div class="hbc-popup-overlay">
        <div class="hbc-popup">
            <button class="hbc-close">&times;</button>
            <?php echo do_shortcode('[contact-form-7 id="' . intval($cf7_form_id) . '"]'); ?>
        </div>
    </div>    
<?php endif; ?>
