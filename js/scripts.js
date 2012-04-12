$(document).ready(function(){


	
	// Featured images z-index effect
		var z = 100;
		$('.featured-images a').hover(function() {
			z = z + 100;
			$(this).css({'z-index': z});
		});

	// Change title on featured image hover
	
	   $('.featured-images a').hover(function() {
	   	var title = $(this).data('author');
	   	
	   	$('h5.title').html(title);
	   	
	   	
	   }, function() {
	   	$('h5.title').html('');
	   });

});