<?php get_header(); ?>

<h1 class="visuallyhidden">News</h1>

<?php 
$i = 0;
if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h3 class="title <?php if ($i == 0) { echo 'first'; } ?>"><?php the_title(); ?></h3>
	<section <?php post_class('news'); ?>>
		<div class="meta">
			<div class="date sans"><?php $date = get_the_date('n.j.y'); echo $date; ?></div>
			<div class="share">
				<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="icon-facebook"></a>
				<a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" class="icon-twitter"></a>
				<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" class="icon-linkedin"></a>
				<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="icon-google-plus"></a>
				<div class="border">
					<a class="blacklink sol-hoverable" href="<?php the_permalink(); ?>">article link</a>
				</div>
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
						<img class="featured" src="<?php the_sub_field('image'); ?>">
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
			<div class="border"><a href="<?php the_permalink(); ?>" class="blacklink sol-hoverable">article link</a></div>
		</div>
	</section>

<?php 
$i++;
endwhile; endif; ?>

<div class="pagination sans">
    <?php 
    next_posts_link('Older'); 
    previous_posts_link('Newer'); ?>
</div>

<?php get_footer(); ?>