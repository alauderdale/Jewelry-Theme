<?php /* Template Name: Splash
 */ ?>
 
 <?php header('HTTP/1.1 200 OK'); ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> >
 
 <head profile="http://gmpg.org/xfn/11">
 	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
 <title><?php wp_title(''); ?> <?php bloginfo('name'); ?></title>
 <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />
 <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" media="screen" />
 <?php wp_head(); ?>
 </head>
 <body>
 
 <?php
 
 
 session_start();
 

 
 $_SESSION['referredBy'] = $referredindex;
 
 logVisits($stats_table, $referredindex);
 
 ?>
 
 	<div id="outer-container"> 
 	
 		<div id="container"> 
 	
 			<div id="inner-container"> 
 			
 			
 				<!-- STORE BASE URL -->
 				<span class="dirname"><?php bloginfo('url'); ?></span>	
 				
 				
 				
 				<div id="presignup-content">
 					<h2>SIGN UP FOR PRIVATE BETA</h2>
 					<?php if (have_posts()) : ?>
 					<?php while (have_posts()) : the_post(); ?>
 						<?php the_content(''); ?>
 					<?php endwhile; ?>	
 						<?php endif; ?>	
 				</div>
 				
 				<div id="success-content">
 					<h2>THANKS! WANT TO IMPROVE YOUR CHANCES OF WINNING TICKETS?</h2>
 					<p>Invite friends to our email list using the link below. The more friends you invite, the better your chances!</p>
 				</div>				
 				
 				<!-- FORM (PRE-SIGNUP) -->
 				<form id="form" action="">
 					<fieldset>
 				
 						<input type="hidden" name="code" id="code" value="<?php codeCheck(); ?>" />
 						
 						<label for="email">Enter your email address:</label>
 						<input type="text" id="email" name="email" />
 						
 						<span id="submit-button-border"><input type="submit" name="submit" value="Go" id="submit-button" /></span>
 						
 						<div id="error"></div>
 					
 					</fieldset>
 				</form>
 				
 				
 				<!-- FORM (POST-SIGNUP) -->
 				<form id="success" action="">
 					<fieldset>
 						<label>To share, copy and paste the link below:</label>
 						<input type="text" id="successcode" value=""/>	
 					</fieldset>
 				</form>
 				
 				
 				<!-- FORM (RETURNING VISITOR) -->
 				<form id="returning" action="">
 					<fieldset>
 						<h2>Hello!</h2>
 						<p>Welcome back <span class="user"> </span>.<br /><span class="clicks"> </span> clicked your link so far and <span class="conversions"> </span> signed up.<br /><br /></p>
 						
 						<label>Here's your unique URL:</label>
 						<input type="text" id="returningcode" value=""/>
 					</fieldset>
 				</form>
 				
 				<div class="clear"></div>
 			
 			</div> 
 	
 		</div> 
 	
 	</div> 
 	
 <?php get_footer(); ?>