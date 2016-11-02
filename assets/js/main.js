(function($) {
	$('.swipebox-album').click(function(e) {
		e.preventDefault();
		var images_data = $(this).data('images');
		var images_data_arr = $.map(images_data, function(value, index) {
			return [value];
		});
		$.swipebox(images_data_arr);
	});
})(jQuery);