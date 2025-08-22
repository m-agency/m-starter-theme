<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @link https://github.com/timber/starter-theme
 */

namespace App;

use Timber\Timber;

// Load Composer dependencies.
require_once __DIR__ . '/vendor/autoload.php';

// Load theme dependencies.
require_once __DIR__ . '/src/utilities/block_callback.php';
require_once __DIR__ . '/src/utilities/shortcodes.php';

Timber::init();

define('M_VERSION', '0.0.1');

new M();
