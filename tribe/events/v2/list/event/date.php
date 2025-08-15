<?php
/**
 * View: List View - Single Event Date
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/event/date.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @since 4.9.9
 * @since 5.1.1 Move icons into separate templates.
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 *
 * @version 5.1.1
 */
use Tribe__Date_Utils as Dates;

$display_date = empty( $is_past ) && ! empty( $request_date )
	? max( $event->dates->start_display, $request_date )
	: $event->dates->start_display;

$event_week_day  = $display_date->format_i18n( 'D' );
$event_day_num   = $display_date->format_i18n( 'j' );
$event_month   = $display_date->format_i18n( 'M' );
$event_year   = $display_date->format_i18n( 'Y' );
$event_date_attr = $display_date->format( Dates::DBDATEFORMAT );

$event_date_attr = $event->dates->start->format( Dates::DBDATEFORMAT );

?>
<div class="tribe-events-calendar-list__event-datetime-wrapper tribe-common-b2 !bg-transparent">
	<?php $this->template( 'list/event/date/featured' ); ?>
	<time class="tribe-events-calendar-list__event-datetime h6 !text-white capitalize" datetime="<?php echo esc_attr( $event_date_attr ); ?>">
		<svg class="inline-block w-auto -top-[4px] relative pr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
			<path d="M9 1.5V3.5H15V1.5H17V3.5H21C21.5523 3.5 22 3.94772 22 4.5V20.5C22 21.0523 21.5523 21.5 21 21.5H3C2.44772 21.5 2 21.0523 2 20.5V4.5C2 3.94772 2.44772 3.5 3 3.5H7V1.5H9ZM20 11.5H4V19.5H20V11.5ZM7 5.5H4V9.5H20V5.5H17V7.5H15V5.5H9V7.5H7V5.5Z" fill="#EA4B38"/>
		</svg>
		<?php echo esc_html( $event_week_day ); ?>
		<?php echo esc_html( $event_day_num ); ?>
		<?php echo esc_html( $event_month ); ?>
		<?php echo esc_html( $event_year ); ?>
	</time>
	<?php $this->template( 'list/event/date/meta', [ 'event' => $event ] ); ?>
</div>
