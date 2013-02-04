<?php get_header(); ?>

<h1 class="visuallyhidden">News</h1>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<section <?php post_class('news'); ?>>
		<h3><?php the_title(); ?></h3>
		<?php 
		$images = get_field('featured_images');
		if ($images) {
			$count = count($images);
			if ($count == 1) {
				while (has_sub_field('featured_images')) {
					the_sub_field('image');
				}
			} elseif ($count == 2) {
				while (has_sub_field('featured_images')) {
					
				}
			}
		} ?>
	</section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>