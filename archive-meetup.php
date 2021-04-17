<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package krafit_planck
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">Deutschsprachige WP Meetups</h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<div class="row meetup-wrap">
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" class="column half meetup-card">
					<header class="entry-header">
						<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

						<div class="meta-info">
							<?php $terms = get_the_terms( $post->ID, 'meetup_status' );
							if( $terms ){
								$term = array_shift( $terms ); // get first

								// now you can display the name of the term
								echo '<span class="meetup-status ' . $term->name . '">' . $term->name .'</span>';
							}

							$terms = get_the_terms( $post->ID, 'meetup_modus' );
							if( $terms ){
								$term = array_shift( $terms ); // get first

								// now you can display the name of the term
								echo '<span class="meetup-modus ' . $term->name . '">' . $term->name .'</span>';
							}
							?>
						</div>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php
							the_excerpt();
						?>
					</div><!-- .entry-content -->

				</article><!-- #post-## -->

			<?php endwhile; ?>
			<div class="clear"></div>
			</div><!-- .row -->

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
