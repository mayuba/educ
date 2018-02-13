<?php
/**
 * Template for displaying tab nav of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/tabs/tabs.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$review_is_enable = thim_plugin_active( 'learnpress-course-review/learnpress-course-review.php' );
$student_list_enable = thim_plugin_active( 'learnpress-students-list/learnpress-students-list.php' );
?>

    <div id="tab-course-description" class="row_content_course">
        <div class="sc_heading clone_title  text-left">
            <h2 class="title"><?php echo esc_html__( 'About this Course', 'eduma' );?></h2>
            <div class="clone"><?php echo esc_html__( 'About this Course', 'eduma' );?></div>
        </div>
        <?php do_action( 'learn_press_begin_course_content_course_description' ); ?>
        <div class="thim-course-content">
            <?php the_content(); ?>
        </div>
        <?php thim_course_info(); ?>
        <?php do_action( 'learn_press_end_course_content_course_description' ); ?>
    </div>
    <div id="tab-course-curriculum" class="row_content_course">
        <div class="sc_heading clone_title  text-left">
            <h2 class="title"><?php echo esc_html__( 'Course Curriculum', 'eduma' );?></h2>
            <div class="clone"><?php echo esc_html__( 'Course Curriculum', 'eduma' );?></div>
        </div>
        <?php learn_press_course_curriculum_tab(); ?>
    </div>
    <div id="tab-course-instructor" class="row_content_course">
        <div class="sc_heading clone_title  text-left">
            <h2 class="title"><?php echo esc_html__( 'Instructors', 'eduma' );?></h2>
            <div class="clone"><?php echo esc_html__( 'Instructors', 'eduma' );?></div>
        </div>
        <?php thim_about_author(); ?>
    </div>
<?php if ( $review_is_enable ) : ?>
    <div class="tab-pane <?php if($active_tab=='review') echo 'active';?>" id="tab-course-review">
        <div class="sc_heading clone_title  text-left">
            <h2 class="title"><?php echo esc_html__( 'Reviews', 'eduma' );?></h2>
            <div class="clone"><?php echo esc_html__( 'Reviews', 'eduma' );?></div>
        </div>
        <?php thim_course_review(); ?>
    </div>
<?php endif; ?>
<?php if ( $student_list_enable ) : ?>
    <div id="tab-course-student-list" class="row_content_course">
        <?php learn_press_course_students_list(); ?>
    </div>
<?php endif; ?>