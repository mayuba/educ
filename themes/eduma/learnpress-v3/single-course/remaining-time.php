<?php
/**
 * Template for displaying the remaining time for course.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) or die();

if ( ! isset( $remaining_time ) ) {
	return;
}

?>
<div class="course-remaining-time message message-warning learn-press-message">
    <p>
		<?php learn_press_label_html( 'Enrolled', 'enrolled' ); ?>
		<?php echo sprintf( __( 'You have %s remaining for the course', 'learnpress' ), $remaining_time ); ?>
    </p>
</div>
