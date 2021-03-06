<?php

vc_map( array(
	'name'        => esc_html__( 'Thim: Course Categories', 'eduma' ),
	'base'        => 'thim-course-categories',
	'category'    => esc_html__( 'Thim Shortcodes', 'eduma' ),
	'description' => esc_html__( 'Display course categories.', 'eduma' ),
	'icon'        => 'thim-widget-icon thim-widget-icon-course-categories',
	'params'      => array(

		array(
			'type'        => 'textfield',
			'admin_label' => true,
			'heading'     => esc_html__( 'Title', 'eduma' ),
			'param_name'  => 'title',
		),

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Layout', 'eduma' ),
			'param_name'  => 'layout',
			'value'       => array(
				esc_html__( 'Select', 'eduma' )          => '',
				esc_html__( 'Slider', 'eduma' )          => 'slider',
				esc_html__( 'List Categories', 'eduma' ) => 'base',
                esc_html__( 'Tab Slider', 'eduma' ) => 'tab-slider',
			),
		),

		array(
			'type'        => 'number',
			'admin_label' => true,
			'heading'     => esc_html__( 'Limit categories', 'eduma' ),
			'param_name'  => 'slider_limit',
			'std'         => '15',
			'dependency'  => array(
				'element' => 'layout',
				'value'   => 'slider',
			),
			'group'       => esc_html__( 'Slider Settings', 'eduma' ),
		),

		array(
			'type'        => 'checkbox',
			'admin_label' => true,
			'heading'     => esc_html__( 'Show Pagination', 'eduma' ),
			'param_name'  => 'slider_show_pagination',
			'std'         => false,
			'dependency'  => array(
				'element' => 'layout',
				'value'   => 'slider',
			),
			'group'       => esc_html__( 'Slider Settings', 'eduma' ),
		),

		array(
			'type'        => 'checkbox',
			'admin_label' => true,
			'heading'     => esc_html__( 'Show Navigation', 'eduma' ),
			'param_name'  => 'slider_show_navigation',
			//'value'       => array( esc_html__( '', 'eduma' ) => 'yes' ),
			'std'         => true,
			'dependency'  => array(
				'element' => 'layout',
				'value'   => 'slider',
			),
			'group'       => esc_html__( 'Slider Settings', 'eduma' ),
		),

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Items visible', 'eduma' ),
			'param_name'  => 'slider_item_visible',
			'value'       => array(
				esc_html__( 'Select', 'eduma' ) => '',
				esc_html__( '1', 'eduma' )      => '1',
				esc_html__( '2', 'eduma' )      => '2',
				esc_html__( '3', 'eduma' )      => '3',
				esc_html__( '4', 'eduma' )      => '4',
				esc_html__( '5', 'eduma' )      => '5',
				esc_html__( '6', 'eduma' )      => '6',
				esc_html__( '7', 'eduma' )      => '7',
				esc_html__( '8', 'eduma' )      => '8',
			),
			'dependency'  => array(
				'element' => 'layout',
				'value'   => 'slider',
			),
			'group'       => esc_html__( 'Slider Settings', 'eduma' ),
		),

		array(
			'type'        => 'number',
			'admin_label' => true,
			'heading'     => esc_html__( 'Auto Play Speed (in ms)', 'eduma' ),
			'param_name'  => 'slider_auto_play',
			'std'         => '0',
			'description' => esc_html__( 'Set 0 to disable auto play.', 'eduma' ),
			'dependency'  => array(
				'element' => 'layout',
				'value'   => 'slider',
			),
			'group'       => esc_html__( 'Slider Settings', 'eduma' ),
		),

		array(
			'type'        => 'checkbox',
			'admin_label' => true,
			'heading'     => esc_html__( 'Show course count', 'eduma' ),
			'param_name'  => 'list_show_counts',
			//'value'       => array( esc_html__( '', 'eduma' ) => 'yes' ),
			'std'         => false,
			'dependency'  => array(
				'element' => 'layout',
				'value'   => 'list',
			),
		),

		array(
			'type'        => 'checkbox',
			'admin_label' => true,
			'heading'     => esc_html__( 'Show hierarchy', 'eduma' ),
			'param_name'  => 'list_hierarchical',
			//'value'       => array( esc_html__( '', 'eduma' ) => 'yes' ),
			'std'         => false,
			'dependency'  => array(
				'element' => 'layout',
				'value'   => 'list',
			),
		),
	)
) );
