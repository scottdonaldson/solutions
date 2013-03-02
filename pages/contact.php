<?php 
/*
Template Name: Contact
*/
get_header(); 
the_post(); 

function helper_js() { ?>
	<script src="<?php echo bloginfo('template_url'); ?>/js/contact.js"></script>
<?php } 
add_action('wp_footer', 'helper_js');
?>

<h1 class="visuallyhidden"><?php the_title(); ?></h1>

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

<?php 
if (get_field('team')) { 
	$p = 0; ?>
	<section id="featured" <?php post_class('clearfix team'); ?>>
		<?php 
		if (count(get_field('team')) == 1) { 
			echo '<h2 class="header">Team Leader</h2>';
		} elseif (count(get_field('team')) > 1) {
			echo '<h2 class="header">The Team</h2>';
		} ?>
		<div class="ie7 border-clone"></div>
		
		<div id="fulls">
			<?php 
			// Full images with titles and descriptions
			while (has_sub_field('team')) { ?>
				<div data-n="<?php echo $p; ?>" class="product clearfix <?php if ($p > 0) { echo 'gone'; } ?>">

					<div class="left">
						<img src="<?php the_sub_field('photo'); ?>" alt="<?php the_sub_field('name'); ?>">
					</div>
					<div class="right">
						<h3><?php the_sub_field('name'); if (get_sub_field('title')) { echo ' - '.get_sub_field('title'); } ?></h3>
						<a href="mailto:<?php the_sub_field('email'); ?>"><?php the_sub_field('email'); ?></a>
						<p><?php the_sub_field('bio'); ?></p>
					</div>
				</div>
				<?php $p++;
			} 
			// Reset for sample images
			$p = 0; ?>
		</div>

		<div id="samples" class="clearfix">
		<?php while (has_sub_field('team')) {
			if ($p > 0) { 
				$images = get_sub_field('photo'); ?>
				<div data-n="<?php echo $p; ?>" class="sample sample-<?php echo $p; ?>">
					<div>
						<img src="<?php the_sub_field('photo'); ?>" alt="<?php the_sub_field('name'); ?>">
						<span class="icon-plus"></span>
					</div>
				</div>
		<?php } 
		$p++;
		} ?>
		</div>
	</section>
<?php } ?>

<?php get_footer(); ?>