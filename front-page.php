<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package krafit_planck
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'krafit_planck' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->
				
				<?php if (class_exists('Tribe__Events__Main')) { ?>
										
					<section class="global-events-list" id="events-section">	
						<div class="row">
							<div class="column half no-margin"><h5>Aktuelle Meetup Termine</h5></div>
							<div class="column half no-margin"><h5><a href="<?php echo esc_url( tribe_get_events_link() ); ?>">Alle Termine zeigen</a></h5></div>
						</div>
						<?php echo do_shortcode('[ecs-list-events order="ASC" limit="5"]'); ?>
					</section>

				<?php } ?>
				
				

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
