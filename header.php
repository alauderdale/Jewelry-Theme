<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> >

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title(''); ?> <?php bloginfo('name'); ?></title>
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" />
<?php wp_head(); ?>
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" media="screen" />

</head>
<body>
	<div id="header">
		<div id="nav">
			<div class="logo">
			<a  href="<?php echo get_option('home'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png"></a>
			</div>
			<ul id="top-nav">
				<?php wp_nav_menu( array( 'theme_location' => 'main_nav' ) );   ?>
			</ul>
		</div><!--end nav-->
	</div> <!--end header-->
	<div class="header-padding"></div>