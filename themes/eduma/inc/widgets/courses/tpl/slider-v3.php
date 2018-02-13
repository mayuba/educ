<?php

global $post;
$limit        = $instance['limit'];
$item_visible = $instance['slider-options']['item_visible'];
$pagination   = $instance['slider-options']['show_pagination'] ? $instance['slider-options']['show_pagination'] : 0;
$navigation   = $instance['slider-options']['show_navigation'] ? $instance['slider-options']['show_navigation'] : 0;
$autoplay     = isset( $instance['slider-options']['auto_play'] ) ? $instance['slider-options']['auto_play'] : 0;
$featured     = !empty( $instance['featured'] ) ? true : false;
$condition    = array(
    'post_type'           => 'lp_course',
    'posts_per_page'      => $limit,
    'ignore_sticky_posts' => true,
);
$sort         = $instance['order'];

if ( $sort == 'category' && $instance['cat_id'] && $instance['cat_id'] != 'all' ) {
    if ( get_term( $instance['cat_id'], 'course_category' ) ) {
        $condition['tax_query'] = array(
            array(
                'taxonomy' => 'course_category',
                'field'    => 'term_id',
                'terms'    => $instance['cat_id']
            ),
        );
    }
}


if ( $sort == 'popular' ) {
    global $wpdb;
    $query = $wpdb->prepare( "
	  SELECT ID, a+IF(b IS NULL, 0, b) AS students FROM(
		SELECT p.ID as ID, IF(pm.meta_value, pm.meta_value, 0) as a, (
	SELECT COUNT(*)
  FROM (SELECT COUNT(item_id), item_id, user_id FROM {$wpdb->prefix}learnpress_user_items GROUP BY item_id, user_id) AS Y
  GROUP BY item_id
  HAVING item_id = p.ID
) AS b
FROM {$wpdb->posts} p
LEFT JOIN {$wpdb->postmeta} AS pm ON p.ID = pm.post_id  AND pm.meta_key = %s
WHERE p.post_type = %s AND p.post_status = %s
GROUP BY ID
) AS Z
ORDER BY students DESC
	  LIMIT 0, $limit
 ", '_lp_students', 'lp_course', 'publish' );

    $post_in = $wpdb->get_col( $query );

    $condition['post__in'] = $post_in;
    $condition['orderby']  = 'post__in';

}

if ( $featured ) {
    $condition['meta_query'] = array(
        array(
            'key'   => '_lp_featured',
            'value' => 'yes',
        )
    );
}

$the_query = new WP_Query( $condition );

if ( $the_query->have_posts() ) :
    if ( $instance['title'] ) {
        echo ent2ncr( $args['before_title'] . $instance['title'] . $args['after_title'] );
    }

    ?>
    <div class="thim-carousel-wrapper thim-course-carousel thim-course-grid" data-visible="<?php echo esc_attr( $item_visible ); ?>"
         data-pagination="<?php echo esc_attr( $pagination ); ?>" data-navigation="<?php echo esc_attr( $navigation ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>">
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="course-item">

                <?php
                // @thim
                do_action( 'thim_courses_loop_item_thumb' );
                ?>

                <div class="thim-course-content">
                    <?php learn_press_courses_loop_item_instructor(); ?>
                    <?php
                    //thim_courses_loop_item_author();
                    //do_action( 'learn_press_before_the_title' );
                    the_title( sprintf( '<h2 class="course-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                    do_action( 'learn_press_after_the_title' );
                    ?>
                    <div class="course-meta">
                        <?php learn_press_courses_loop_item_instructor(); ?>
                        <?php thim_course_ratings(); ?>
                        <?php learn_press_courses_loop_item_students(); ?>
                        <?php thim_course_ratings_count(); ?>
                        <?php learn_press_courses_loop_item_price(); ?>
                    </div>

                    <div class="course-description">
                        <?php
                        do_action( 'learn_press_before_course_content' );
                        echo thim_excerpt(25);
                        do_action( 'learn_press_after_course_content' );
                        ?>
                    </div>
                    <?php learn_press_courses_loop_item_price(); ?>
                    <div class="course-readmore">
                        <a href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'Read More', 'eduma' ); ?></a>
                    </div>
                </div>

            </div>
            <?php
        endwhile;
        ?>
    </div>
    <?php
endif;
wp_reset_postdata();