<?php
if( !defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', 'btp_enqueue_scripts', 12 );

function btp_enqueue_scripts() {
	if ( !is_admin() && is_singular('project') ) {
		wp_enqueue_script( 'flickity', BTP_URL . '/assets/flickity.pkgd.min.js', array( 'jquery' ), '1.1.1' );
		wp_enqueue_style( 'flickity', BTP_URL . '/assets/flickity.css', array(), '1.1.1' );

		wp_enqueue_script( 'btp-flickity', BTP_URL . '/assets/btp-flickity.js', array( 'jquery' ) );
		wp_enqueue_style( 'btp-flickity', BTP_URL . '/assets/btp-flickity.css', array() );
	}
}