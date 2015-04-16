<?php
add_action( 'init', 'register_team_post_type' );
function register_team_post_type() {
   register_post_type( 'team',
		array(
			'labels' => array(
				'name'			=> __('Services &amp; Prices',"rms"),
				'singular_name' => __('Services &amp; Prices',"rms"),
				'add_new'		=> __('Add Services &amp; Prices',"rms"),
				'add_new_item'	=> __('Add Services &amp; Prices',"rms"),
				'edit_item'		=> __('Edit Services &amp; Prices',"rms"),
				'new_item'		=> __('New Services &amp; Prices',"rms"),
				'not_found'		=> __('No Services &amp; Prices found',"rms"),
				'not_found_in_trash' => __('No Services &amp; Prices found in Trash',"rms"),
				'menu_name'		=> __('Services &amp; Prices',"rms"),
			),
			'description' => 'Manipulating with Services &amp; Prices',
			'public' => true,
			'show_in_nav_menus' => true,
			'supports' => array(
				'title',
				'thumbnail',
				'editor',
				'page-attributes',
			),
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 34,
			'has_archive' => true,
			'menu_icon' => 'dashicons-hammer',
			'query_var' => true,
			'rewrite' => array('slug' => 'team'),
			'capability_type' => 'post',
			'map_meta_cap'=>true
			
		)
	);
	
	add_custom_taxonomies_team();
	
}
function add_custom_taxonomies_team() {
	register_taxonomy('team', 'team', array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Our Services &amp; Prices', 'taxonomy general name',"rms" ),
			'singular_name' => _x( 'Services &amp; Prices', 'taxonomy singular name' ,"rms"),
			'search_items' =>  __( 'Search Locations' ,"rms"),
			'all_items' => __( 'All Services &amp; Prices' ,"rms"),
			'parent_item' => __( 'Parent Location' ,"rms"),
			'parent_item_colon' => __( 'Parent Location:' ,"rms"),
			'edit_item' => __( 'Edit Location' ,"rms"),
			'update_item' => __( 'Update Services &amp; Prices' ,"rms"),
			'add_new_item' => __( 'Add New Services &amp; Prices' ,"rms"),
			'new_item_name' => __( 'New Services &amp; Prices' ,"rms"),
			'menu_name' => __( 'Services &amp; Prices Catagory' ,"rms"),
		),
		'rewrite' => array(
			'slug' => 'team', 
			'with_front' => false, 
			'hierarchical' => true 
		)
		
	));
}