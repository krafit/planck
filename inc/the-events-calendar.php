<?php 

	/**
	 * Replaces tribe_event_meta_cats();
	 */

	function krafit_event_meta_cats( $label=null, $separator=', ')  {
		if( !$label ) { $label = ''; }

		$tribe_ecp = TribeEvents::instance();

		$list = apply_filters('krafit_event_meta_cats', get_the_term_list( get_the_ID(), $tribe_ecp->get_event_taxonomy(), '<h3 class="event-preheader">'.$label.'', $separator, '</h3>' ));

		echo $list;
	}

	/**
	 * Remove Menu from Admin Bar.
	 */

	function krafit_plank_event_bar() {
		global $wp_admin_bar;
			$wp_admin_bar->remove_menu('tribe-events');
	}

	add_action( 'wp_before_admin_bar_render', 'krafit_plank_event_bar' );