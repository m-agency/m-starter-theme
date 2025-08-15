<?php

namespace App;

use App\Endpoints\Example;

class Endpoints {

	public function __construct() {
		// $this->Example();
	}

	public function Example() {
		$example = new Example();

		register_rest_route(
			'ecpg/v1',
			'/get-example',
			[
				'methods'             => 'GET',
				'callback'            => [ $example, 'get_example' ],
				'permission_callback' => function () {
					return true;
				},
			]
		);
	}
}
