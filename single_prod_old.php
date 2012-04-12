<?php /* Template Name: Store
 */ ?>
<?php get_header(); ?>
<div id="container">
	<div class="main">
	<h1><?php single_post_title(); ?></h1>
					<?php get_sidebar(); ?>
			<div class="store-main">
			<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<div class="gallery">
		<!-- Start Advanced Gallery Html Containers -->
					<div id="gallery" class="content">
						<div id="controls" class="controls"></div>
						<div class="slideshow-container">
							<div id="loading" class="loader"></div>
							<div id="slideshow" class="slideshow"></div>
						</div>
					</div>
					<div id="thumbs" class="navigation">
						<ul class="thumbs noscript">	
						<?php if ( get_post_meta($post->ID, '_cd_opengraph_image1', true) ) : ?>
								<li>
						       <a class="thumb" name="drop"  href=" <?php echo get_post_meta($post->ID, '_cd_opengraph_image1', true) ?> " title="Title #1"><img src="<?php echo get_post_meta($post->ID, '_cd_opengraph_image1', true) ?>"></a>
						       </li>
						<?php endif; ?>
						<?php if ( get_post_meta($post->ID, '_cd_opengraph_image2', true) ) : ?>
								<li>
						       <a class="thumb" name="drop2"  href=" <?php echo get_post_meta($post->ID, '_cd_opengraph_image2', true) ?>" title="Title #1"><img src="<?php echo get_post_meta($post->ID, '_cd_opengraph_image2', true) ?>"></a>
						       </li>
						<?php endif; ?>
						<?php if ( get_post_meta($post->ID, '_cd_opengraph_image3', true) ) : ?>
								<li>
						       <a class="thumb" name="drop3"  href=" <?php echo get_post_meta($post->ID, '_cd_opengraph_image3', true) ?>" title="Title #1"><img src="<?php echo get_post_meta($post->ID, '_cd_opengraph_image3', true) ?>"></a>
						       </li>
						<?php endif; ?>
						<?php if ( get_post_meta($post->ID, '_cd_opengraph_image4', true) ) : ?>
								<li>
						       <a class="thumb" name="drop4"  href=" <?php echo get_post_meta($post->ID, '_cd_opengraph_image4', true) ?>" title="Title #1"><img src="<?php echo get_post_meta($post->ID, '_cd_opengraph_image4', true) ?>"></a>
						       </li>
						<?php endif; ?>
						<?php if ( get_post_meta($post->ID, '_cd_opengraph_image5', true) ) : ?>
								<li>
						       <a class="thumb" name="drop5"  href=" <?php echo get_post_meta($post->ID, '_cd_opengraph_image5', true) ?>" title="Title #1"><img src="<?php echo get_post_meta($post->ID, '_cd_opengraph_image5', true) ?>"></a>
						       </li>
						<?php endif; ?>
						<?php if ( get_post_meta($post->ID, '_cd_opengraph_image6', true) ) : ?>
								<li>
						       <a class="thumb" name="drop6"  href=" <?php echo get_post_meta($post->ID, '_cd_opengraph_image6', true) ?>" title="Title #1"><img src="<?php echo get_post_meta($post->ID, '_cd_opengraph_image6', true) ?>"></a>
						       </li>
						<?php endif; ?>
						</ul>
					</div>
					<!-- End Advanced Gallery Html Containers -->
				</div><!--end gallery-->
				<ul class="item-meta" >
					
					<?php if ( get_post_meta($post->ID, '_cd_price', true) ) : ?>
							<li class="price">
					       <?php echo get_post_meta($post->ID, '_cd_price', true) ?> 
					       </li>
					<?php endif; ?>
					
					</li>
					<li class="add"><a href="#inline1" class="fancybox">Order</a></li>
				</ul>
				
				<div class="clearfix"></div>
				<div class="item-descript">
					<?php the_content(); ?>
				</div>
				<div class="pagination">
				<p class="older"><?php previous_post_link('%link', '«Previous'); ?> </p>
				<p class="newer"> <?php next_post_link('%link', 'Next»'); ?>  </p>
				</div>
				<div id="inline1" style="width:400px;display: none;">
				<h2>Payment Info</h2>
				<?php echo do_shortcode('
				[stripe_form_begin test=true]
				[stripe_form_standard_amount short=true amount=20.00]
				[stripe_form_end]
				[stripe_form_receipt]
				'); ?>
					<?php if ( get_post_meta($post->ID, '_cd_price', true) ) : ?>
							
					    <p class="price">   <?php echo get_post_meta($post->ID, '_cd_price', true) ?> 
					   </p>
					<?php endif; ?>
					<?php if ( get_post_meta($post->ID, 'my_meta_box_text', true) ) : ?>
					<?php echo get_post_meta($post->ID, 'my_meta_box_text', true) ?>
					<?php endif; ?>
					<div class="stripe">
					</div>
				</div>
				
									<?php endwhile; ?>	
			</div><!--end end store main-->
		<?php else : ?>
				<h1>Sorry!</h1>
					<div class="post">
					<h2>
						But your looking for something that isnt here
					</h2>
					<p><a href="<?php echo get_option('home'); ?>">Return to the homepage</a></p>
					</div>
							<?php endif; ?>	
				</div>
	
		<?php get_footer(); ?>

