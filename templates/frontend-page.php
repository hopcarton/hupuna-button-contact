<?php if (!defined('ABSPATH')) exit; ?>

<div class="hbc-float-container pos-<?php echo esc_attr($position); ?> <?php echo esc_attr($hide_class); ?>"
     style="transform: scale(<?php echo esc_attr($sizeScale); ?>);">
    <?php
    foreach ($buttons as $key => $btn):
        if (empty($btn['show'])) continue;
    ?>
        <a href="<?php echo esc_url($btn['href']); ?>"
           class="hbc-float-btn <?php echo esc_attr($btn['class']); ?>"
           data-color="<?php echo esc_attr($btn['color']); ?>"
           style="background:<?php echo esc_attr($btn['color']); ?>; color:<?php echo esc_attr($btn['color']); ?>;"
           <?php echo $btn['target'] ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
           aria-label="<?php echo esc_attr(ucfirst($key)); ?>">
        </a>
    <?php endforeach; ?>

    <!-- Contact Form -->
    <?php if ($cf7_form_id && class_exists('WPCF7') && post_type_exists('wpcf7_contact_form')) : ?>
        <button class="hbc-float-btn hbc-contact-btn hbc-btn-has-text"
                data-color="<?php echo esc_attr($formColor); ?>"
                style="background:<?php echo esc_attr($formColor); ?>; color:<?php echo esc_attr($formColor); ?>;"
                aria-label="<?php esc_attr_e('Contact Us', 'hupuna-button-contact'); ?>">
            <span class="hbc-btn-text"><?php echo esc_html($contact_button_text); ?></span>
        </button>
    <?php endif; ?>
</div>

<!-- Popup CF7 -->
<?php if ($cf7_form_id && class_exists('WPCF7') && post_type_exists('wpcf7_contact_form')): ?>
    <div class="hbc-popup-overlay">
        <div class="hbc-popup hbc-form-<?php echo esc_attr($form_template); ?>" 
             style="--hbc-primary-color: <?php echo esc_attr($formColor); ?>;">
            <button class="hbc-popup-close">&times;</button>
            
            <?php if ($form_template === 'template_1'): ?>
                <div class="hbc-tpl-1-wrapper">
                    <div class="hbc-tpl-1-left">
                        <?php echo do_shortcode('[contact-form-7 id="' . intval($cf7_form_id) . '"]'); ?>
                    </div>
                    <div class="hbc-tpl-1-right">
                        <?php if ($tpl_data['logo']): ?>
                            <img src="<?php echo esc_url($tpl_data['logo']); ?>" class="hbc-tpl-logo">
                        <?php endif; ?>
                        <h2 class="hbc-tpl-heading"><?php echo esc_html($tpl_data['heading'] ?: __('Connect with us', 'hupuna-button-contact')); ?></h2>
                        <h3 class="hbc-tpl-subheading"><?php echo esc_html($tpl_data['subheading']); ?></h3>
                        <p class="hbc-tpl-desc"><?php echo wp_kses_post($tpl_data['description']); ?></p>
                        
                        <div class="hbc-tpl-contact-btns">
                            <?php if (isset($buttons['zalo'])): ?>
                                <a href="<?php echo esc_url($buttons['zalo']['href']); ?>" class="hbc-tpl-btn-zalo" target="_blank">
                                    <img src="<?php echo HUPUNA_BUTTON_CONTACT_URL . 'assets/images/zalo.png'; ?>">
                                    <?php esc_html_e('Chat now', 'hupuna-button-contact'); ?>
                                </a>
                            <?php endif; ?>
                            <?php if (isset($buttons['phone'])): ?>
                                <a href="<?php echo esc_url($buttons['phone']['href']); ?>" class="hbc-tpl-btn-phone">
                                    <i class="dashicons dashicons-phone"></i>
                                    <?php echo esc_html($opts['phone'] ?? ''); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            <?php elseif ($form_template === 'template_2'): ?>
                <div class="hbc-tpl-2-wrapper">
                    <div class="hbc-tpl-2-sidebar">
                        <h2 class="hbc-tpl-heading"><?php echo esc_html($tpl_data['heading'] ?: __('CONSULTATION CONTACT', 'hupuna-button-contact')); ?></h2>
                        <p class="hbc-tpl-desc"><?php echo wp_kses_post($tpl_data['description'] ?: __('Leave your information, we will support answering your questions immediately.', 'hupuna-button-contact')); ?></p>
                        
                        <ul class="hbc-tpl-contact-list">
                            <?php if (isset($buttons['phone'])): ?>
                                <li><strong><?php esc_html_e('Hotline:', 'hupuna-button-contact'); ?></strong> <?php echo esc_html($opts['phone'] ?? ''); ?></li>
                            <?php endif; ?>
                            <?php if (isset($buttons['zalo'])): ?>
                                <li><strong><?php esc_html_e('Zalo:', 'hupuna-button-contact'); ?></strong> <?php echo esc_html($opts['zalo'] ?? ''); ?></li>
                            <?php endif; ?>
                            <?php if (isset($buttons['email'])): ?>
                                <li><strong><?php esc_html_e('Email:', 'hupuna-button-contact'); ?></strong> <?php echo esc_html($opts['email'] ?? ''); ?></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="hbc-tpl-2-main">
                        <?php echo do_shortcode('[contact-form-7 id="' . intval($cf7_form_id) . '"]'); ?>
                    </div>
                </div>

            <?php else: ?>
                <?php echo do_shortcode('[contact-form-7 id="' . intval($cf7_form_id) . '"]'); ?>
            <?php endif; ?>
        </div>
    </div>    
<?php endif; ?>
