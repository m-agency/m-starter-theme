<?php

namespace App;

class Functions {

	/**
	 * Get Image HTML
	 *
	 * @param int    $image_id
	 * @param string $class
	 * @param string $size
	 * @param bool   $icon
	 *
	 * @return void
	 */
	public function twig_get_image_html( $image_id, $class = '', $size = 'full', $icon = false ) {
		return wp_get_attachment_image(
			$image_id,
			$size,
			$icon,
			[
				'class'     => $class,
				'draggable' => 'false',
			]
		);
	}

	public function menu_depth_template( $item ) {
		$depth = 0;

		if ( ! empty( $item->children ) ) {
			$depth = 1;
			foreach ( $item->children as $child ) {
				if ( ! empty( $child->children ) ) {
					$depth = 2;
					break;
				}
			}
		}

		return $depth > 1 ? 'complex' : 'simple';
	}
}
