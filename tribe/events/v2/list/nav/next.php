<?php
/**
 * View: List View Nav Next Button
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/nav/next.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @var string $link The URL to the next page.
 *
 * @version 5.3.0
 *
 */

/* translators: %s: Event (plural or singular). */
$label = sprintf( __( 'Next %1$s', 'the-events-calendar' ), tribe_get_event_label_plural() );

/* translators: %s: Event (plural or singular). */
$events_mobile_friendly_label = sprintf( __( 'Next %1$s', 'the-events-calendar' ), '<span class="tribe-events-c-nav__next-label-plural tribe-common-a11y-visual-hide">' . tribe_get_event_label_plural() . '</span>' );
?>
<li class="tribe-events-c-nav__list-item tribe-events-c-nav__list-item--next !inline-block !justify-center !w-auto !mx-2">
	<a
		href="<?php echo esc_url( $link ); ?>"
		rel="next"
		class="btn btn-primary !bg-light-blue rounded tribe-events-c-nav__next tribe-common-b2 tribe-common-b1--min-medium font-bold text-black"
		data-js="tribe-events-view-link"
		aria-label="<?php echo esc_attr( $label ); ?>"
		title="<?php echo esc_attr( $label ); ?>"
		style="padding:12px 24px; font-weight:600; color:#000;font-family:'Brandon-Grotesque-Bold'"
	>
		<span class="tribe-events-c-nav__next-label">
			<?php echo wp_kses( $events_mobile_friendly_label, [ 'span' => [ 'class' => [] ] ] ); ?>
		</span>
		
	</a>
</li>
