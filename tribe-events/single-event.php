<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>

<article class="single-event vevent hentry">

	<?php
		krafit_event_meta_cats();
	?>

	<?php 
		// Event Titel
		the_title( '<h1 class="tribe-events-single-event-title summary entry-title">', '</h1>' ); 
	?>

	<div class="tribe-events-schedule updated published tribe-clearfix">
		<?php 
			// Event Details - Datum u. Uhrzeit
			echo tribe_events_event_schedule_details( $event_id, '<span class="duration time">', '</span>' ); 
		?>
		
	</div>

	<!-- Event header -->
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
		
	</div>
	<!-- #tribe-events-header -->

	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content entry-content description">
				<?php the_content(); ?>
			</div>
			<!-- .tribe-events-single-event-description -->

			<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
			<?php tribe_get_template_part( 'modules/meta' ); ?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
		</div> <!-- #post-x -->
		<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
	<?php endwhile; ?>

</article><!-- #tribe-events-content -->

	<!-- Event footer -->
	<!-- <nav class="navigation post-navigation" role="navigation">
	@todo: Add proper Navigation
		<!- Navigation ->
		<h2 class="screen-reader-text"><?php printf( __( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?></h2>
		<div class="row">
		<div class="column third">
			<?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?>
		</div>
		<div class="column third">
			<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( __( '&laquo; All %s', 'the-events-calendar' ), $events_label_plural ); ?></a>
		</div>
		<div class="column third">
			<?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?>
		</div>
		<div class="clear"></div>
		</div>
		<!- .tribe-events-sub-nav ->
	</nav>
	-->
	<!-- #tribe-events-footer -->