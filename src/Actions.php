<?php

namespace App;

use App\Endpoints;
use DirectoryIterator;

class Actions
{

	/**
	 * Add admin scripts
	 *
	 * @param string $hook The name of the admin hook being called.
	 *
	 * @return void
	 */
	public function admin_scripts(string $hook): void
	{
		global $pagenow;

		$path = get_stylesheet_directory_uri();
		$ver  = M_VERSION;

		if ($pagenow == 'post.php' && get_post_type() == 'page') {
			wp_enqueue_style('magency-theme', "$path/assets/styles/theme.css", array(), $ver, 'all');
			wp_enqueue_style('magency-editor', "$path/assets/styles/editor.css", array(), $ver, 'all');
			wp_enqueue_script('magency-scripts', "$path/assets/scripts/theme.js", array(), $ver, ['in_footer' => false]);
		}
	}

	/**
	 * Add custom REST API endponts.
	 *
	 * @return void;
	 */
	public function custom_rest_endpoints(): void
	{
		if (! isset($endpoints)) {
			$endpoints = new Endpoints();
		}
	}

	/**
	 * Add Styles and Scripts to frontend.
	 *
	 * @return void
	 */
	public function enqueue_scripts(): void
	{
		$path = get_stylesheet_directory_uri();
		$ver  = M_VERSION;

		wp_enqueue_style('magency-theme', "$path/assets/styles/theme.css", [], $ver, 'all');
		wp_enqueue_script('magency-theme', "$path/assets/scripts/theme.js", [], $ver, ['in_footer' => true]);
	}

	/**
	 * Dynamically register custom ACF blocks
	 *
	 * @return void
	 */
	public function register_acf_blocks(): void
	{
		foreach ($blocks = new DirectoryIterator(__DIR__ . '/../views/blocks') as $item) {
			if (
				$item->isDir() && ! $item->isDot()
				&& file_exists($item->getPathname() . '/block.json')
			) {
				register_block_type($item->getPathname());
			}
		}
	}

	/**
	 * Register Navigation Menus
	 *
	 * @return void
	 */
	public function register_nav_menus(): void
	{
		register_nav_menus(
			array(
				'primary-menu'  => __('Primary Menu'),
				'footer-menu'   => __('Footer Menu'),
				'footer-menu-2' => __('Footer Menu 2'),
			)
		);
	}

	/**
	 * Add theme support
	 *
	 * @return void
	 */
	public function theme_supports(): void
	{
		add_theme_support('title-tag');
		add_theme_support('custom-logo');
		add_theme_support('post-thumbnails');
	}

	/**
	 * Custom Block Styles
	 * 
	 * @return void
	 */
	public function custom_block_styles(): void
	{
		$this->register_style_for_blocks([
			'blocks' => [
				'core/group',
				'core/cover'
			],
			'styles' => [
				['wrapper', __('Wrapper', 'magency-theme')],
				['wrapper-small', __('Wrapper (small)', 'magency-theme')],
				['form-wrapper', __('Form Wrapper', 'magency-theme')],
				['full-fade', __('Full Fade', 'magency-theme')],
				['booking-wrapper', __('Booking Wrapper', 'magency-theme')],
				['just-content', __('Just Content', 'magency-theme')]
			]
		]);

		$this->register_style_for_blocks([
			'blocks' => [
				'core/group',
				'acf/image-with-text',
				'acf/link-slider',
				'acf/party-menu'
			],
			'styles' => [
				['transparent-fade', __('Transparent Fade', 'magency-theme')],
				['full-fade', __('Full Fade', 'magency-theme')]
			]
		]);

		$this->register_style_for_blocks([
			'blocks' => [
				'core/separator',
				'core/spacer'
			],
			'styles' => [
				['faded', __('Faded', 'magency-theme')]
			]
		]);
	}

	/**
	 * Mini function for making block style registration less verbose.
	 * 
	 * @param array $args
	 * @return void
	 */
	private function register_style_for_blocks(array $args): void
	{
		foreach ($args['blocks'] as $block) {
			foreach ($args['styles'] as $style) {
				register_block_style($block, [
					'name'  => $style[0],
					'label' => $style[1]
				]);
			}
		}
	}
}
