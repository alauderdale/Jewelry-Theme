<?php 
/* 
Template Name: Home
*/ 
?>

<?php get_header(); ?>
	<div id="container">
		<div class="main">
			<div class="featured-images">
				<h5 class="title"></h5>
					<?php $nt_timepiece = get_option('nt_timepiece'); ?>
					<?php $nt_parure = get_option('nt_parure'); ?>
					<?php $nt_braclets = get_option('nt_braclets'); ?>
					<?php $nt_rings = get_option('nt_rings'); ?>
					<?php $nt_necklaces = get_option('nt_necklaces'); ?>
					<?php $nt_earings = get_option('nt_earings'); ?>
					
				
				<a href="http://entremblant.com/?location=/timepieces/" class="featured f1" data-author="TIMEPIECES">
					<?php if($nt_timepiece) : ?>	
					<img src="<?php echo get_option('nt_timepiece'); ?>">
						<?php else : ?>	
						<img src="<?php bloginfo('template_url'); ?>/images/featured1.jpg">
					<?php endif; ?>	
				</a>
				<a href="http://entremblant.com/?location=/parure/" class="featured f2" data-author="PARURE">
					<?php if($nt_parure) : ?>	
					<img src="<?php echo get_option('nt_parure'); ?>">
						<?php else : ?>	
						<img src="<?php bloginfo('template_url'); ?>/images/featured2.jpg">
					<?php endif; ?>	
				</a>		
				<a href="http://entremblant.com/?location=/braceletspin/" class="featured f3" data-author="BRACLETS">
					<?php if($nt_braclets) : ?>	
					<img src="<?php echo get_option('nt_braclets'); ?>">
						<?php else : ?>	
						<img src="<?php bloginfo('template_url'); ?>/images/featured3.jpg">
					<?php endif; ?>	
				</a>
				<a href="http://entremblant.com/?location=/rings/" class="featured f4" data-author="RINGS">
					<?php if($nt_rings) : ?>	
					<img src="<?php echo get_option('nt_rings'); ?>">
						<?php else : ?>	
						<img src="<?php bloginfo('template_url'); ?>/images/featured4.jpg">
					<?php endif; ?>	
				</a>
				<a href="http://entremblant.com/?location=/necklaces/" class="featured f5" data-author="NECKLACES">
					<?php if($nt_necklaces) : ?>	
					<img src="<?php echo get_option('nt_necklaces'); ?>">
						<?php else : ?>	
						<img src="<?php bloginfo('template_url'); ?>/images/featured5.jpg">
					<?php endif; ?>	
				</a>
				<a href="http://entremblant.com/?location=/earrings/" class="featured f6" data-author="EARINGS">
					<?php if($nt_earings) : ?>	
					<img src="<?php echo get_option('nt_earings'); ?>">
						<?php else : ?>	
						<img src="<?php bloginfo('template_url'); ?>/images/featured6.jpg">
					<?php endif; ?>	
				</a>
			</div><!--end featured images-->
			<div class="home-blurb">
			<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<?php the_content(''); ?>
				</div><!--end home blurb-->
			<?php endwhile; ?>	
			<?php else : ?>
					<h3>Sorry!</h3>
						<p>
							But your looking for something that isnt here
						</p>
						<p><a href="<?php echo get_option('home'); ?>">Return to the homepage</a></p>
						</div>
					</div>
				<?php endif; ?>	
		</div><!--end main-->
				<?php get_footer(); ?>