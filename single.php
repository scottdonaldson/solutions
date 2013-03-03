<?php 
get_header(); 
the_post();
?>

<h1 class="title"><?php the_title(); ?></h1>
<section <?php post_class('news'); ?>>
	<div class="meta">
		<div class="date sans"><?php $date = get_the_date('n.j.y'); echo $date; ?></div>
		<div class="share">
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="icon-facebook"></a>
			<a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" class="icon-twitter"></a>
			<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" class="icon-linkedin"></a>
			<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="icon-google-plus"></a>
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
				echo '<div class="clearfix">';
				while (has_sub_field('featured_images')) { ?>
					<img class="half <?php if ($i != 0) { echo 'last'; } ?>" src="<?php the_sub_field('image'); ?>">
				<?php 
				$i++;
				}
				echo '</div>';
			}
		} 
		the_content();
		?>
	</div>
</section>

<?php get_footer(); ?>