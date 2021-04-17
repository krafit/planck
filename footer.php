<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package krafit_planck
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrap">

<?php get_sidebar(); ?>

			<div class="site-info">
				&copy; 2012-2021 Simon Kraft | <a href="https://wpmeetups.de/impressum">Impressum</a> | <a href="https://wpmeetups.de/datenschutz">Datenschutz</a>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
