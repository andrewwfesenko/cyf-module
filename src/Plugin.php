<?php
declare(strict_types=1);

namespace CyfModule;

use Timber\Timber;

class Plugin
{
    public static function init(): void
    {
        add_action('plugins_loaded', [self::class, 'onPluginsLoaded']);

        // Initialize Timber
        add_action('after_setup_theme', [self::class, 'setupTimber']);

        // Register page template
        add_filter('theme_page_templates', [self::class, 'addPageTemplate']);
        add_filter('template_include', [self::class, 'loadPageTemplate']);

        // Enqueue assets
        add_action('wp_enqueue_scripts', [self::class, 'enqueueAssets']);

        // Register ACF fields
        add_action('acf/init', [Fields::class, 'registerFields']);
    }

    public static function onPluginsLoaded(): void
    {
        // Check if ACF is active
        if (!self::isAcfActive()) {
            add_action('admin_notices', [self::class, 'adminNoticeAcfRequired']);
        }
    }


    public static function activate(): void
    {
        // Check if ACF is active
        if (!self::isAcfActive()) {
            // Deactivate the plugin
            deactivate_plugins(plugin_basename(__FILE__));

            // Display an error message
            wp_die(
                __('CYF module requires the ACF Pro plugin to be installed and active.', 'my-timber-plugin'),
                __('Plugin Activation Error', 'cyf-module'),
                ['back_link' => true]
            );
        }
    }

    private static function isAcfActive(): bool
    {
        return function_exists('acf_is_pro') && acf_is_pro() && acf_pro_is_license_active();
    }

    public static function adminNoticeAcfRequired(): void
    {
        echo '<div class="notice notice-error is-dismissible">';
        echo '<p>' . esc_html__('CYF module requires the ACF Pro plugin to be installed and active.', 'cyf-module') . '</p>';
        echo '</div>';
    }

    public static function setupTimber(): void
    {
        Timber::$dirname = ['templates', 'views'];
    }

    public static function addPageTemplate(array $templates): array
    {
        $templates['cyf-template.php'] = __('CYF Template', 'cyf-module');
        return $templates;
    }

    public static function loadPageTemplate(string $template): string
    {
        if (is_page_template('cyf-template.php')) {
            $template = __DIR__ . '/Templates/cyf-template.php';
        }
        return $template;
    }

    public static function enqueueAssets(): void
    {
        wp_enqueue_style(
            'cyf-style',
            plugins_url('assets/css/style.css', __DIR__),
            [],
            '1.0.0'
        );
        wp_enqueue_script(
            'cyf-script',
            plugins_url('assets/js/script.js', __DIR__),
            [],
            '1.0.0',
            true
        );
    }
}
