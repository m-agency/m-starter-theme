<?php

/**
 * Primary Shortcode
 * For displaying content that is the theme's primary color.
 *
 * @return string
 */
function m_primary_shortcode( $atts, $content ) {
	return "<strong class='text-primary'>{$content}</strong>";
}
add_shortcode( 'primary', 'm_primary_shortcode' );
