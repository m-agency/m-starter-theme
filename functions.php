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

define('M_VERSION', '0.0.7');

new M();

add_filter('tribe_events_pre_get_posts', 'filter_tribe_all_occurences', 100);

function filter_tribe_all_occurences($wp_query)
{



    $new_meta = array();
    $today = new DateTime();

    // Join with existing meta_query
    if (is_array($wp_query->meta_query))
        $new_meta = $wp_query->meta_query;

    // Add new meta_query, select events ending from now forward
    $new_meta[] = array(
        'key' => '_EventEndDate',
        'type' => 'DATETIME',
        'compare' => '>=',
        'value' => $today->format('Y-m-d H:i:s')
    );

    $wp_query->set('meta_query', $new_meta);


    return $wp_query;
}
