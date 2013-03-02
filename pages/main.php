<?php 
/*
Template Name: Main
*/
get_header(); 
the_post(); 

function helper_js() { ?>
	<script src="<?php echo bloginfo('template_url'); ?>/js/main.js"></script>
<?php } 
add_action('wp_footer', 'helper_js');
?>

<?php 
// Include capabilities
include( MAIN . 'caps.php'); ?>

<section id="capabilities" class="clearfix">
	<?php
	$i = 0;
	foreach ($capabilities as $cap => $name) { ?>
		<div id="<?php echo $cap; ?>" class="clearfix <?php if ($i == 0) { echo 'initial shown'; } ?>">
			<h2 class="central"><?php the_field($cap.'_tagline'); ?></h2>
			<div class="left">
				<img src="<?php echo bloginfo('template_url').'/images/'.$cap.'.png'; ?>" alt="<?php echo $name; ?>">
			</div>
			<div class="right">
				<p><?php the_field($cap.'_description'); ?></p>
				<div class="box more">
					<a class="sol-hoverable sans" href="<?php echo home_url(); ?>/capabilities/#<?php echo $cap; ?>">Learn more</a>
				</div>
			</div>
		</div>
	<?php 
	$i++;
	} ?>

	<nav class="capabilities clearfix">
		<aside class="cover"></aside>
		<div><?php // empty div so that capabilities icons have proper indices ?>
			<?php
			foreach ($capabilities as $cap => $name) { ?>
				<div class="capability" data-capability="<?php echo $cap; ?>">
					<div class="dummy"></div>
					<div class="round">
						<span class="sol-hoverable icon-<?php echo $cap; ?>"></span>
					</div>
					<h3><?php echo $name; ?></h3>
					<div class="border-clone"></div>
				</div>
			<?php } ?>
		</div>
	</nav>

	<?php // anything with a class of ie7 will show up only in ie7 (duh) ?>
	<div class="ie7 border-clone"></div>
</section>

<?php 
if (get_field('products')) { 
	$p = 0; ?>
	<section id="featured" class="clearfix">
		<h2 class="header">Featured Products</h2>
		<div class="ie7 border-clone"></div>
		
		<div id="fulls">
			<?php 
			// Full images with titles and descriptions
			while (has_sub_field('products')) { ?>
				<div data-n="<?php echo $p; ?>" class="product clearfix <?php if ($p > 0) { echo 'gone'; } ?>">
					<div class="left">
						<?php 
						$images = get_sub_field('images'); ?>
						<?php 
						// If just one image, just show it
						if (count($images) == 1) { ?>
							<img src="<?php echo $images[0]['image']; ?>">
						<?php 
						// If multiple images, set up the colorbox
						} else { ?>
							<a class="colorbox" href="<?php echo $images[0]['image']; ?>" rel="<?php echo $p; ?>">
								<img src="<?php echo $images[0]['image']; ?>">
							</a>
							<?php 
							// For each image (after the initial one, shown above),
							// need a link so that it will show in slideshow
							$i = 0;
							foreach ($images as $image) { 
								if ($i > 0) { ?>
									<a href="<?php echo $images[$i]['image']; ?>" class="colorbox hidden" rel="<?php echo $p; ?>"></a>
								<?php 
								}
								$i++;
							}
						} 
						// Whether or not there's more than one image, have a div ready for pointers
						// (the indicators to show that there's more than one image)
						?>
						<div class="pointers">
							<?php 
							if (count($images) > 1) { 
								$i = 0;
								foreach ($images as $image) { 
									if ($i > 0) { echo '<div class="pointer"></div>'; }
									$i++;
								}
							} ?>
						</div>
					</div><!-- .left -->

					<h3><?php the_sub_field('name'); ?></h3>
					<?php the_sub_field('description'); ?>
				</div>
				<?php $p++;
			} 
			// Reset for sample images
			$p = 0; ?>
		</div>

		<div id="samples" class="clearfix">
		<?php while (has_sub_field('products')) {
			if ($p > 0) { 
				$images = get_sub_field('images'); ?>
				<div data-n="<?php echo $p; ?>" class="sample sample-<?php echo $p; ?>">
					<div>
						<img src="<?php echo $images[0]['image']; ?>">
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