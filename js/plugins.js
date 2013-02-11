// Avoid `console` errors in browsers that lack a console.
if (!(window.console && console.log)) {
    (function() {
        var noop = function() {};
        var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'markTimeline', 'profile', 'profileEnd', 'markTimeline', 'table', 'time', 'timeEnd', 'timeStamp', 'trace', 'warn'];
        var length = methods.length;
        var console = window.console = {};
        while (length--) {
            console[methods[length]] = noop;
        }
    }());
}

// FitText
(function( $ ){
	
  $.fn.fitText = function( kompressor, options ) {
	   
    // Setup options
    var compressor = kompressor || 1,
        settings = $.extend({
          'minFontSize' : Number.NEGATIVE_INFINITY,
          'maxFontSize' : Number.POSITIVE_INFINITY
        }, options);
	
    return this.each(function(){

      // Store the object
      var $this = $(this); 
        
      // Resizer() resizes items based on the object width divided by the compressor * 10
      var resizer = function () {
        $this.css('font-size', Math.max(Math.min($this.width() / (compressor*10), parseFloat(settings.maxFontSize)), parseFloat(settings.minFontSize)));
      };

      // Call once to set.
      resizer();
				
      // Call on resize. Opera debounces their resize by default. 
      $(window).on('resize', resizer);
      	
    });

  };

})( jQuery );

// IcoMoon for IE8 and below
if ($('html').hasClass('lt-ie8')) {
	window.onload = function() {
		function addIcon(el, entity) {
			var html = el.innerHTML;
			el.innerHTML = '<span style="font-family: \'icomoon\'">' + entity + '</span>' + html;
		}
		var icons = {
				'icon-facebook' : '&#xe000;',
				'icon-twitter' : '&#xe001;',
				'icon-linkedin' : '&#xe002;',
				'icon-google-plus' : '&#xe003;'
			},
			els = document.getElementsByTagName('*'),
			i, attr, html, c, el;
		for (i = 0; i < els.length; i += 1) {
			el = els[i];
			attr = el.getAttribute('data-icon');
			if (attr) {
				addIcon(el, attr);
			}
			c = el.className;
			c = c.match(/icon-[^\s'"]+/);
			if (c && icons[c[0]]) {
				addIcon(el, icons[c[0]]);
			}
		}
	};
}