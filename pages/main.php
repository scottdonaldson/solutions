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
					<?php the_sub_field('description'); ?>
				</div>
				<?php $p++;
			} 
			// Reset for sample images
			$p = 0; ?>
		</div>

		<div id="samples" class="clearfix">
		<?php while (has_sub_field('products')) {
			if ($p > 0) { ?>
				<div data-n="<?php echo $p; ?>" class="sample sample-<?php echo $p; ?>">
					<div>
						<img src="<?php the_sub_field('image'); ?>">
						<span class="icon-plus"></span>
					</div>
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
		fading = false,
		target, oldActive;

	capabilities.first().fadeIn();			// show the first capability...
	capability.first().addClass('active');	// highlight the first icon...
	$(window).load(function(){
		container.height(shown.height());	// set the height of the container equal to its content
	});	
		$(window).resize(function(){
			container.height($('.shown').height());
		});

	// Set height and width for 'Learn More' hovers
	// used in sizing the hover on switching capabilities
	var hovH = $('.sol-hoverable:first').outerHeight(),
		hovW = $('.sol-hoverable:first').outerWidth();
	$('.sol-hover').css({
		'height': hovH,
		'width': hovW
	});

	// indicator
	capability.first().find('.round').prepend('<div class="indicator"></div>');
	var indicator = $('.indicator');

	capability.click(function(){
		if (!fading) {
			fading = true;
			
			$this = $(this);
			target = capabilities.eq($this.index());
			oldActive = $('.active');

			// move the indicator
			indicator.animate({
				'left': $this.offset().left - oldActive.offset().left + 4,
				'top': $this.offset().top - oldActive.offset().top - 10
			}, 500, 'linear', function(){
				indicator.prependTo($this.find('.round')).css({
					'left': 4,
					'top': -10
				});
			});

			$this.addClass('active').siblings('.capability').removeClass('active');
			if (!target.hasClass('shown')) {
				// fade out and remove shown class from the one that's being shown
				$('.shown').fadeOut(400).removeClass('shown');
				// find the new one, fade it in, and add the shown class
				target.delay(510).fadeIn().addClass('shown')
					// size hover
					.find('.sol-hover').css({
						'height': hovH,
						'width': hovW
					});
			}

			shown = $('.shown');
			// resize container
			container.height(shown.height());

			if ($(window).scrollTop() > container.offset().top - 50) {
				$('html, body').animate({
					'scrollTop': container.offset().top - 50
				}, 800);
			}

			setTimeout(function(){
				fading = false;
			}, 910);
		}
	});

	// Put some FitText on the icons
	var icons = $('.capabilities span');
	icons.fitText(0.17);

	// Featured products
	var fulls = $('#fulls'),
		products = $('.product').not(':first'),
		samples = $('.sample'),
		sample,
		target, targetHeight,
		n;

	products.find('img').hide();

	products.append('<div class="close"><div class="bg-hover"></div><div class="icon-close"></div></div>');
	$('.close').click(function(){
		$this = $(this);
		$this.closest('.product').fadeOut(500, function(){
			$this.closest('.product').fadeOut({queue: false}).slideUp({queue: false}).animate({
				'margin-bottom': 0
			}, function(){
				$this.closest('.product').addClass('gone').fadeOut();
			});
		});
		n = $this.closest('.product').attr('data-n');
		samples.filter(function(index){ // find the corresponding sample and show it again
			return $(this).attr('data-n') === n;
		}).css({
			'margin-right': '1.667%',
			'opacity': 1
		});
	});

	samples.click(function(){
		$this = $(this);
		// Fade out the image
		$this.css({
			'opacity': 0,
			'margin-right': '-100%'
		});

		// Time to show the featured product
		target = products.eq($this.index());
		setTimeout(function(){
			target.appendTo(fulls).find('img').slideDown();
			target.slideDown().animate({
				'height': '100%',
				'margin-bottom': '1.667%'
			}, function(){
				target.removeClass('gone').fadeIn();
			});
		}, 500);
	});
});
</script>

<?php get_footer(); ?>