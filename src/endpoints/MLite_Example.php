<?php

namespace M\Endpoints;

use WP_REST_Request;
use WP_REST_Response;

class Example {

	/**
	 * Get Example
	 *
	 * @param WP_REST_Request|array $request
	 *
	 * @return WP_REST_Response|array
	 */
	public function get_example( WP_REST_Request $request ) {
		$example = $request['example'];
		return new WP_REST_Response( $example );
	}
}
