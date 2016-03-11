jQuery(function() {
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
});