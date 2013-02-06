<?php get_header(); ?>

<h1 class="visuallyhidden">News</h1>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h3 class="title"><?php the_title(); ?></h3>
	<section <?php post_class('news'); ?>>
		<div class="meta">
			<div class="date sans"><?php $date = get_the_date('n.j.y'); echo $date; ?></div>
			<div class="share">
				<a href="" class="icon-facebook"></a>
				<a href="" class="icon-twitter"></a><br>
				<a href="" class="icon-linkedin"></a>
				<a href="" class="icon-google-plus"></a><br>
				<a class="border blacklink hoverable link" href="<?php the_permalink(); ?>">article link</a>
			</div>
		</div>
		<div class="content clearfix">
			<?php 
			$images = get_field('featured_images');
			if ($images) {
				$count = count($images);
				$i = 1;
				if ($count == 1) {
					while (has_sub_field('featured_images')) { ?>
						<img src="<?php the_sub_field('image'); ?>">
					<?php }
				} elseif ($count == 2) {
					while (has_sub_field('featured_images')) { ?>
						<div class="image image-<?php echo $i; ?>" style="background-image: url(<?php the_sub_field('image'); ?>)"></div>
					<?php 
					$i++;
					}
				}
			} 
			the_content();
			?>
		</div>
	</section>

<?php endwhile; endif; ?>

<div class="pagination sans">
    <?php 
    next_posts_link('Older'); 
    previous_posts_link('Newer'); ?>
</div>

<?php get_footer(); ?>