<?php if (!defined('ABSPATH')) exit; ?>

<?php
$active_tab = $_GET['tab'] ?? 'button';

$services = [
    'phone' => [
        'label' => __('Phone', 'hupuna-button-contact'),
        'placeholder' => '+84987654321',
        'default_color' => '#E6F0FF',
    ],
    'zalo' => [
        'label' => __('Zalo', 'hupuna-button-contact'),
        'placeholder' => '+84987654321',
        'default_color' => '#FFE6E6',
    ],
    'telegram' => [
        'label' => __('Link Telegram', 'hupuna-button-contact'),
        'placeholder' => 'Link Telegram',
        'default_color' => '#E6F6FF',
    ],
    'instagram' => [
        'label' => __('Link Instagram', 'hupuna-button-contact'),
        'placeholder' => 'Link Instagram',
        'default_color' => '#FFF0E6',
    ],
    'youtube' => [
        'label' => __('Link Youtube', 'hupuna-button-contact'),
        'placeholder' => 'Link Youtube',
        'default_color' => '#FFECEC',
    ],
    'tiktok' => [
        'label' => __('Link Tiktok', 'hupuna-button-contact'),
        'placeholder' => 'Link Tiktok',
        'default_color' => '#F2F2F2',
    ],
    'fanpage' => [
        'label' => __('Link Fanpage', 'hupuna-button-contact'),
        'placeholder' => 'Link Fanpage',
        'default_color' => '#E7F0FF',
    ],
    'link_message' => [
        'label' => __('Link Message', 'hupuna-button-contact'),
        'placeholder' => 'Link Message',
        'default_color' => '#E6FFFA',
    ],
    'viber' => [
        'label' => __('Viber', 'hupuna-button-contact'),
        'placeholder' => '+84987654321',
        'default_color' => '#F2E9FF',
    ],
    'whatsapp' => [
        'label' => __('Whatsapp', 'hupuna-button-contact'),
        'placeholder' => '+84987654321',
        'default_color' => '#E9FFF1',
    ],
];
?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <h2 class="nav-tab-wrapper">
        <a href="?page=hupuna-button-contact&tab=button"
           class="nav-tab <?php echo $active_tab === 'button' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e('Button Contact', 'hupuna-button-contact'); ?>
        </a>

        <a href="?page=hupuna-button-contact&tab=settings"
           class="nav-tab <?php echo $active_tab === 'settings' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e('Settings', 'hupuna-button-contact'); ?>
        </a>
    </h2>

    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php settings_fields('hupuna_button_contact_group'); ?>

        <table class="form-table">
            <?php
            switch ($active_tab) {
                case 'settings':
                    ?>
                    <tr>
                        <th><?php esc_html_e('Display position', 'hupuna-button-contact'); ?></th>
                        <td>
                            <select name="hupuna_button_contact_settings[position]">
                                <?php
                                $positions = [
                                    'bottom-left' => __('Bottom left', 'hupuna-button-contact'),
                                    'top-left' => __('Top left', 'hupuna-button-contact'),
                                    'bottom-right' => __('Bottom right', 'hupuna-button-contact'),
                                    'top-right' => __('Top right', 'hupuna-button-contact'),
                                ];
                                foreach ($positions as $key => $label) {
                                    printf(
                                        '<option value="%s" %s>%s</option>',
                                        esc_attr($key),
                                        selected($opts['position'] ?? '', $key, false),
                                        esc_html($label)
                                    );
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th><?php esc_html_e('Hide on', 'hupuna-button-contact'); ?></th>
                        <td>
                            <input type="hidden" name="hupuna_button_contact_settings[hide_on]" value="">

                            <label>
                                <input type="checkbox" name="hupuna_button_contact_settings[hide_on][]" value="mobile"
                                    <?php checked(in_array('mobile', $opts['hide_on'] ?? [])); ?>>
                                Mobile
                            </label>&nbsp;&nbsp;

                            <label>
                                <input type="checkbox" name="hupuna_button_contact_settings[hide_on][]" value="tablet"
                                    <?php checked(in_array('tablet', $opts['hide_on'] ?? [])); ?>>
                                Tablet
                            </label>&nbsp;&nbsp;

                            <label>
                                <input type="checkbox" name="hupuna_button_contact_settings[hide_on][]" value="desktop"
                                    <?php checked(in_array('desktop', $opts['hide_on'] ?? [])); ?>>
                                Desktop
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th><?php esc_html_e('Size scale', 'hupuna-button-contact'); ?></th>
                        <td>
                            <input type="number"
                                name="hupuna_button_contact_settings[size_scale]"
                                step="0.1"
                                min="0.5"
                                max="2"
                                value="<?php echo esc_attr($opts['size_scale'] ?? '1'); ?>"
                                style="width: 80px;">
                            <span class="description">
                                <?php esc_html_e('Eg: 0.8 - 0.9 - 1 - 1.2 (Default 1)', 'hupuna-button-contact'); ?>
                            </span>
                        </td>
                    </tr>
                    <?php
                    break;

                case 'button':
                    default:
                        foreach ($services as $key => $service):
                            ?>
                            <tr>
                                <th><?php echo esc_html($service['label']); ?></th>
                                <td>
                                    <input type="text"
                                        name="hupuna_button_contact_settings[<?php echo esc_attr($key); ?>]"
                                        value="<?php echo esc_attr($opts[$key] ?? ''); ?>"
                                        class="regular-text"
                                        placeholder="<?php echo esc_attr($service['placeholder']); ?>">

                                    <input type="color"
                                        name="hupuna_button_contact_settings[<?php echo esc_attr($key); ?>_color]"
                                        value="<?php echo esc_attr($opts[$key . '_color'] ?? $service['default_color']); ?>">
                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>

                        <!-- CF7 -->
                        <?php if ( class_exists('WPCF7') ) : ?>
                            <tr>
                                <th><?php esc_html_e('Contact form (CF7)', 'hupuna-button-contact'); ?></th>
                                <td>
                                        <select name="hupuna_button_contact_settings[cf7_form_id]">
                                            <option value="">
                                                <?php esc_html_e('-- Select a contact form --', 'hupuna-button-contact'); ?>
                                            </option>

                                            <?php foreach ($cf7_forms as $form): ?>
                                                <option value="<?php echo esc_attr($form->ID); ?>"
                                                    <?php selected($opts['cf7_form_id'] ?? '', $form->ID); ?>>
                                                    <?php echo esc_html($form->post_title); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>

                                        <input type="color"
                                            name="hupuna_button_contact_settings[form_color]"
                                            value="<?php echo esc_attr($opts['form_color'] ?? '#00b894'); ?>"> 
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php
                    break;
            }
            ?>
        </table>

        <?php submit_button(); ?>
    </form>
</div>