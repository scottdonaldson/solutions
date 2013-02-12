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
				<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="round"><span class="icon-facebook sol-hoverable"></span></a>
				<a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" class="round"><span class="icon-twitter sol-hoverable"></span></a>
				<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" class="round"><span class="icon-linkedin sol-hoverable"></span></a>
				<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="round"><span class="icon-google-plus sol-hoverable round"></span></a>
				<div class="border">
					<a class="blacklink sol-hoverable link" href="<?php the_permalink(); ?>">article link</a>
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

<?php 
$i++;
endwhile; endif; ?>

<div class="pagination sans">
    <?php 
    next_posts_link('Older'); 
    previous_posts_link('Newer'); ?>
</div>

<?php get_footer(); ?>