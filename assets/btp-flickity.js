jQuery(function() {
	init_single_project_slider();
	init_featured_projects_slider();
});

function init_single_project_slider() {
	var $project_gallery = jQuery('.project-gallery-slider');
	if ( $project_gallery.length < 1 ) return;

	$project_gallery.flickity({
		cellSelector: 'div.project-slide-item',
		lazyLoad: 2,
		pageDots: true,
		draggable: true,
		selectedAttraction: 0.01,
		friction: 0.15,
		arrowShape: {
			x0: 20,
			x1: 70, y1: 50,
			x2: 70, y2: 40,
			x3: 35
		}
	});

	// A navigation slider may be used below
	var $slider_nav = jQuery('.project-gallery-nav');
	if ( $slider_nav.length < 1 ) return;

	$slider_nav.flickity({
		asNavFor: $project_gallery[0],
		cellSelector: 'div.project-nav-item',
		contain: true,
		lazyLoad: 8,
		pageDots: false,
		imagesLoaded: true,
		freeScroll: true,
		prevNextButtons: false
	});

	$slider_nav.on('click', 'a', function(e) {
		e.preventDefault();
	});
}

function init_featured_projects_slider() {
	var $featured_gallery = jQuery('.btp-project-slider');
	if ( $featured_gallery.length < 1 ) return;

	$featured_gallery.flickity({
		cellSelector: 'div.btp-slide-item',
		lazyLoad: 2,
		pageDots: true,
		draggable: true,
		selectedAttraction: 0.01,
		friction: 0.15,
		arrowShape: {
			x0: 20,
			x1: 70, y1: 50,
			x2: 70, y2: 40,
			x3: 35
		}
	});
}