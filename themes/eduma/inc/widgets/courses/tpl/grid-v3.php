<?php
global $post;

$limit             = $instance['limit'];
$columns           = $instance['grid-options']['columns'];
$view_all_course   = ( $instance['view_all_courses'] && '' != $instance['view_all_courses'] ) ? $instance['view_all_courses'] : false;
$view_all_position = ( $instance['view_all_position'] && '' != $instance['view_all_position'] ) ? $instance['view_all_position'] : 'top';
$sort              = $instance['order'];
$feature        = !empty( $instance['featured'] ) ? true : false ;

$condition = array(
    'post_type'           => 'lp_course',
    'posts_per_page'      => $limit,
    'ignore_sticky_posts' => true,
);

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

if( $feature ) {
    $condition['meta_query'] = array(
        array(
            'key' => '_lp_featured',
            'value' =>  'yes',
        )
    );
}

$the_query = new WP_Query( $condition );

if ( $the_query->have_posts() ) :
    if ( $instance['title'] ) {
        echo ent2ncr( $args['before_title'] . $instance['title'] . $args['after_title'] );
    }
    if ( $view_all_course && 'top' == $view_all_position ) {
        echo '<a class="view-all-courses position-top" href="' . get_post_type_archive_link( 'lp_course' ) . '">' . esc_attr( $view_all_course ) . '</a>';
    }
    ?>
    <div class="thim-course-grid">
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="lpr_course <?php echo 'course-grid-' . $columns; ?>">
                <div class="course-item">
                    <?php
                    // @thim
                    do_action( 'thim_courses_loop_item_thumb' );
                    ?>
                    <div class="thim-course-content">
                        <?php learn_press_courses_loop_item_instructor(); ?>
                        <?php
                        the_title( sprintf( '<h2 class="course-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
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
            </div>
            <?php
        endwhile;
        ?>
    </div>
    <?php
    if ( $view_all_course && 'bottom' == $view_all_position ) {
        echo '<a class="view-all-courses position-bottom" href="' . get_post_type_archive_link( 'lp_course' ) . '">' . esc_attr( $view_all_course ) . '</a>';
    }

endif;

wp_reset_postdata();
