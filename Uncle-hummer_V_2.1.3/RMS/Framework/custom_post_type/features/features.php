<?php
add_action( 'init', 'register_features_post_type' );
function register_features_post_type() {
   register_post_type( 'features',
		array(
			'labels' => array(
				'name'			=> __('Our Features',"rms"),
				'singular_name' => __('Our Feature',"rms"),
				'add_new'		=> __('Add Feature',"rms"),
				'add_new_item'	=> __('Add Feature',"rms"),
				'edit_item'		=> __('Edit Feature',"rms"),
				'new_item'		=> __('New Feature',"rms"),
				'not_found'		=> __('No Feature found',"rms"),
				'not_found_in_trash' => __('No Feature found in Trash',"rms"),
				'menu_name'		=> __('Our Feature',"rms"),
			),
			'description' => 'Manipulating with our Feature',
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
			'menu_position' => 36,
			'has_archive' => true,
                        'menu_icon' => 'dashicons-pressthis',
			'query_var' => true,
			'rewrite' => array('slug' => 'features'),
			'capability_type' => 'post',
			'map_meta_cap'=>true
			
		)
	);
	
	add_custom_taxonomies_features();
	
}
function add_custom_taxonomies_features() {
	register_taxonomy('features', 'features', array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Our Features', 'taxonomy general name',"rms" ),
			'singular_name' => _x( 'Our Features', 'taxonomy singular name' ,"rms"),
			'search_items' =>  __( 'Search Locations' ,"rms"),
			'all_items' => __( 'All Testimonial' ,"rms"),
			'parent_item' => __( 'Parent Location' ,"rms"),
			'parent_item_colon' => __( 'Parent Location:' ,"rms"),
			'edit_item' => __( 'Edit Location' ,"rms"),
			'update_item' => __( 'Update Features' ,"rms"),
			'add_new_item' => __( 'Add Feature Cat' ,"rms"),
			'new_item_name' => __( 'New Fea.Category' ,"rms"),
			'menu_name' => __( 'Feature Catagory' ,"rms"),
		),
		'rewrite' => array(
			'slug' => 'features', 
			'with_front' => false, 
			'hierarchical' => true 
		)
		
	));
}