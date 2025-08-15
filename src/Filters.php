<?php

namespace App;

use App\Functions;
use GFFormsModel;
use Twig\TwigFunction;
use Timber;
use Timber\Site;
use WP_HTML_Processor;

class Filters
{

	/**
	 * This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 *
	 * @return array
	 */
	public function add_to_context($context)
	{
		$context['site']          = new Site();
		$context['logo']          = get_theme_mod('custom_logo');
		$context['options']       = get_fields('options');
		$context['primary_menu']  = Timber::get_menu('primary-menu');
		$context['footer_menu']   = Timber::get_menu('footer-menu');
		$context['footer_menu_2'] = Timber::get_menu('footer-menu-2');

		return $context;
	}

	/**
	 * This is where you can add your own functions to twig.
	 *
	 * @param Twig\Environment $twig get extension.
	 *
	 * @return Twig|Environment
	 */
	public function add_to_twig($twig)
	{
		$functions = new Functions();

		$twig->addFunction(
			new TwigFunction('get_image_html', [$functions, 'twig_get_image_html'])
		);

		$twig->addFunction(
			new TwigFunction('menu_depth_template', [$functions, 'menu_depth_template'])
		);

		return $twig;
	}

	/**
	 * Creates custom block category
	 *
	 * @param array $categories An array of existing block categories.
	 *
	 * @return array
	 */
	function blocks_add_category($categories)
	{
		$custom = array(
			'slug'  => 'M-blocks',
			'title' => 'M Blocks',
		);

		array_unshift($categories, $custom);

		return $categories;
	}

	/**
	 * Filters the next, previous and submit buttons.
	 * Replaces the form's <input> buttons with <button> while maintaining attributes from original <input>.
	 *
	 * @param string $button Contains the <input> tag to be filtered.
	 * @param array  $form   Contains all the properties of the current form.
	 *
	 * @return string The filtered button.
	 */
	function input_to_button($button, $form)
	{
		$fragment = WP_HTML_Processor::create_fragment($button);
		$fragment->next_token();

		$attributes     = array('id', 'type', 'onclick');
		$new_attributes = array();

		foreach ($attributes as $attribute) {
			$value = $fragment->get_attribute($attribute);
			if (! empty($value)) {
				$new_attributes[] = sprintf('%s="%s"', $attribute, esc_attr($value));
			}
		}

		$new_attributes[] = 'class="btn btn-submit"';

		return sprintf('<button %s>%s</button>', implode(' ', $new_attributes), esc_html($fragment->get_attribute('value')));
	}

	/**
	 * Updates Twig environment options.
	 *
	 * @link https://twig.symfony.com/doc/2.x/api.html#environment-options
	 *
	 * @param array $options An array of environment options.
	 *
	 * @return array
	 */
	public function update_twig_environment_options($options)
	{
		// $options['autoescape'] = true;
		return $options;
	}

	/**
	 * Sets up special Gravity Forms select field.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_filter/
	 *
	 * @param array $field Array of field data.
	 *
	 * @return array
	 */
	public function gravity_forms_dropdown($field)
	{
		if (class_exists('GFFormsModel') && class_exists('ACF')) {
			$choices = array();

			foreach (GFFormsModel::get_forms() as $form) {
				$choices[$form->id] = $form->title;
			}

			$field['choices'] = $choices;
		}

		return $field;
	}

	/**
	 * Auto-populate Gravity Forms <select> fields with numbers 1–100
	 * for fields that have the CSS class "capacity-select".
	 *
	 * Hooks into multiple Gravity Forms filters to ensure the
	 * choices are available:
	 * - Frontend rendering (`gform_pre_render`)
	 * - Validation (`gform_pre_validation`)
	 * - Submission (`gform_pre_submission_filter`)
	 * - Admin form editor preview (`gform_admin_pre_render`)
	 *
	 * @param array $form The Gravity Forms form object being processed.
	 * @return array The modified form object with populated select choices.
	 */
	public function populate_capacity_select($form)
	{
		foreach ($form['fields'] as &$field) {
			if (
				$field->type !== 'select' ||
				(empty($field->cssClass) || strpos($field->cssClass, 'capacity-select') === false)
			) {
				continue;
			}

			$choices = array();
			for ($i = 1; $i <= 100; $i++) {
				$choices[] = array(
					'text'  => (string) $i,
					'value' => (string) $i,
				);
			}

			$field->choices = $choices;
		}

		return $form;
	}
}
