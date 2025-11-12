<?php
/**
 * Custom Post Types Registration
 *
 * This file contains the code to register custom post types for the theme.
 *
 * @package lc-kav2025
 */

/**
 * Register custom post types for the theme.
 *
 * This function registers a custom post type called 'people'.
 * The post type is set to be publicly queryable, has a UI in the admin,
 * and supports REST API.
 *
 * @return void
 */
function lc_register_post_types() {

	register_post_type(
		'company',
		array(
			'labels'          => array(
				'name'               => 'Companies',
				'singular_name'      => 'Company',
				'add_new_item'       => 'Add New Company',
				'edit_item'          => 'Edit Company',
				'new_item'           => 'New Company',
				'view_item'          => 'View Company',
				'search_items'       => 'Search Companies',
				'not_found'          => 'No companies found',
				'not_found_in_trash' => 'No companies in trash',
			),
			'has_archive'     => true,
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => true,
			'show_in_rest'    => true,
			'menu_position'   => 25,
			'menu_icon'       => 'dashicons-building',
			'supports'        => array( 'title', 'editor', 'thumbnail' ),
			'capability_type' => 'post',
			'map_meta_cap'    => true,
			'rewrite'         => false,
		)
	);
}
add_action( 'init', 'lc_register_post_types' );
