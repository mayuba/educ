<?php
/**
 * Created by PhpStorm.
 * User: tu
 * Date: 12/14/17
 * Time: 2:56 PM
 */

$args = array( 'item' => $item, 'section' => $section );
$user = LP_Global::user();
$item_type = str_replace( 'lp_', '', $item->get_item_type() );

/**
 * @since 3.0.0
 */
do_action( 'learn-press/before-section-loop-item', $item );

if ( $user->can_view_item( $item->get_id() ) ) {
    ?>
    <a class="<?php echo $item_type;?>-title course-item-title button-load-item" href="<?php echo $item->get_permalink(); ?>">
        <?php learn_press_get_template( "single-course/section/" . $item->get_template(), $args ); ?>
    </a>
<?php } else { ?>
    <span class="<?php echo $item_type;?>-title course-item-title button-load-item">
        <?php learn_press_get_template( "single-course/section/" . $item->get_template(), $args ); ?>
    </span>
<?php }

/**
 * @since 3.0.0
 *
 * @see   learn_press_section_item_meta()
 */
do_action( 'learn-press/after-section-loop-item', $item, $section );
?>