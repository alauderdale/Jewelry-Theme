<?php get_header(); ?>

<div id="container">
	<div class="main">
	<h1><?php single_cat_title(); ?></h1>
	
		<?php get_sidebar(); ?>

		<div class="store-main">
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div class="store-thumb">
			
			<?php if ( has_post_thumbnail()) : ?>
				<a href="<?php the_permalink(); ?>"  title="<?php the_title_attribute(); ?>" >  <?php the_post_thumbnail(); ?></a>
			 <?php endif; ?>

		</div><!--end store-thumb-->
		<?php endwhile; ?>
		 <?php endif; ?>
	 </div>
			 									
	<?php get_footer(); ?>