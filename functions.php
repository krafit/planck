<?php
/**
 * krafit_planck functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package krafit_planck
 */

if ( ! function_exists( 'krafit_planck_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function krafit_planck_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on krafit_planck, use a find and replace
	 * to change 'krafit_planck' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'krafit_planck', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
		add_image_size( 'meetup-logo', 170, 170, true ); // Meetup Logo, hard crop mode

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'krafit_planck' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

}
endif; // krafit_planck_setup
add_action( 'after_setup_theme', 'krafit_planck_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function krafit_planck_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'krafit_planck_content_width', 640 );
}
add_action( 'after_setup_theme', 'krafit_planck_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function krafit_planck_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'krafit_planck' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="column fourth widget footer-row %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'krafit_planck_widgets_init' );



/**
 * Enqueue scripts and styles.
 */
function krafit_planck_scripts() {
	wp_enqueue_style( 'planck-style', get_template_directory_uri() . '/style.min.css' );

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,300,600' );

	wp_enqueue_style( 'dashicons' );
	
	wp_enqueue_script( 'krafit_planck-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'krafit_planck_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function planck_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'planck_skip_link_focus_fix' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom widgets.
 */
require get_template_directory() . '/inc/widgets.php';


/**
 * Method of listing upcoming events, complete with functional pagination
 * if WP-PageNavi is installed.
 *
 * Implemented as a shortcode.
 *
 * @see https://wordpress.org/plugins/wp-pagenavi/
 */
function krafit_planck_meetup_list() {
	// Safety first! Bail in the event TEC is inactive/not loaded yet
				
	$date  = get_post_meta( get_the_ID(), 'meetup_event_timestamp', true );
	
	// Build our query, adopt the default number of events to show per page
	$upcoming = new WP_Query( array(
		'post_type' => 'events',
		'posts_per_page' => '9',
		'order' => 'ASC',
		'orderby' => 'meta_value',
		'meta_key' => 'meetup_event_timestamp'
	) );

	

	echo '<ul class="ecs-event-list">';
	// If we got some results, let's list 'em
	while ( $upcoming->have_posts() ) {
		$upcoming->the_post();
		$title = get_the_title();
		$link = get_post_meta( get_the_ID(), 'meetup_event_url', true );
		$term_obj_list = get_the_terms( $post->ID, 'meetup-group' );
		$group = join(', ', wp_list_pluck($term_obj_list, 'name'));
		$group_slug = join(', ', wp_list_pluck($term_obj_list, 'slug'));
		
		// Of course, you could and probably would expand on this
		// and add more info and better formatting
		echo '<li class="ecs-event">';

		echo '<span class="event-preheader"><a href="https://wpmeetups.de/meetup/' . $group_slug . '">' . $group . '</a></span>';
		echo '<h4 class="entry-title summary"><a href="'. $link . '">' . $title . '</a></h4>';
		echo '<span class="duration time"><span class="tribe-event-date-start">' . get_post_meta( get_the_ID(), 'meetup_event_date', true ) . ' | ' . get_post_meta( get_the_ID(), 'meetup_event_time', true ) . '</span></span></li>';
	}
	echo '</ul>';
	
		
	// Clean up
	wp_reset_query();
}

/**
 * Method of listing upcoming events, complete with functional pagination
 * if WP-PageNavi is installed.
 *
 * Implemented as a shortcode.
 *
 * @see https://wordpress.org/plugins/wp-pagenavi/
 */
function krafit_planck_meetup_shortlist() {
	// Safety first! Bail in the event TEC is inactive/not loaded yet
				
	$date  = get_post_meta( get_the_ID(), 'meetup_event_timestamp', true );
	
	// Build our query, adopt the default number of events to show per page
	$upcoming = new WP_Query( array(
		'post_type' => 'events',
		'posts_per_page' => '5',
		'order' => 'ASC',
		'orderby' => 'meta_value',
		'meta_key' => 'meetup_event_timestamp'
	) );

	

	echo '<ol class="hfeed vcalendar">';
	// If we got some results, let's list 'em
	while ( $upcoming->have_posts() ) {
		$upcoming->the_post();
		$link = get_post_meta( get_the_ID(), 'meetup_event_url', true );
		$term_obj_list = get_the_terms( $post->ID, 'meetup-group' );
		$group = join(', ', wp_list_pluck($term_obj_list, 'name'));
		
		// Of course, you could and probably would expand on this
		// and add more info and better formatting
		echo '<li class="tribe-events-list-widget-events">';

		echo '<span class="event-preheader"><a href="'. $link . '">' . $group . '</a></span><br>';
		echo '<span class="duration time"><span class="tribe-event-date-start">' . get_post_meta( get_the_ID(), 'meetup_event_date', true ) . '</span></span></li>';
	}
	echo '</ol>';
	
		
	// Clean up
	wp_reset_query();
}

// Create a new shortcode to list upcoming events, optionally
// with pagination
add_shortcode( 'meetup-liste', 'krafit_planck_meetup_list' );

function my_cptui_change_posts_per_page( $query ) {
    if ( is_admin() || ! $query->is_main_query() ) {
       return;
    }

    if ( is_post_type_archive( 'meetup' ) ) {
       $query->set( 'posts_per_page', 100 );
    }
}
add_filter( 'pre_get_posts', 'my_cptui_change_posts_per_page' );