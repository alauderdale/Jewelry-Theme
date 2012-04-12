<?php get_header(); ?>
<div id="container">
	<div class="main">
			<h1>News</h1>
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<div class="post">
			<h2><?php the_title(); ?></h2>
			<div class="post-meta">
				Posted on <a href="#"><?php the_time('d'); ?> <span><?php the_time('M'); ?> </span><span><?php the_time('Y'); ?></a>
			</div>
				<?php the_content(); ?>
		</div><!--end post-->
					<?php endwhile; ?>	
	</div><!--end main-->
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
	