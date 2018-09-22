<?php

class wpmg_twitter extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => __( 'Verweis auf den Twitter-Account der deutschen WP Meetups', 'wpmg-widget' ) );
		parent::__construct( false, __( 'Twitter Widget', 'wpmg-widget' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		extract( $args );
		
		echo $before_widget;

		?>

		<div class="wpmg_twitter widget_nav_menu">
			<ul>
				<li>
					<a href="https://twitter.com/wpmeetups/" target="_blank" aria-label="Twitter Logo"><span class="dashicons dashicons-twitter"></span></a>
					<span class="widget-content">
						<strong>Folge uns auf Twitter: <br><a href="https://twitter.com/wpmeetups/" target="_blank">@wpmeetups</a></strong>
					</span>
				</li>
				<li>
					<a href="https://dewp.space/@meetups" target="_blank"><svg title="Mastodon Logo" aria-label="Mastodon Logo" class="icon icon-mastodon" xmlns="http://www.w3.org/2000/svg" width="230.842" height="247.477" viewBox="0 0 216.414 232.01"><path class="mastodon-blue" d="M211.807 139.088c-3.18 16.366-28.492 34.277-57.562 37.748-15.159 1.809-30.084 3.471-45.999 2.741-26.027-1.192-46.565-6.212-46.565-6.212 0 2.534.156 4.946.469 7.202 3.384 25.687 25.47 27.225 46.391 27.943 21.116.723 39.919-5.206 39.919-5.206l.867 19.09s-14.77 7.931-41.08 9.39c-14.51.797-32.525-.365-53.507-5.919C9.232 213.82 1.406 165.311.209 116.091c-.365-14.613-.14-28.393-.14-39.918 0-50.33 32.976-65.083 32.976-65.083C49.672 3.454 78.204.242 107.865 0h.729c29.66.242 58.21 3.454 74.837 11.09 0 0 32.975 14.752 32.975 65.082 0 0 .414 37.134-4.599 62.916"/><path fill="#fff" d="M177.51 80.077v60.941h-24.144v-59.15c0-12.469-5.246-18.797-15.74-18.797-11.602 0-17.417 7.507-17.417 22.352V117.8H96.207V85.423c0-14.845-5.816-22.352-17.418-22.352-10.494 0-15.74 6.328-15.74 18.797v59.15H38.905V80.077c0-12.455 3.171-22.352 9.541-29.675 6.569-7.322 15.171-11.076 25.85-11.076 12.355 0 21.711 4.748 27.898 14.247l6.013 10.082 6.015-10.082c6.185-9.498 15.542-14.247 27.898-14.247 10.677 0 19.28 3.753 25.85 11.076 6.369 7.322 9.54 17.22 9.54 29.675"/></svg></a>
					<span class="widget-content">
						<strong>Folge uns auf Mastodon: <br><a href="https://dewp.space/@meetups" target="_blank">@meetups@dewp.space</a></strong>
					</span>
				</li>
			</ul>
		</div><!-- end .wpmg_twitter -->

		<?php

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

} // end class wpmg_twitter

function wpmg_twitter_widget_init() {
	register_widget( 'wpmg_twitter' );
}
add_action( 'widgets_init', 'wpmg_twitter_widget_init' );
