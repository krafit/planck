<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package krafit_planck
 */

global $post; $post_slug=$post->post_name;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="row">	
			<div class="column two-thirds">

				<?php the_content(); ?>

			</div>
			<div class="column third">
				<ul class="meetup-meta">
				<?php 


  $mykey_values = get_post_custom_values( 'wpmg_metadata_id' );
  foreach ( $mykey_values as $key => $value ) {
    echo "$key  => $value ( 'wpmg_metadata_id' )<br />"; 
  }

?>

					<li><span class="dashicons dashicons-wordpress"></span> Webseite</li>
					<li><span class="dashicons dashicons-email"></span> Kontakt</li>
					<li><span class="dashicons dashicons-megaphone"></span> Mailingliste</li>
					<li><span class="dashicons dashicons-nametag"></span> Meetup.com</li>
					<li><span class="dashicons dashicons-format-video"></span> Videos auf wp.tv</li>
					<li><span class="dashicons dashicons-twitter"></span> Twitter</li>
					<li><span class="dashicons dashicons-facebook"></span> Facebook</li>
					<li><span class="dashicons dashicons-googleplus"></span> Google+</li>
					<li><span class="dashicons dashicons-slack"></span> Slack</li>
					<li><span class="dashicons dashicons-xing"></span> Xing</li>
				</ul>
			
			
				<?php echo do_shortcode('[ecs-list-events cat="'.$post_slug.'" past="yes" order="DESC"]'); ?>

			</div>
		</div>

	</div><!-- .entry-content -->

	

	<footer class="entry-footer">
		<?php krafit_planck_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

