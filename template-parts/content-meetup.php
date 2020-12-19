<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package krafit_planck
 */

global $post; $post_slug=$post->post_name;

	$wpmg_home = get_post_meta(get_the_ID(), 'wpmg_home', TRUE);
	$wpmg_mail = get_post_meta(get_the_ID(), 'wpmg_mail', TRUE);
	$wpmg_mailinglist = get_post_meta(get_the_ID(), 'wpmg_mailinglist', TRUE);
	$wpmg_meetupcom = get_post_meta(get_the_ID(), 'wpmg_meetupcom', TRUE);
	$wpmg_wptv = get_post_meta(get_the_ID(), 'wpmg_wptv', TRUE);
	$wpmg_twitter = get_post_meta(get_the_ID(), 'wpmg_twitter', TRUE);
	$wpmg_facebook = get_post_meta(get_the_ID(), 'wpmg_facebook', TRUE);
	$wpmg_gplus = get_post_meta(get_the_ID(), 'wpmg_gplus', TRUE);
	$wpmg_slack = get_post_meta(get_the_ID(), 'wpmg_slack', TRUE);
	$wpmg_xing = get_post_meta(get_the_ID(), 'wpmg_xing', TRUE);
	$wpmg_rotation = get_post_meta(get_the_ID(), 'wpmg_rotation', TRUE);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content content">
		<div class="row">	
			<div class="meetup-main">

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<?php the_content(); ?>

				<?php 
					$slug = get_post_field( 'post_name', get_post() );
					$dates = get_posts(  array(
						'post_type' => 'events',
						'numberposts' => 12,
						'tax_query' => array(
				        array(
				            'taxonomy' => 'meetup-group',
				            'field'    => 'slug',
				            'terms'    => array( $slug )
				        )
				    )
					));
					if ( $dates ) {  ?>
						
						<div class="single-events-list">
							<div class="row">
								<div class="column half no-margin"><h5>Nächste WP Meetups</h5></div>
								<div class="column half no-margin"><?php if ( is_user_logged_in() ) : ?><h5><a href="">Alle Termine zeigen</a></h5><?php endif; ?></div>
							</div>
						
							<ul class="ecs-event-list">
							<?php 
							foreach ( $dates as $post ) : 
							        setup_postdata( $post );
							        ?>
							        <li class="ecs-event">
							        	<a href="<?php the_permalink(); ?>"><h4 class="entry-title summary"><?php the_title(); ?></h4></a>
							        	<span class="duration time"><span class="tribe-event-date-start"><?php echo get_post_meta( get_the_ID(), 'meetup_event_date', true ) . ' | ' . get_post_meta( get_the_ID(), 'meetup_event_time', true ); ?></span>
							        </li>
							        <?php
							    endforeach; 
							    wp_reset_postdata();
							?>
							</ul>
						</div>

					<?php }

				?>

			</div>
			<div class="meetup-sidebar">

				<?php
					if ( has_post_thumbnail() ) { 
	    				the_post_thumbnail( 'meetup-logo' ); 
					}
				?>

				<ul class="meetup-meta">

				<?php

					if ($wpmg_home != "") {
						echo '<li><a href="' . $wpmg_home . '" target="_blank"><span class="dashicons dashicons-wordpress"></span> Website</a></li>';
					}
					if ($wpmg_mail != "") {
						echo '<li><a href="mailto:' . $wpmg_mail . '" target="_blank"><span class="dashicons dashicons-email"></span> Kontakt</a></li>';
					}
					if ($wpmg_mailinglist != "") {
						echo '<li><a href="' . $wpmg_mailinglist . '" target="_blank"><span class="dashicons dashicons-megaphone"></span> Mailingliste</a></li>';
					}
					if ($wpmg_meetupcom != "") {
						echo '<li><a href="' . $wpmg_meetupcom . '" target="_blank"><span class="dashicons dashicons-nametag"></span> Meetup.com</a></li>';
					}
					if ($wpmg_wptv != "") {
						echo '<li><a href="' . $wpmg_wptv . '" target="_blank"><span class="dashicons dashicons-format-video"></span> Videos auf wp.tv</a></li>';
					}
					if ($wpmg_twitter != "") {
						echo '<li><a href="' . $wpmg_twitter . '" target="_blank"><span class="dashicons dashicons-twitter"></span> Twitter</a></li>';
					}
					if ($wpmg_facebook != "") {
						echo '<li><a href="' . $wpmg_facebook . '" target="_blank"><span class="dashicons dashicons-facebook"></span> Facebook</a></li>';
					}
					if ($wpmg_gplus != "") {
						echo '<li><a href="' . $wpmg_gplus . '" target="_blank"><span class="dashicons dashicons-googleplus"></span> Google+</a></li>';
					}
					if ($wpmg_slack != "") {
						echo '<li><a href="' . $wpmg_slack . '" target="_blank"><img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0ic3ZnMiIgeG1sbnM6c3ZnPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIiB4bWxuczpjYz0iaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbnMjIiB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIyNjcuMDY5IDY5LjA3NSAyMCAyMCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAyNjcuMDY5IDY5LjA3NSAyMCAyMCIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PGcgaWQ9ImcxMiIgdHJhbnNmb3JtPSJzY2FsZSgwLjEsMC4xKSI+PHBhdGggaWQ9InBhdGgyNCIgZmlsbD0iIzdDN0M3QyIgZD0iTTI3NTMuNDE4LDc4MS43NDFsOC40MjMsMjUuMTUxbDI2LjEzMy04Ljc1bC04LjQyOC0yNS4xNTFMMjc1My40MTgsNzgxLjc0MSIvPjxwYXRoIGlkPSJwYXRoMjYiIGZpbGw9IiM3QzdDN0MiIGQ9Ik0yNzUzLjQxOCw3ODEuNzQxbDguNDIzLDI1LjE1MWwyNi4xMzMtOC43NWwtOC40MjgtMjUuMTUxTDI3NTMuNDE4LDc4MS43NDEiLz48cGF0aCBpZD0icGF0aDI4IiBmaWxsPSIjN0M3QzdDIiBkPSJNMjgyNi4zMDMsODA2LjY4N2wtMTIuNjc2LDQuMjM4bDQuMzk1LDEzLjExNWMxLjc3Nyw1LjMwMy0xLjA5NCwxMS4wNDUtNi4zOTYsMTIuODIyYy0xLjE1MiwwLjM5MS0yLjMzNCwwLjU1Ny0zLjQ3NywwLjUzN2MtNC4xNDEtMC4xMTctNy45NTktMi43NzMtOS4zNDYtNi45MjRsLTQuMzk1LTEzLjEwNWwtMjYuMTMzLDguNzVsNC4zOTUsMTMuMTA1YzEuNzc3LDUuMzEyLTEuMDg0LDExLjA1NS02LjM5MiwxMi44MzJjLTEuMTU3LDAuMzgxLTIuMzI5LDAuNTU3LTMuNDg2LDAuNTE4Yy00LjEzNi0wLjA5OC03Ljk1NC0yLjc1NC05LjM0Ni02LjkxNGwtNC4zOS0xMy4xMDVsLTEyLjY3MSw0LjIzOGMtMS4xNTcsMC4zOTEtMi4zMjksMC41NTctMy40ODYsMC41MzdjLTQuMTM2LTAuMTE3LTcuOTU0LTIuNzczLTkuMzQ2LTYuOTI0Yy0xLjc4Mi01LjMyMiwxLjA4NC0xMS4wNjQsNi4zOTYtMTIuODQybDEyLjY2Ni00LjIzOGwtOC40MjMtMjUuMTQ2bC0xMi42NzEsNC4yNDNjLTEuMTUyLDAuMzg2LTIuMzI5LDAuNTUyLTMuNDgxLDAuNTIyYy00LjEzNi0wLjEwNy03Ljk1OS0yLjc2NC05LjM1MS02LjkxNGMtMS43NzctNS4zMDgsMS4wODktMTEuMDU1LDYuMzk2LTEyLjgzMmwxMi42NjYtNC4yNDhsLTQuMzktMTMuMTFjLTEuNzc3LTUuMzA4LDEuMDg0LTExLjA1LDYuMzk2LTEyLjgzMmM1LjMwOC0xLjc3MiwxMS4wNSwxLjA4OSwxMi44MjIsNi4zOTZsNC4zOTUsMTMuMTFsMjYuMTMzLTguNzQ1bC00LjM5NS0xMy4xMWMtMS43NzctNS4zMTIsMS4wODQtMTEuMDYsNi4zOTItMTIuODMyYzUuMzA4LTEuNzgyLDExLjA1LDEuMDc5LDEyLjgzNyw2LjM4N2w0LjM4NSwxMy4xMWwxMi42NzYtNC4yMzhjNS4zMDMtMS43ODIsMTEuMDQ1LDEuMDg0LDEyLjgzMiw2LjM5MmMxLjc3Nyw1LjMwOC0xLjA5NCwxMS4wNS02LjM5NiwxMi44MzJsLTEyLjY3Niw0LjI0M2w4LjQyOCwyNS4xNTFsMTIuNjc2LTQuMjQ4YzUuMzAzLTEuNzcyLDExLjA0NSwxLjA4OSwxMi44MjIsNi4zOTJDMjgzNC40NzcsNzk5LjE1OCwyODMxLjYwNiw4MDQuOSwyODI2LjMwMyw4MDYuNjg3TDI4MjYuMzAzLDgwNi42ODd6IE0yODYwLjI4OCw3NjMuMDU5Yy0yMC4xNjYtNjcuMTkyLTQ5LjI4Ny04Mi44NjYtMTE2LjQ3NS02Mi43MWMtNjcuMTkyLDIwLjE2MS04Mi44NzEsNDkuMjc3LTYyLjcxNSwxMTYuNDY1YzIwLjE2Niw2Ny4xOTcsNDkuMjc3LDgyLjg4MSwxMTYuNDc1LDYyLjcyNUMyODY0Ljc3LDg1OS4zNzIsMjg4MC40NTQsODMwLjI1MSwyODYwLjI4OCw3NjMuMDU5Ii8+PC9nPjwvc3ZnPg=="> Slack</a></li>';
					}
					if ($wpmg_xing != "") {
						echo '<li><a href="' . $wpmg_xing . '" target="_blank"><img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0ic3ZnMiIgeG1sbnM6c3ZnPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIiB4bWxuczpjYz0iaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbnMjIiB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIyNjcuMDY5IDY5LjA3NSAyMCAyMCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAyNjcuMDY5IDY5LjA3NSAyMCAyMCIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PHBhdGggZmlsbD0iIzdDN0M3QyIgZD0iTTI3MC4zNDgsNzMuMTM1Yy0wLjE2NywwLTAuMzA5LDAuMDU5LTAuMzc5LDAuMTc0Yy0wLjA3NCwwLjEyLTAuMDYyLDAuMjcyLDAuMDE2LDAuNDI4bDEuODgzLDMuMjU5YzAuMDAzLDAuMDA3LDAuMDAzLDAuMDEsMCwwLjAxN2wtMi45NTksNS4yMjJjLTAuMDc3LDAuMTU0LTAuMDczLDAuMzA4LDAsMC40MjdjMC4wNzEsMC4xMTUsMC4xOTYsMC4xOSwwLjM2NCwwLjE5aDIuNzg1YzAuNDE3LDAsMC42MTctMC4yOCwwLjc1OS0wLjUzOGMwLDAsMi44OTQtNS4xMTksMy4wMDctNS4zMTdjLTAuMDExLTAuMDE4LTEuOTE1LTMuMzM5LTEuOTE1LTMuMzM5Yy0wLjEzOS0wLjI0Ny0wLjM0OC0wLjUyMi0wLjc3NS0wLjUyMkgyNzAuMzQ4eiIvPjxwYXRoIGlkPSJwYXRoMTkzNzUiIGZpbGw9IiM3QzdDN0MiIGQ9Ik0yODIuMDQ5LDY5LjMyMmMtMC40MTcsMC0wLjU5NywwLjI2Mi0wLjc0NiwwLjUzYzAsMC02LDEwLjY0MS02LjE5OCwxMC45OWMwLjAxLDAuMDE5LDMuOTU3LDcuMjYsMy45NTcsNy4yNmMwLjEzOCwwLjI0OCwwLjM1MiwwLjUzMSwwLjc3OSwwLjUzMWgyLjc4MWMwLjE2OSwwLDAuMjk5LTAuMDYzLDAuMzctMC4xNzhjMC4wNzQtMC4xMTgsMC4wNzItMC4yNzYtMC4wMDYtMC40MzFsLTMuOTI2LTcuMTc0Yy0wLjAwNC0wLjAwNy0wLjAwNC0wLjAxMywwLTAuMDE5bDYuMTY2LTEwLjkwM2MwLjA3Ny0wLjE1NCwwLjA3OS0wLjMxMSwwLjAwNi0wLjQzYy0wLjA3LTAuMTE1LTAuMjAyLTAuMTc4LTAuMzctMC4xNzhIMjgyLjA0OXoiLz48L3N2Zz4="> Xing</a></li>';
					}
					// if ($wpmg_rotation != "") {
					// 	echo '<li><a href="' . $wpmg_rotation . '" target="_blank"><span class="dashicons dashicons-wordpress"></span> Webseite</a></li>';
					// }

				?>
					
				</ul>

			</div>
		</div>

	</div><!-- .entry-content -->

</article><!-- #post-## -->

<?php // the_post_navigation(); ?>

