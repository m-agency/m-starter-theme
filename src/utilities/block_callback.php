<?php

/**
 * Render callback to prepare and display a registered block using Timber.
 *
 * @param array    $attributes The block attributes.
 * @param string   $content    The block content.
 * @param bool     $is_preview Whether or not the block is being rendered for editing preview.
 * @param int      $post_id    The current post being edited or viewed.
 * @param WP_Block $wp_block   The block instance (since WP 5.5).
 *
 * @return void
 */
function m_block_renderer( $attributes, $content = '', $is_preview = false, $post_id = 0, $wp_block = null ) {
	$slug    = str_replace( 'acf/', '', $attributes['name'] );
	$context = Timber::context();

	$context['attributes'] = $attributes;
	$context['fields']     = get_fields();
	$context['is_preview'] = $is_preview;

	Timber::render(
		'blocks/' . $slug . '/' . $slug . '.twig',
		$context
	);
}
