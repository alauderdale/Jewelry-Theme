<div class="sidebar">		
		<ul id="categories">
		<h3> Categories </h3>
		
			<?php 
			wp_tag_cloud( array( 'taxonomy' => 'location', format => 'list' ) );
			
			 ?>
		</ul>
</div><!--end end sidebar-->
		</div><!--end main-->