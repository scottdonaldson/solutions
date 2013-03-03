</div><!-- #main -->   

<footer class="primary full-width">
	<section id="footer-news" class="clearfix">
		<h2 class="header">Latest News</h2>
		<div class="clearfix">
			<?php 
			$news = new WP_query('posts_per_page=2');
			$i = 1;
			while ($news->have_posts()) : $news->the_post(); ?>
				<div class="footer-news <?php if ($i == 2) { echo 'last'; } ?>">
					<a class="sol-hoverable clearfix" href="<?php the_permalink(); ?>">
						<abbr class="sans" title="<?php echo 'Posted on '.get_the_date('M j, Y'); ?>"><?php echo get_the_date('n.j'); ?></abbr>
						<div class="content">
							<h3 class="sans"><?php the_title(); ?></h3>
							<?php the_excerpt(); ?>
						</div>
						<div class="border-clone"></div>
					</a>
				</div>
			<?php $i++; endwhile; wp_reset_postdata(); ?>
		</div>

		<div class="archive">
			<a class="sol-hoverable sans" href="<?php echo home_url(); ?>/news">Visit the Archive</a>
		</div>

		<div class="ie7 border-clone"></div>
	</section>

	<section id="contact">
		<h2 class="header">Contact</h2>
		<div class="contact">
			<h3>Address</h3>
			<p><?php the_field('address', get_page_by_title('Contact')->ID); ?></p> 
			<h3>Email</h3>
			<a href="mailto:<?php the_field('email', get_page_by_title('Contact')->ID); ?>"><?php the_field('email', get_page_by_title('Contact')->ID); ?></a>
			<h3>Phone</h3>
			<p><?php the_field('phone', get_page_by_title('Contact')->ID); ?></p>
		</div>

		<div class="ie7 border-clone"></div>
	</section>
</footer>

<footer class="secondary full-width">
	<p class="alignleft">&copy; <?php echo date('Y').'&nbsp;'; bloginfo('name'); ?></p>
	<p class="alignright">design + code by <a href="http://www.parsleyandsprouts.com" target="_blank">Parsley &amp; Sprouts</a></p>
</footer> 

</div><!-- #page -->

<?php /* Modernizr and jQuery are included in the <head>, other scripts here */ ?>
<script src="<?php echo bloginfo('template_url'); ?>/js/plugins.js"></script>
<script src="<?php echo bloginfo('template_url'); ?>/js/script.js"></script>

<?php wp_footer(); ?>
</body>
</html>