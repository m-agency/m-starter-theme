<?php

/**
 * M class
 * This class is used to add custom functionality to the theme.
 */

namespace App;

use App\Filters;
use App\Actions;
use Timber\Site;

/**
 * Class StarterSite.
 */
class M extends Site
{
	/**
	 * Class Contructor
	 * Executes all necessary hooks & filters for theme.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$actions = new Actions();
		$filters = new Filters();

		// All Action Customizations
		add_action('admin_enqueue_scripts', [$actions, 'admin_scripts']);
		add_action('after_setup_theme', [$actions, 'theme_supports']);
		add_action('init', [$actions, 'register_acf_blocks']);
		add_action('init', [$actions, 'register_nav_menus']);
		add_action('init', [$actions, 'custom_block_styles']);
		add_action('rest_api_init', [$actions, 'custom_rest_endpoints']);
		add_action('wp_enqueue_scripts', [$actions, 'enqueue_scripts']);

		// General WordPress Filters
		add_filter('block_categories_all', [$filters, 'blocks_add_category']);
		add_filter('should_load_separate_core_block_assets', '__return_true');

		// Timber Filters
		add_filter('timber/context', [$filters, 'add_to_context']);
		add_filter('timber/twig', [$filters, 'add_to_twig']);
		add_filter('timber/twig/environment/options', [$filters, 'update_twig_environment_options']);

		// ACF Filters
		add_filter('acf/load_field/name=gravity_form', [$filters, 'gravity_forms_dropdown']);
		add_filter('acf/load_field/name=footer_form', [$filters, 'gravity_forms_dropdown']);

		// Gravity Forms Filters
		add_filter('gform_submit_button', [$filters, 'input_to_button'], 10, 2);
		add_filter('gform_pre_render', [$filters, 'populate_capacity_select']);
		add_filter('gform_pre_validation', [$filters, 'populate_capacity_select']);
		add_filter('gform_pre_submission_filter', [$filters, 'populate_capacity_select']);
		add_filter('gform_admin_pre_render', [$filters, 'populate_capacity_select']);

		parent::__construct();
	}
}
