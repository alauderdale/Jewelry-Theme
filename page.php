<?php get_header(); ?>
<div id="container">
	<div class="main">
		<h1><?php the_title(); ?></h1>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
	<?php the_content(''); ?>
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
