	<?php /* Template Name: Store
	 */ ?>
	
	
	<?php get_header(); ?>
	<div id="container">
		<div class="main">
		<h1>Store</h1>
			<?php get_sidebar(); ?>
			<div class="store-main">
			<?php
			
			 $loop = new WP_Query( array( 'post_type' => 'product', 'posts_per_page' => 50 ) ); ?>
			
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<div class="store-thumb">
				<?php if ( has_post_thumbnail()) : ?>
					<a href="<?php the_permalink(); ?>"  title="<?php the_title_attribute(); ?>" >  <?php the_post_thumbnail(); ?></a>
								 <?php endif; ?>
				</div><!--end store-thumb-->
				 			<?php endwhile; ?>
				 				 </div>
		<?php get_footer(); ?>