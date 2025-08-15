<?php

/**
 * Template Name: Events Template
 */

namespace App;

use Timber\Timber;

$post_id  = get_the_ID();
$context  = Timber::context();
$template = 'page.twig';

if (is_singular()) {
  $context['event'] = tribe_get_event($post_id);
  $context['venue'] = tribe_get_venue($post_id);

  $template = 'single-event.twig';
} else {
  $context['post'] = Timber::get_post(get_field('events_page', 'options'));
}

Timber::render(['templates/' . $template], $context);
