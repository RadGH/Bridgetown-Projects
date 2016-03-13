<?php
if( !defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', 'btp_enqueue_scripts', 12 );

function btp_enqueue_scripts() {
	if ( is_admin() ) return;
	if ( !is_singular() ) return;

	global $post;

	// Load files for single projects or pages that include the featured projects shortcode
	$single_template = $post->post_type == 'project';
	$shortcode_template = strstr($post->post_content, '[featured_projects');

	if ( $single_template || $shortcode_template ) {
		wp_enqueue_script( 'flickity', BTP_URL . '/assets/flickity.pkgd.min.js', array( 'jquery' ), '1.1.1' );
		wp_enqueue_style( 'flickity', BTP_URL . '/assets/flickity.css', array(), '1.1.1' );

		wp_enqueue_script( 'btp-flickity', BTP_URL . '/assets/btp-flickity.js', array( 'jquery' ) );
	}

	if ( $single_template ) {
		wp_enqueue_style( 'btp-flickity', BTP_URL . '/assets/btp-flickity.css', array() );
	}

	if ( $shortcode_template ) {
		wp_enqueue_style( 'btp-featured-projects', BTP_URL . '/assets/btp-featured-projects.css', array() );
	}
}