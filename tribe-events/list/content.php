<?php
/**
 * List View Content Template
 * The content template for the list view. This template is also used for
 * the response that is returned on list view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/content.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<div id="content" class="site-content">
	<main id="main" class="site-main" role="main">
	<article>

	<!-- List Title -->
	<?php do_action( 'tribe_events_before_the_title' ); ?>

	<?php do_action( 'tribe_events_after_the_title' ); ?>

	<!-- Notices -->
	<?php tribe_events_the_notices() ?>

	<!-- List Header -->
	<?php do_action( 'tribe_events_before_header' ); ?>
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>

		<!-- Header Navigation -->
		<?php do_action( 'tribe_events_before_header_nav' ); ?>
		<h1 class="entry-title">Termine</h1>
		<?php do_action( 'tribe_events_after_header_nav' ); ?>

	</div>
	<!-- #tribe-events-header -->
	<?php do_action( 'tribe_events_after_header' ); ?>


	<!-- Events Loop -->
	<section class="global-events-list events-listing">
	<?php if ( have_posts() ) : ?>
		<?php do_action( 'tribe_events_before_loop' ); ?>
		<?php tribe_get_template_part( 'list/loop' ) ?>
		<?php do_action( 'tribe_events_after_loop' ); ?>
	<?php endif; ?>
	</section>

	<!-- List Footer -->
	<?php do_action( 'tribe_events_before_footer' ); ?>

	<!-- #tribe-events-footer -->
	<?php  
		// Zeigte "Exportiere gelistete Link"
		//do_action( 'tribe_events_after_footer' ) 
	?>

	</article>


		<!-- Footer Navigation -->
		<?php do_action( 'tribe_events_before_footer_nav' ); ?>
		

		
		<!-- <nav class="navigation post-navigation" role="navigation">
		@todo: Add proper Navigation
			<!- Navigation ->
			<h3 class="tribe-events-visuallyhidden"><?php printf( __( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?></h3>
			<ul class="nav-links">
				<?php if ( tribe_has_previous_event() ) : ?>
					<li class="nav-previous">
						<a href="<?php echo esc_url( tribe_get_listview_prev_link() ); ?>" rel="prev"><?php printf( __( '<span>&laquo;</span> Previous %s', 'the-events-calendar' ), $events_label_plural ); ?></a>
					</li>
				<?php endif; ?>

				<!- Right Navigation ->
				<?php if ( tribe_has_next_event() ) : ?>
					<li class="nav-next">
						<a href="<?php echo esc_url( tribe_get_listview_next_link() ); ?>" rel="next"><?php printf( __( 'Next %s <span>&raquo;</span>', 'the-events-calendar' ), $events_label_plural ); ?></a>
					</li>
				<?php endif; ?>
			</ul>
		</nav> -->


		<?php do_action( 'tribe_events_after_footer_nav' ); ?>

	</main>
</div><!-- #tribe-events-content -->
