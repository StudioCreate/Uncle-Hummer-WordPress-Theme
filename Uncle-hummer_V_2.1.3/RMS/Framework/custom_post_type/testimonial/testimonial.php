<?php
add_action( 'init', 'register_testimonial_post_type' );
function register_testimonial_post_type() {
   register_post_type( 'testimonial',
		array(
			'labels' => array(
				'name'			=> __('Testimonial',"rms"),
				'singular_name' => __('Testimonial',"rms"),
				'add_new'		=> __('Add Testimonial',"rms"),
				'add_new_item'	=> __('Add Testimonial',"rms"),
				'edit_item'		=> __('Edit Testimonial',"rms"),
				'new_item'		=> __('New Testimonial',"rms"),
				'not_found'		=> __('No Testimonial found',"rms"),
				'not_found_in_trash' => __('No Testimonial found in Trash',"rms"),
				'menu_name'		=> __('Testimonial',"rms"),
			),
			'description' => 'Manipulating with our Testimonial',
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
			'menu_position' => 35,
			'has_archive' => true,
			'menu_icon' => 'dashicons-format-chat',
			'query_var' => true,
			'rewrite' => array('slug' => 'testimonial'),
			'capability_type' => 'post',
			'map_meta_cap'=>true
			
		)
	);
	
	add_custom_taxonomies_testimonial();
	
}
function add_custom_taxonomies_testimonial() {
	register_taxonomy('testimonial', 'testimonial', array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Testimonial', 'taxonomy general name',"rms" ),
			'singular_name' => _x( 'Testimonial', 'taxonomy singular name' ,"rms"),
			'search_items' =>  __( 'Search Locations' ,"rms"),
			'all_items' => __( 'All Testimonial' ,"rms"),
			'parent_item' => __( 'Parent Location' ,"rms"),
			'parent_item_colon' => __( 'Parent Location:' ,"rms"),
			'edit_item' => __( 'Edit Location' ,"rms"),
			'update_item' => __( 'Update Testimonial' ,"rms"),
			'add_new_item' => __( 'Add New Testimonial' ,"rms"),
			'new_item_name' => __( 'New Testimonial' ,"rms"),
			'menu_name' => __( 'Testimonial Catagory' ,"rms"),
		),
		'rewrite' => array(
			'slug' => 'testimonial', 
			'with_front' => false, 
			'hierarchical' => true 
		)
		
	));
}