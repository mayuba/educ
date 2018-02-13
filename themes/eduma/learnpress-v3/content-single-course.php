<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-single-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
}

$course = LP()->global['course'];
$user   = learn_press_get_current_user();
$is_enrolled      = $user->has( 'enrolled-course', $course->get_id() );
/**
 * @deprecated
 */
do_action( 'learn_press_before_main_content' );
do_action( 'learn_press_before_single_course' );
do_action( 'learn_press_before_single_course_summary' );

/**
 * @since 3.0.0
 */
do_action( 'learn-press/before-main-content' );

do_action( 'learn-press/before-single-course' );

?>

<?php if( get_theme_mod( 'thim_layout_content_page', 'normal' ) == 'new-1' ) {?>

    <div class="content_course_2">

        <div class="row">

            <div class="col-md-9">

                <div id="lp-single-course" class="learnpress-content learn-press">

                    <div class="header_single_content">

                        <span class="bg_header"></span>

                        <?php do_action( 'thim_single_course_before_meta' );?>

                        <div class="course-meta">

                            <?php do_action( 'thim_single_course_meta' );?>

                        </div>

                    </div>

                </div>

                <div class="course-summary">
                    <?php
                    /**
                     * @since 3.0.0
                     *
                     * @see learn_press_single_course_summary()
                     */
                    do_action( 'learn-press/single-course-summary' );
                    ?>
                </div>
                <?php thim_related_courses(); ?>

            </div>

            <div id="sidebar" class="col-md-3 sticky-sidebar">

                <div class="course_right">

                    <?php learn_press_course_progress(); ?>

                    <div class="course-payment">

                        <?php do_action( 'thim_single_course_payment' );?>

                    </div>

                    <?php do_action( 'thim_before_sidebar_course' ); ?>

                    <div class="menu_course">
                        <?php
                        $review_is_enable = thim_plugin_active( 'learnpress-course-review/learnpress-course-review.php' );
                        $student_list_enable = thim_plugin_active( 'learnpress-students-list/learnpress-students-list.php' );
                        $theme_options_data = get_theme_mods();
                        $group_tab = isset($theme_options_data['group_tabs_course']) ? $theme_options_data['group_tabs_course'] : array('description', 'curriculum', 'instructor', 'review');
                        $active_tab = isset($theme_options_data['default_tab_course']) ? $theme_options_data['default_tab_course'] : 'description';
                        $arr_variable = array();
                        $arr_variable['description'] = array("title"=>esc_html__( 'Description', 'eduma' ), "icon"=>"fa-bookmark");
                        $arr_variable['curriculum'] = array("title"=>esc_html__( 'Curriculum', 'eduma' ), "icon"=>"fa-cube");
                        $arr_variable['instructor'] = array("title"=>esc_html__( 'Instructors', 'eduma' ), "icon"=>"fa-user");
                        $arr_variable['review'] = array("title"=>esc_html__( 'Review', 'eduma' ), "icon"=>"fa-comments");
                        ?>
                        <ul>
                            <?php for( $i=0; $i<count($group_tab); $i++ ) {?>
                                <?php if( $group_tab[$i]!='review' || ( $group_tab[$i]=='review' && $review_is_enable ) ) {?>
                                    <li role="presentation" <?php if($active_tab==$group_tab[$i]) echo 'class="active"';?>>
                                        <?php
                                        //var_dump($arr_variable[$group_tab[$i]]["title"]);
                                        ?>
                                        <a href="#tab-course-<?php echo $group_tab[$i];?>" data-toggle="tab">
                                            <i class="fa <?php echo $arr_variable[$group_tab[$i]]["icon"];?>"></i>
                                            <span><?php echo $arr_variable[$group_tab[$i]]["title"]; ?></span>
                                        </a>
                                    </li>
                                <?php }?>
                            <?php }?>
                            <?php if ( $student_list_enable ) : ?>
                                <li role="presentation">
                                    <a href="#tab-course-student-list" data-toggle="tab">
                                        <i class="fa fa-list"></i>
                                        <span><?php esc_html_e( 'Student List', 'eduma' ); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="social_share">
                        <?php do_action( 'thim_social_share' ); ?>
                    </div>

                </div>

            </div>

        </div>

    </div>

<?php } else {?>

    <div id="learn-press-course" class="course-summary learn-press">

        <?php the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' ); ?>

        <div class="course-meta">
            <?php do_action( 'thim_single_course_meta' );?>
        </div>
        <div class="course-payment">
            <?php do_action( 'thim_single_course_payment' );?>
        </div>
        <div class="course-summary">
            <?php
            /**
             * @since 3.0.0
             *
             * @see learn_press_single_course_summary()
             */
            do_action( 'learn-press/single-course-summary' );
            ?>
        </div>
        <?php thim_related_courses(); ?>
    </div>

<?php }?>

<?php

/**
 * @since 3.0.0
 */
do_action( 'learn-press/after-main-content' );

do_action( 'learn-press/after-single-course' );

/**
 * @deprecated
 */
do_action( 'learn_press_after_single_course_summary' );
do_action( 'learn_press_after_single_course' );
do_action( 'learn_press_after_main_content' );
?>