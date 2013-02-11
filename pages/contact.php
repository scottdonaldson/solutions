<?php 
/*
Template Name: Contact
*/
get_header(); 
the_post(); ?>

<h1 class="visuallyhidden">Contact</h1>

<a class="aligncenter" href="#contact">
	<h2 class="huge">Get in touch with us!</h2>
</a>

<div id="directions" class="clearfix">
	<div class="map">
		<img class="the-map" src="<?php echo bloginfo('template_url'); ?>/images/map.png">
		<div class="cover"></div>
	</div>
	<p>A visitor's parking lot is available on the south east side of the building (6th Street). When the lot is full, use the metered parking on the north east side of the building (Broadway Street).</p>
	<p class="uppercase"><a href="http://maps.google.com/maps?daddr=287+E+6th+St+%23140,+St+Paul,+MN+55101&hl=en&sll=44.951045,-93.086236&sspn=0.009643,0.022724&geocode=FQXmrQId5J1z-g&mra=ls&t=m&z=16" target="_blank">Get Google directions.</a></p>
</div>

<section <?php post_class(); ?>>
	<h2 class="header">Team Leader</h2>
</section>

<script>
	var map = $('.map'),
		cover = $('.cover'),
		x, y;

	map.mousemove(function(e){
		$this = $(this);
		x = e.pageX - $this.offset().left;
		y = e.pageY - $this.offset().top;
		cover.css({
			'top': y - 300,
			'left': x - 700
		});
	});
	map.mouseleave(function(){
		/* cover.stop().animate({
			'height': map.height(),
			'width': map.width(),
			'top': 0,
			'left': 0
		}, 500); */
	});
</script>

<?php get_footer(); ?>