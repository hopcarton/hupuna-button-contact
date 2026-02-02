<?php if (!defined('ABSPATH')) exit; ?>

<div class="hbc-float-container pos-<?php echo esc_attr($position); ?> <?php echo esc_attr($hide_class); ?>"
    style="transform: scale(<?php echo esc_attr($sizeScale); ?>); transform-origin: bottom left;">
    <?php
    foreach ($buttons as $btn):
        if (empty($btn['show'])) continue;
    ?>
        <a href="<?php echo esc_url($btn['href']); ?>"
           class="hbc-float-btn <?php echo esc_attr($btn['class']); ?>"
           data-color="<?php echo esc_attr($btn['color']); ?>"
           style="background:<?php echo esc_attr($btn['color']); ?>; color:<?php echo esc_attr($btn['color']); ?>;"
           <?php echo $btn['target'] ? 'target="_blank"' : ''; ?>>
        </a>
    <?php endforeach; ?>

    <!-- Contact Form -->
    <?php if ($cf7_form_id && class_exists('WPCF7')) : ?>
        <button class="hbc-float-btn hbc-contact-btn"
                data-color="<?php echo esc_attr($formColor); ?>"
                style="background:<?php echo esc_attr($formColor); ?>; color:<?php echo esc_attr($formColor); ?>;">
        </button>
    <?php endif; ?>
</div>

<!-- Popup CF7 -->
<?php if ($cf7_form_id && class_exists('WPCF7') && post_type_exists('wpcf7_contact_form')): ?>
    <div class="hbc-popup-overlay">
        <div class="hbc-popup">
            <?php echo do_shortcode('[contact-form-7 id="' . intval($cf7_form_id) . '"]'); ?>
        </div>
    </div>    
<?php endif; ?>
