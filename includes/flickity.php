<?php
if( !defined( 'ABSPATH' ) ) exit;

function btp_replace_thumbnail_with_gallery( $html, $post_ID, $post_thumbnail_id, $size, $attr ) {
	// Never replace the thumbnail
	if ( $size == "thumbnail" || $size == "thumb" ) return $html;

	if ( is_singular('project') && get_post_type($post_ID) == 'project' ) {
		$gallery = get_field( 'gallery-photos', $post_ID );

		if ( !empty($gallery) && is_array($gallery) ) {
			$has_featured = false;

			foreach( $gallery as $img ) {
				if ( $img['ID'] === $post_thumbnail_id ) $has_featured = true;
			}

			if ( !$has_featured ) {
				$feat = acf_get_attachment($post_ID);
				if ( $feat ) array_unshift( $gallery, $feat );
			}

			$slide_html = array();
			$nav_html = array();

			foreach( $gallery as $i => $img ) {
				$thumb = isset($img['sizes']['thumbnail']) ? $img['sizes']['thumbnail'] : wp_get_attachment_image_src( $img['ID'], 'thumbnail' )[0];
				$small = isset($img['sizes'][$size]) ? $img['sizes'][$size] : wp_get_attachment_image_src( $img['ID'], $size )[0];
				$full = $img['url'];

				$text = $img['caption'];
				if ( !$text ) $text = $img['description'];
				if ( !$text ) $text = $img['alt'];

				ob_start();
				?>
				<div class="project-slide-item" id="btp-<?php echo $post_ID; ?>-n<?php echo $i; ?>">
					<a href="<?php echo esc_attr($full); ?>" class="project-lightbox">
						<img data-flickity-lazyload="<?php echo esc_attr($small); ?>" alt="<?php echo esc_attr($img['alt']); ?>" class="project-slide-image" />
					</a>

					<?php if ( $text ) { ?>
						<div class="project-caption"><?php echo esc_html($text); ?></div>
					<?php } ?>
				</div>
				<?php
				$slide_html[] = ob_get_clean();

				ob_start();
				?>
				<div class="project-nav-item" id="btp-<?php echo $post_ID; ?>-n<?php echo $i; ?>">
					<a href="#btp-<?php echo $post_ID; ?>-n<?php echo $i; ?>">
						<img data-flickity-lazyload="<?php echo esc_attr($thumb); ?>" alt="<?php echo esc_attr($img['alt']); ?>" class="project-nav-image" />
					</a>
				</div>
				<?php
				$nav_html[] = ob_get_clean();
			}

			ob_start();
			?>
			<div class="project-gallery">
				<div class="project-gallery-slider">
					<?php
					echo implode( "\n", $slide_html );
					?>
				</div>
				<div class="project-gallery-nav">
					<?php
					echo implode( "\n", $nav_html );
					?>
				</div>
			</div>
			<?php

			do_action( 'btp-flickity-gallery', $post_ID, $post_thumbnail_id );

			$html = ob_get_clean();
		}
	}

	return $html;
}
add_filter( 'post_thumbnail_html', 'btp_replace_thumbnail_with_gallery', 10, 5 );


// If a gallery has an image, but there is no featured image set, use the first gallery photo as a featured image.
function btp_use_first_gallery_as_featured_image_fallback( $value, $object_id, $meta_key, $single ) {
	if ( $meta_key === '_thumbnail_id' && get_post_type( $object_id ) === 'project' ) {
		if ( $value === null ) {
			remove_filter( "get_post_metadata", 'btp_use_first_gallery_as_featured_image_fallback' );
			$featured_image = get_post_meta( '_thumbnail_id', $meta_key, true );
			add_filter( "get_post_metadata", 'btp_use_first_gallery_as_featured_image_fallback', 15, 4 );

			if ( !$featured_image ) {
				$gallery = get_field( 'gallery-photos', $object_id );

				if ( $gallery && !empty($gallery[0]) ) {
					if ( $single ) {
						return $gallery[0]['ID'];
					}else{
						return array( $gallery[0]['ID'] );
					}
				}
			}
		}
	}

	return $value;
}
add_filter( "get_post_metadata", 'btp_use_first_gallery_as_featured_image_fallback', 15, 4 );