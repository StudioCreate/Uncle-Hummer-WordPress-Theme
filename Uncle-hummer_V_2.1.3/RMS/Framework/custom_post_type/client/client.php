<?php
add_action( 'init', 'register_client_post_type' );
function register_client_post_type() {
   register_post_type( 'client',
		array(
			'labels' => array(
				'name'			=> __('Our Client',"rms"),
				'singular_name' => __('Our Client',"rms"),
				'add_new'		=> __('Add Client',"rms"),
				'add_new_item'	=> __('Add Client',"rms"),
				'edit_item'		=> __('Edit Client',"rms"),
				'new_item'		=> __('New Client',"rms"),
				'not_found'		=> __('No Client found',"rms"),
				'not_found_in_trash' => __('No Client found in Trash',"rms"),
				'menu_name'		=> __('Our Client',"rms"),
			),
			'description' => 'Manipulating with our Client',
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
			'menu_position' => 37,
			'has_archive' => true,
                        'menu_icon' => 'dashicons-groups',
			'query_var' => true,
			'rewrite' => array('slug' => 'client'),
			'capability_type' => 'post',
			'map_meta_cap'=>true
			
		)
	);
	
	add_custom_taxonomies_client();
	
}
function add_custom_taxonomies_client() {
	register_taxonomy('client', 'client', array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Our Client', 'taxonomy general name',"rms" ),
			'singular_name' => _x( 'Client', 'taxonomy singular name' ,"rms"),
			'search_items' =>  __( 'Search Locations' ,"rms"),
			'all_items' => __( 'All Client' ,"rms"),
			'parent_item' => __( 'Parent Location' ,"rms"),
			'parent_item_colon' => __( 'Parent Location:' ,"rms"),
			'edit_item' => __( 'Edit Location' ,"rms"),
			'update_item' => __( 'Update Client' ,"rms"),
			'add_new_item' => __( 'Add New Client' ,"rms"),
			'new_item_name' => __( 'New Client' ,"rms"),
			'menu_name' => __( 'Client Catagory' ,"rms"),
		),
		'rewrite' => array(
			'slug' => 'client', 
			'with_front' => false, 
			'hierarchical' => true 
		)
		
	));
}