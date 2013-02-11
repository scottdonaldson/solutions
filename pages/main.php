<?php 
/*
Template Name: Main
*/
get_header(); 
the_post(); ?>

<?php 
// Include capabilities
include( MAIN . 'caps.php'); ?>

<section id="capabilities" class="clearfix">
	<?php
	$i = 0;
	foreach ($capabilities as $cap => $name) { ?>
		<div id="<?php echo $cap; ?>" class="clearfix <?php if ($i == 0) { echo 'initial shown'; } ?>">
			<h2><?php the_field($cap.'_tagline'); ?></h2>
			<div class="left">
				<img src="<?php echo bloginfo('template_url').'/images/'.$cap.'.png'; ?>" alt="<?php echo $name; ?>">
			</div>
			<div class="right">
				<p><?php the_field($cap.'_description'); ?></p>
				<div class="box more">
					<a class="hoverable sans" href="<?php echo home_url(); ?>/capabilities/#<?php echo $cap; ?>">Learn more</a>
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
						<span class="hoverable icon-<?php echo $cap; ?>"></span>
					</div>
					<h3><?php echo $name; ?></h3>
				</div>
			<?php } ?>
		</div>
	</nav>
</section>

<?php 
if (get_field('products')) { 
	$p = 0; ?>
	<section id="featured" class="clearfix">
		<h2 class="header">Featured Products</h2>

		<div id="fulls">
			<?php 
			// Full images with titles and descriptions
			while (has_sub_field('products')) { ?>
				<div data-n="<?php echo $p; ?>" class="product clearfix <?php if ($p > 0) { echo 'gone'; } ?>">
					<img src="<?php the_sub_field('image'); ?>">
					<h3><?php the_sub_field('name'); ?></h3>
					<p><?php the_sub_field('description'); ?></p>
				</div>
				<?php $p++;
			} 
			// Reset for sample images
			$p = 0; ?>
		</div>

		<div id="samples">
		<?php while (has_sub_field('products')) {
			if ($p > 0) { ?>
				<div data-n="<?php echo $p; ?>" class="sample sample-<?php echo $p; ?>">
					<img src="<?php the_sub_field('image'); ?>">
				</div>
		<?php } 
		$p++;
		} ?>
		</div>
	</section>
<?php } ?>

<script>
jQuery(document).ready(function($){
	var capability = $('.capability'),
		container = $('#capabilities'),
		capabilities = $('#capabilities > div'),
		shown = $('.shown'),
		fading = false;

	capabilities.first().fadeIn();			// show the first capability...
	capability.first().addClass('active');	// highlight the first icon...
	setTimeout(function(){
		container.height(shown.height());	// set the height of the container equal to its content
	}, 100);								// (with a slight delay to allow for content to display)
		$(window).resize(function(){
			container.height($('.shown').height());
		});

	// Set height and width for 'Learn More' hovers
	// used in sizing the hover on switching capabilities
	var hovH = $('.hoverable:first').outerHeight(),
		hovW = $('.hoverable:first').outerWidth();
	$('.hover').css({
		'height': hovH,
		'width': hovW
	});

	capability.click(function(){
		if (!fading) {
			fading = true;

			$this = $(this);
			$this.addClass('active').siblings().removeClass('active');
			if (!capabilities.eq($this.index()).hasClass('shown')) {
				// fade out and remove shown class from the one that's being shown
				$('.shown').fadeOut(400).removeClass('shown');
				// find the new one, fade it in, and add the shown class
				capabilities.eq($this.index()).delay(510).fadeIn().addClass('shown')
					// size hover
					.find('.hover').css({
						'height': hovH,
						'width': hovW
					});
			}

			shown = $('.shown');
			// resize container
			container.height(shown.height());

			setTimeout(function(){
				fading = false;
			}, 910);
		}
	});

	// Put some FitText on the icons
	var icons = $('.capabilities span');
	icons.fitText(0.19);

	// Featured products
	var fulls = $('#fulls'),
		products = $('.product').not(':first'),
		samples = $('.sample'),
		sample,
		target, targetHeight,
		n;

	products.append('<div class="close"><div class="bg-hover"></div><div class="icon-close"></div></div>');
	$('.close').click(function(){
		$this = $(this);
		$this.closest('.product').animate({
			'opacity': 0
		}, 500, function(){
			$this.closest('.product').addClass('gone');
		});
		n = $this.closest('.product').attr('data-n');
		samples.filter(function(index){
			return $(this).attr('data-n') === n;
		}).show().animate({
			'left': 0,
			'margin-right': '1.667%',
			'opacity': 1
		});
	});

	samples.click(function(){
		$this = $(this);
		// Fade out the image
		$this.animate({
			'left': -$this.outerWidth(),
			'margin-right': -$this.outerWidth(),
			'opacity': 0
		}, function(){
			$this.hide();
		});

		// Time to show the featured product
		target = products.eq($this.index());
		setTimeout(function(){
			target.appendTo(fulls).removeClass('gone').animate({
				'opacity': 1
			}, 600);
		}, 300);
	});
});
</script>

<?php get_footer(); ?>