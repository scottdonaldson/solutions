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
					<a class="hoverable clearfix" href="<?php the_permalink(); ?>">
						<abbr class="sans" title="<?php echo 'Posted on '.get_the_date('M j, Y'); ?>"><?php echo get_the_date('n.j'); ?></abbr>
						<div class="content">
							<h3 class="sans"><?php the_title(); ?></h3>
							<?php the_excerpt(); ?>
						</div>
					</a>
				</div>
			<?php $i++; endwhile; wp_reset_postdata(); ?>
		</div>

		<div>
			<a class="archive hoverable sans" href="<?php echo home_url(); ?>/news">Visit the Archive</a>
		</div>
	</section>

	<section id="contact">
		<h2 class="header">Contact</h2>
		<div class="contact">
			<h3>Address</h3>
			<p>287 East Sixth Street<br>
			   Suite 140<br>
			   St. Paul, MN 55101</p> 
			<h3>Email</h3>
			<a href="mailto:info@solutions-eng.com">info@solutions-eng.com</a>
			<h3>Phone</h3>
			<p>651.789.0469</p>
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