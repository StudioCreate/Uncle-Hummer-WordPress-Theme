<?php
add_action( 'init', 'register_portfolio_post_type' );
function register_portfolio_post_type() {
   register_post_type( 'portfolio',
		array(
			'labels' => array(
				'name'			=> __('Portfolio',"rms"),
				'singular_name' => __('Portfolio',"rms"),
				'add_new'		=> __('Add Portfolio',"rms"),
				'add_new_item'	=> __('Add Portfolio',"rms"),
				'edit_item'		=> __('Edit Portfolio',"rms"),
				'new_item'		=> __('New Portfolio',"rms"),
				'not_found'		=> __('No Portfolio found',"rms"),
				'not_found_in_trash' => __('No Portfoliofound in Trash',"rms"),
				'menu_name'		=> __('Portfolio',"rms"),
			),
			'description' => 'Manipulating with our team',
			'public' => true,
			'show_in_nav_menus' => true,
			'supports' => array(
				'title',
				'thumbnail',
				'editor',
				'comments',
				'page-attributes',
			),
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 32,
			'has_archive' => true,
                        'menu_icon' => 'dashicons-schedule',
			'query_var' => true,
			'rewrite' => array('slug' => 'portfolio'),
			'capability_type' => 'post',
			'map_meta_cap'=>true
			
		)
	);
	
	add_custom_taxonomies_portfolio();
	
}
function add_custom_taxonomies_portfolio() {
	register_taxonomy('portfolio', 'portfolio', array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Portfolio', 'taxonomy general name',"rms" ),
			'singular_name' => _x( 'Portfolio', 'taxonomy singular name' ,"rms"),
			'search_items' =>  __( 'Search Locations' ,"rms"),
			'all_items' => __( 'All Portfolio' ,"rms"),
			'parent_item' => __( 'Parent Location' ,"rms"),
			'parent_item_colon' => __( 'Parent Location:' ,"rms"),
			'edit_item' => __( 'Edit Location' ,"rms"),
			'update_item' => __( 'Update Portfolio' ,"rms"),
			'add_new_item' => __( 'Add New Portfolio' ,"rms"),
			'new_item_name' => __( 'New Portfolio' ,"rms"),
			'menu_name' => __( 'Portfolio Catagory' ,"rms"),
		),
		'rewrite' => array(
			'slug' => 'portfolio', 
			'with_front' => false, 
			'hierarchical' => true 
		)
		
	));
}