<?php
/*
Plugin Name: Bridgetown Home Buyers - Projects
Version:     1.0.0
Plugin URI:  http://radgh.com/
Description: Adds a "Projects" section to the website with custom fields for a gallery. Requires ACF Pro.
Author:      Radley Sustaire
Author URI:  mailto:radleygh@gmail.com
License:     GPL2
*/

/*
GNU GENERAL PUBLIC LICENSE

A WordPress plugin that allows you to mark pages with an option to hide 
from search engines, by adding a noindex meta tag to the single page's <head>
Copyright (C) 2015 Radley Sustaire

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>
*/

if( !defined( 'ABSPATH' ) ) exit;

define( 'BTP_URL', plugin_dir_url( __FILE__ ) );
define( 'BTP_PATH', dirname( __FILE__ ) );

add_action( 'plugins_loaded', 'btp_initialize_plugin' );

function btp_initialize_plugin() {
	if ( !class_exists('acf') ) {
		add_action( 'admin_notices', 'btp_no_acf_error' );
		return;
	}

	include( BTP_PATH . '/includes/post-type.php' );
	include( BTP_PATH . '/includes/enqueue.php' );
	include( BTP_PATH . '/includes/flickity.php' );
	include( BTP_PATH . '/shortcodes/featured_projects.php' );
}

function btp_no_acf_error() {
	?>
	<div class="error">
		<p><strong>Bridgetown Home Buyers - Projects:</strong> Error</p>
		<p>Advanced Custom Fields Pro is required for this plugin to function. Please install and activate Advanced Custom Fields Pro, or disable this plugin.</p>
	</div>
	<?php
}