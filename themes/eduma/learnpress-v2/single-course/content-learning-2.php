<?php
/**
 * Template for displaying content of learning course
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$review_is_enable = thim_plugin_active( 'learnpress-course-review/learnpress-course-review.php' );
$student_list_enable = thim_plugin_active( 'learnpress-students-list/learnpress-students-list.php' );
$course = LP()->global['course'];
$hide_students_list = get_post_meta( $course->ID, '_lp_hide_students_list', true );

$theme_options_data = get_theme_mods();
$group_tab = isset($theme_options_data['group_tabs_course']) ? $theme_options_data['group_tabs_course'] : array('description', 'curriculum', 'instructor', 'review');
$active_tab = isset($theme_options_data['default_tab_course']) ? $theme_options_data['default_tab_course'] : 'description';
$active_tab = 'curriculum';
$arr_variable = array();
$arr_variable['description'] = array("title"=>esc_html__( 'Description', 'eduma' ), "icon"=>"fa-bookmark");
$arr_variable['curriculum'] = array("title"=>esc_html__( 'Curriculum', 'eduma' ), "icon"=>"fa-cube");
$arr_variable['instructor'] = array("title"=>esc_html__( 'Instructors', 'eduma' ), "icon"=>"fa-user");
$arr_variable['review'] = array("title"=>esc_html__( 'Review', 'eduma' ), "icon"=>"fa-comments");
?>

<?php do_action( 'learn_press_before_content_learning' );?>

<div class="course-learning-summary">

	<?php do_action( 'learn_press_content_learning_summary' ); ?>

</div>
<div id="course-learning">
    <div class="menu_content_course">
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
            <?php learn_press_course_curriculum(); ?>
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
    </div>
</div>

<?php do_action( 'learn_press_after_content_learning' );?>
