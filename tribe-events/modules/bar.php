<?php
/**
 * Events Navigation Bar Module Template
 * Renders our events navigation bar used across our views
 *
 * $filters and $views variables are loaded in and coming from
 * the show funcion in: lib/Bar.php
 *
 * @package TribeEventsCalendar
 *
 */
?>

<?php do_action( 'tribe_events_bar_before_template' ) ?>


<?php
do_action( 'tribe_events_bar_after_template' );
