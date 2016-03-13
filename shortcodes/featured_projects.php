<?php
if( !defined( 'ABSPATH' ) ) exit;

function btp_featured_projects_shortcode( $atts, $content = '' ) {
	$args = array(
		'post_type' => 'project',
		'posts_per_page' => 12,
	);

	$q = new WP_Query($args);

	if ( !$q->have_posts() ) return '';

	ob_start();
	?>
	<div class="btp-featured-projects">
		<div class="btp-project-slider">
			<?php
			while( $q->have_posts() ): $q->the_post();
				$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
				$alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
				$title = get_the_title();
				$url = get_permalink();

				?>
				<div class="btp-slide-item">
					<img data-flickity-lazyload="<?php echo esc_attr($img[0]); ?>" alt="<?php echo esc_attr($alt); ?>">
					<h2 class="btp-project-title"><a href="<?php echo esc_attr($url); ?>"><?php echo esc_html($title); ?> <i class="x-icon x-icon-arrow-right" data-x-icon="" aria-hidden="true"></i></a></h2>
				</div>
				<?php
			endwhile;
			wp_reset_query();
			?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'featured_projects', 'btp_featured_projects_shortcode' );