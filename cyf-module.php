<?php
/**
 * Plugin Name: CYF module
 * Description: A plugin that utilizes Timber as a templating engine with ACF fields.
 * Version: 1.0.0
 * Author: Andrii Fesenko
 *  Author URI:        mailto:andrewwfesenko@gmail.com
 *  Update URI:        false
 *  Text Domain:       cyf-module
 *  Domain Path:       /lang
 *  Requires PHP:      8.0
 *  Requires at least: 6.6
 */

defined('ABSPATH') || exit;

require_once __DIR__ . '/vendor/autoload.php';

use CyfModule\Plugin;

register_activation_hook(__FILE__, [Plugin::class, 'activate']);

Plugin::init();
