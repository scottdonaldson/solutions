<?php 
/*
Template Name: Contact
*/
get_header(); 
the_post(); ?>

<h1 class="visuallyhidden">Contact</h1>

<h2 class="huge aligncenter">
	<a href="#contact">
		Get in touch with us!
	</a>
</h2>

<div id="directions" class="clearfix">
	<div class="map">
		<img class="the-map" src="<?php echo bloginfo('template_url'); ?>/images/map.png">
		<div class="container">
			<div class="cover-left"></div>
			<div class="cover-container">
				<div class="cover"></div>
			</div>
			<div class="cover-right"></div>
		</div>
	</div>
	<p>A visitor's parking lot is available on the south east side of the building (6th Street). When the lot is full, use the metered parking on the north east side of the building (Broadway Street).</p>
	<p class="uppercase"><a href="http://maps.google.com/maps?daddr=287+E+6th+St+%23140,+St+Paul,+MN+55101&hl=en&sll=44.951045,-93.086236&sspn=0.009643,0.022724&geocode=FQXmrQId5J1z-g&mra=ls&t=m&z=16" target="_blank">Get Google directions.</a></p>
</div>

<section <?php post_class('team'); ?>>
	<?php 
	if (count(get_field('team')) == 1) { 
		echo '<h2 class="header">Team Leader</h2>';
	} elseif (count(get_field('team')) > 1) {
		echo '<h2 class="header">The Team</h2>';
	} 
	if (get_field('team')) {
		$t = 0;
		while (has_sub_field('team')) { ?>
			<div class="member">
				<img src="<?php the_sub_field('photo'); ?>" alt="<?php the_sub_field('name'); ?>">
				
				<div class="right">
					<h3><?php the_sub_field('name'); if (get_sub_field('title')) { echo ' - '.get_sub_field('title'); } ?></h3>
					<a href="mailto:<?php the_sub_field('email'); ?>"><?php the_sub_field('email'); ?></a>
					<p><?php the_sub_field('bio'); ?></p>
				</div>
			</div>
		<?php 
		$t++;
		}
	} ?>
</section>

<script>
	// "Get in touch!"
	$('h2.huge a').click(function(e){
		e.preventDefault();

		$('html, body').animate({
			'scrollTop': $('#contact').offset().top
		}, 1200);
	})

	var map = $('.map'),
		container = map.find('.container'),
		x, y;

	$('.map')/*.mouseenter(function(e){
		$this = $(this);
		x = e.pageX - $this.offset().left;
		y = e.pageY - $this.offset().top;
		container.animate({
			'left': x,
			'top': y
		}, 500);
	})*/.mousemove(function(e){
		$this = $(this);
		x = e.pageX - $this.offset().left;
		y = e.pageY - $this.offset().top;
		container.css({
			'left': x,
			'top': y
		});
	}).mouseleave(function(){
		container.animate({
			'left': '62%',
			'top': '28%'
		}, 500);
	}); 

</script>

<?php get_footer(); ?>