<?php

/**
 * View: List Event
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/event.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.0.0
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

$container_classes = ['tribe-common-g-row', 'tribe-events-calendar-list__event-row'];
$container_classes['tribe-events-calendar-list__event-row--featured'] = $event->featured;

$event_classes = tribe_get_post_class(['tribe-events-calendar-list__event', 'tribe-common-g-row', 'tribe-common-g-row--gutters', 'items-center', 'flex-col-reverse', 'md:flex-row-reverse'], $event->ID);
?>
<div <?php tribe_classes($container_classes); ?>>

	<div class="tribe-events-calendar-list__event-wrapper tribe-common-g-col">
		<article class="tribe-events-calendar-list__event tribe-common-g-row tribe-common-g-row--gutters items-center !flex-col-reverse md:!flex-row-reverse">
			<div class="tribe-events-calendar-list__event-details tribe-common-g-col w-full md:!w-1/6 !py-4 !text-left md:!text-center">
				<a
					href="<?php echo esc_url($event->permalink); ?>"
					title="<?php echo esc_attr($event->title); ?>"
					rel="bookmark"
					class="h6 !text-white flex gap-1 whitespace-nowrap">
					Learn more
					<svg class="inline-block w-auto shrink-0 -top-[2px] relative pr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
						<path d="M9.70697 17.4496L15.414 11.7426L9.70697 6.03564L8.29297 7.44964L12.586 11.7426L8.29297 16.0356L9.70697 17.4496Z" fill="#40C2CC" />
					</svg>
				</a>
			</div>
			<div class="tribe-events-calendar-list__event-details tribe-common-g-col w-full md:!w-1/2">

				<header class="tribe-events-calendar-list__event-header text-white text-left !bg-transparent">
					<?php $this->template('list/event/date', ['event' => $event]); ?>
					<?php $this->template('list/event/title', ['event' => $event]); ?>
				</header>

				<?php $this->template('list/event/description', ['event' => $event]); ?>
			</div>
			<?php $this->template('list/event/featured-image', ['event' => $event]); ?>
		</article>
	</div>

</div>