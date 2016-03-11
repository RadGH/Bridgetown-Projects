<?php

// Register Custom Post Type
function btp_register_projects_post_type() {
	$labels = array(
		'name'                  => _x( 'Projects', 'Post Type General Name', 'btp' ),
		'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'btp' ),
		'menu_name'             => __( 'Projects', 'btp' ),
		'name_admin_bar'        => __( 'Projects', 'btp' ),
		'archives'              => __( 'Project Archives', 'btp' ),
		'parent_item_colon'     => __( 'Parent Item:', 'btp' ),
		'all_items'             => __( 'All Projects', 'btp' ),
		'add_new_item'          => __( 'Add New Project', 'btp' ),
		'add_new'               => __( 'Add New', 'btp' ),
		'new_item'              => __( 'New Project', 'btp' ),
		'edit_item'             => __( 'Edit Project', 'btp' ),
		'update_item'           => __( 'Update Project', 'btp' ),
		'view_item'             => __( 'View Project', 'btp' ),
		'search_items'          => __( 'Search Project', 'btp' ),
		'not_found'             => __( 'Not found', 'btp' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'btp' ),
		'featured_image'        => __( 'Featured Image', 'btp' ),
		'set_featured_image'    => __( 'Set featured image', 'btp' ),
		'remove_featured_image' => __( 'Remove featured image', 'btp' ),
		'use_featured_image'    => __( 'Use as featured image', 'btp' ),
		'insert_into_item'      => __( 'Insert into project', 'btp' ),
		'uploaded_to_this_item' => __( 'Uploaded to this project', 'btp' ),
		'items_list'            => __( 'Projects list', 'btp' ),
		'items_list_navigation' => __( 'Projects list navigation', 'btp' ),
		'filter_items_list'     => __( 'Filter project list', 'btp' ),
	);
	$args = array(
		'label'                 => __( 'Project', 'btp' ),
		'description'           => __( 'Real estate projects both completed or in progress.', 'btp' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-multisite',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'project', $args );

}
add_action( 'init', 'btp_register_projects_post_type' );