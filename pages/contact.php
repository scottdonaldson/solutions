<?php 
/*
Template Name: Contact
*/
get_header(); 
the_post(); 

?>

<h1 class="visuallyhidden"><?php the_title(); ?></h1>

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