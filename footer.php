		<div class="clearfix"></div>
		<div id="footer">
		<p>All Rights Reserved &copy; 2011</p>
		</div><!--end footer-->
	</div><!--end container-->
	 <script src="http://code.jquery.com/jquery-latest.js"></script> 
	  <!--   jquery image gallery-->
	  	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/galleriffic-4.css" type="text/css" />
	  	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.history.js"></script>
	  	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.galleriffic.js"></script>
	  	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.opacityrollover.js"></script>
	  	<!-- We only want the thunbnails to display when javascript is disabled -->
	  	<script type="text/javascript">
	  		document.write('<style>.noscript { display: none; }</style>');
	  	</script>
	 <!-- 	end gallery-->
	<!-- Fancybox-->
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/jquery.fancybox.css" media="screen" />
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.fancybox.js"></script>
	<!--end fancybox-->
	   <script src="<?php bloginfo('template_url'); ?>/js/scripts.js"></script> 
	<link rel= "shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" />
	   <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/thumbs.js"></script>
	  		<style type="text/css">
	  		<?php echo get_option('nt_custom_css'); ?>
	  		</style>
<script type='text/javascript'>
$('#copy').click(function(evt){
    evt.preventDefault();
    $('input[name="ship_fname"]').val(jQuery('input[name="fname"]').val());
    $('input[name="ship_lname"]').val(jQuery('input[name="lname"]').val());
    $('input[name="ship_address1"]').val(jQuery('input[name="address1"]').val());
    $('input[name="ship_address2"]').val(jQuery('input[name="address2"]').val());
    $('input[name="ship_city"]').val(jQuery('input[name="city"]').val());
    $('input[name="ship_state"]').val(jQuery('input[name="state"]').val());
    $('input[name="ship_zip"]').val(jQuery('input[name="zip"]').val());
});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>
<script type="text/javascript">
	jQuery(function($){
		$.supersized({slides : [ { image : 'http://chaiborg.com/tutorial/wp-content/themes/launcheffect/im/panduhhh.jpg' } ]}); 
	});
</script>
	  			  <?php wp_footer(); ?>
</body>
</html>