(function($) {
	var hidebarsdelay = 3000;
	function setTimeout () {
		if ( hidebarsdelay > 0 ) {
			var $this = this;
			window.clearTimeout( $this.timeout );
			$this.timeout = window.setTimeout( function() {
				var bars = $( '#swipebox-top-bar, #swipebox-bottom-bar' );
				bars.removeClass( 'visible-bars' );
			},
			hidebarsdelay
			);
		}
	}

	/**
	 * Alternatives:
	 * http://photoswipe.com/
	 * http://dimsemenov.com/plugins/magnific-popup/
	 */
	 
	$('.swipebox-album').click(function(e) {
		e.preventDefault();


		var images_data = $(this).data('images');
		var images_data_arr = $.map(images_data, function(value, index) {
			return [value];
		});
		console.log(hidebarsdelay);
		var options = {
			hideBarsDelay: hidebarsdelay,
			removeBarsOnMobile: false
		};
		$.swipebox(images_data_arr, options);

		$('#swipebox-slider').mousemove( function() {
			var bars = $( '#swipebox-top-bar, #swipebox-bottom-bar' );
			bars.addClass( 'visible-bars' );
			setTimeout();
		});


	});
})(jQuery);