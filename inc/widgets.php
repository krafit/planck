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
			<span class="dashicons dashicons-twitter"></span>
			<span class="widget-content">
				<strong>Folge uns: <a href="https://twitter.com/wpmeetups/" target="_blank">@wpmeetups</a></strong>
			</span>
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
