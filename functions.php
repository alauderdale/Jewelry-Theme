<?php 

// ENQUEUE THEME SCRIPTS
function le_scripts() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js' );
	wp_enqueue_script( 'jquery' );
	wp_register_script('le_script_supersize', get_template_directory_uri() . '/js/supersized.3.1.3.core.min.js', array('jquery'), '1.0' );
	wp_enqueue_script('le_script_supersize');
	wp_register_script('le_script_init', get_template_directory_uri() . '/js/init.js', array('jquery'), '1.0' );
	wp_enqueue_script('le_script_init');
}
add_action('wp_enqueue_scripts', 'le_scripts');


// CREATE TABLES
require_once(TEMPLATEPATH . '/functions/le-tables.php');

// QUERY FUNCTIONS
require_once(TEMPLATEPATH . '/functions/le-functions.php');

// STATS PAGE
require_once(TEMPLATEPATH . '/functions/le-stats.php');

?>
<?php 
stripe_register_payment_end_callback('my_payment_end_callback');
function my_payment_end_callback($response) {
    // All the form variables are accessible in the $response array
    $to = $response['email'];
    $subject = 'Shipping Address Example';

    $email = new StripeEmailHelper();
    $body = $email->createBody("Shipping Address Example", "This is a summary of a the data collected by the form.", $response);
    $email->sendEmail($to, $subject, $body);
}
 ?>
<?php

add_action( 'add_meta_boxes', 'cd_meta_box_add' );
function cd_meta_box_add()
{
	add_meta_box( 'my-meta-box-id', 'Product Description', 'cd_meta_box_cb', 'product', 'normal', 'high' );
}

function cd_meta_box_cb( $post )
{
	$values = get_post_custom( $post->ID );
	$text = isset( $values['my_meta_box_text'] ) ? esc_attr( $values['my_meta_box_text'][0] ) : '';
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>
	<textarea name="my_meta_box_text" id="my_meta_box_text" cols="50" rows="5" /><?php echo $text; ?></textarea>
	<?php	
}


add_action( 'save_post', 'cd_meta_box_save' );
function cd_meta_box_save( $post_id )
{
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	// now we can actually save the data
	$allowed = array( 
		'a' => array( // on allow a tags
			'href' => array() // and those anchords can only have href attribute
		)
	);
	
	// Probably a good idea to make sure your data is set
	if( isset( $_POST['my_meta_box_text'] ) )
		update_post_meta( $post_id, 'my_meta_box_text', wp_kses( $_POST['my_meta_box_text'], $allowed ) );
}
?>
<?php  
add_action( 'add_meta_boxes', 'cd_add_opengraph_meta' );  
function cd_add_opengraph_meta()  
{  
    add_meta_box( 'opengraph-meta', 'Product Info', 'cd_opengraph_meta_cb', 'product', 'normal', 'high' );  
}  
  
function cd_opengraph_meta_cb( $post )  
{  
    // Grab our data to fill out the meta boxes (if it's there)  
    $image1 = get_post_meta( $post->ID, '_cd_opengraph_image1', true ); 
    
    $image2 = get_post_meta( $post->ID, '_cd_opengraph_image2', true ); 
    
      $image3 = get_post_meta( $post->ID, '_cd_opengraph_image3', true ); 
      
    $image4 = get_post_meta( $post->ID, '_cd_opengraph_image4', true ); 
    
    $image5 = get_post_meta( $post->ID, '_cd_opengraph_image5', true ); 
    
      $image6 = get_post_meta( $post->ID, '_cd_opengraph_image6', true ); 
      
     $price = get_post_meta( $post->ID, '_cd_price', true ); 
 
    // Add a nonce field 
    wp_nonce_field( 'save_opengraph_meta', 'opengraph_nonce' ); 
    ?> 
    <p> 
        <label for="og-image">Product thumb 1</label><br /> 
        <input type="text" id="og-image" style="width:300px" name="_cd_opengraph_image1" value="<?php echo esc_url( $image1 ); ?>" /> 
    </p> 
    <p> 
        <label for="og-image2">Product thumb 2</label><br /> 
        <input type="text" id="og-image2" style="width:300px" name="_cd_opengraph_image2" value="<?php echo esc_url( $image2 ); ?>" /> 
    </p> 
    <p> 
        <label for="og-image3">Product thumb 3</label><br /> 
        <input type="text" id="og-image3" style="width:300px" name="_cd_opengraph_image3" value="<?php echo esc_url( $image3 ); ?>" /> 
    </p> 
    <p> 
        <label for="og-image4">Product thumb 4</label><br /> 
        <input type="text" id="og-image4" style="width:300px" name="_cd_opengraph_image4" value="<?php echo esc_url( $image4 ); ?>" /> 
    </p> 
    <p> 
        <label for="og-image5">Product thumb 5</label><br /> 
        <input type="text" id="og-image5" style="width:300px" name="_cd_opengraph_image5" value="<?php echo esc_url( $image5 ); ?>" /> 
    </p> 
    <p> 
        <label for="og-image6">Product thumb 6</label><br /> 
        <input type="text" id="og-image6" style="width:300px" name="_cd_opengraph_image6" value="<?php echo esc_url( $image6 ); ?>" /> 
    </p> 
    <p> 
        <label >Price (for display, remember to set this in form as well)</label><br /> 
        <input type="text" id="price" style="width:300px" name="_cd_price" value="<?php echo esc_attr( $price ); ?>" /> 
    </p> 

    <?php 
} 
 
add_action( 'save_post', 'cd_opengraph_save' ); 
function cd_opengraph_save( $id ) 
{ 
    // No auto saves 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;  
 
    // Check our nonce 
    if( !isset( $_POST['opengraph_nonce'] ) || !wp_verify_nonce( $_POST['opengraph_nonce'], 'save_opengraph_meta' ) ) return; 
 
    // make sure the current user can edit the post 
    if( !current_user_can( 'edit_post' ) ) return; 
 
 
    // make sure we get a clean url here with esc_url 
    if( isset( $_POST['_cd_opengraph_image1'] ) ) 
        update_post_meta( $id, '_cd_opengraph_image1', esc_url( $_POST['_cd_opengraph_image1'], array( 'http' ) ) );  


    if( isset( $_POST['_cd_opengraph_image2'] ) ) 
        update_post_meta( $id, '_cd_opengraph_image2', esc_url( $_POST['_cd_opengraph_image2'], array( 'http' ) ) );  
        
    if( isset( $_POST['_cd_opengraph_image3'] ) ) 
        update_post_meta( $id, '_cd_opengraph_image3', esc_url( $_POST['_cd_opengraph_image3'], array( 'http' ) ) ); 
        
      if( isset( $_POST['_cd_opengraph_image4'] ) ) 
           update_post_meta( $id, '_cd_opengraph_image4', esc_url( $_POST['_cd_opengraph_image4'], array( 'http' ) ) );  
   
   
       if( isset( $_POST['_cd_opengraph_image5'] ) ) 
           update_post_meta( $id, '_cd_opengraph_image5', esc_url( $_POST['_cd_opengraph_image5'], array( 'http' ) ) );  
           
       if( isset( $_POST['_cd_opengraph_image6'] ) ) 
           update_post_meta( $id, '_cd_opengraph_image6', esc_url( $_POST['_cd_opengraph_image6'], array( 'http' ) ) ); 
           
      if( isset( $_POST['_cd_price'] ) ) 
          update_post_meta( $id, '_cd_price', esc_attr( strip_tags( $_POST['_cd_price'] ) ) ); 
}  
  
add_action( 'admin_print_scripts-post.php', 'cd_opengraph_enqueue' );  
add_action( 'admin_print_scripts-post-new.php', 'cd_opengraph_enqueue' );  
function cd_opengraph_enqueue()  
{  
    wp_enqueue_script( 'cdog-thickbox', get_bloginfo( 'template_url' ) . '/thickbox-hijack.js', array(), NULL );  
}  



?>
<?php

$themename = "En Tramblant";
$shortname = "nt";

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category"); 

$options = array (
 
array( "name" => $themename." Options",
	"type" => "title"),
 

array( "name" => "General",
	"type" => "section"),
array( "type" => "open"),
 
	
array( "name" => "timepiece Image Url",
	"desc" => "Enter the link to the timepiece page image",
	"id" => $shortname."_timepiece",
	"type" => "text",
	"std" => ""),

array( "name" => "parure Image Url",
	"desc" => "Enter the link to the parure page image",
	"id" => $shortname."_parure",
	"type" => "text",
	"std" => ""),

array( "name" => "braclets Image Url",
	"desc" => "Enter the link to the braclets page image",
	"id" => $shortname."_braclets",
	"type" => "text",
	"std" => ""),

array( "name" => "rings Image Url",
	"desc" => "Enter the link to the rings page image",
	"id" => $shortname."_rings",
	"type" => "text",
	"std" => ""),

array( "name" => "necklaces Image Url",
	"desc" => "Enter the link to the necklace page image",
	"id" => $shortname."_necklaces",
	"type" => "text",
	"std" => ""),

array( "name" => "earings Image Url",
	"desc" => "Enter the link to the earings page image",
	"id" => $shortname."_earings",
	"type" => "text",
	"std" => ""),
	
	
array( "name" => "Custom CSS",
	"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}",
	"id" => $shortname."_custom_css",
	"type" => "textarea",
	"std" => ""),		
	

array( "type" => "close")
 
);


function mytheme_add_admin() {
 
global $themename, $shortname, $options;
 
if ( $_GET['page'] == basename(__FILE__) ) {
 
	if ( 'save' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
 
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
 
	header("Location: admin.php?page=functions.php&saved=true");
die;
 
} 
else if( 'reset' == $_REQUEST['action'] ) {
 
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
 
	header("Location: admin.php?page=functions.php&reset=true");
die;
 
}
}
 
add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
}

function mytheme_add_init() {

$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/functions/functions.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/functions/rm_script.js", false, "1.0");

}
function mytheme_admin() {
 
global $themename, $shortname, $options;
$i=0;
 
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
 
?>
<div class="wrap rm_wrap">
<h2><?php echo $themename; ?> Settings</h2>
 
<div class="rm_opts">
<form method="post">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
 
<?php break;
 
case "close":
?>
 
</div>
</div>
<br />

 
<?php break;
 
case "title":
?>
<p>To easily use the <?php echo $themename;?>, you can use the menu below.</p>

 
<?php break;
 
case 'text':
?>

<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
<?php
break;
 
case 'textarea':
?>

<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
 
case "checkbox":
?>

<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 
case "section":

$i++;

?>

<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/functions/images/trans.gif" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
</span><div class="clearfix"></div></div>
<div class="rm_options">

 
<?php break;
 
}
}
?>
 
<input type="hidden" name="action" value="save" />
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

 </div> 
 

<?php
}
?>
<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>
<?php

register_sidebar(array(
'name' => 'main sidebar',
'before_widget' => '<li id="%1$s" class="widget %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3 class="widgettitle">',
'after_title' => '</h3>',
));


  register_nav_menu( 'main_nav', __( 'Main navigation menu', 'mytheme' ) );
  
  
  if ( function_exists( 'add_theme_support' ) ) { 
    add_theme_support( 'post-thumbnails' ); 
  }
 
 // === CUSTOM TAXONOMIES === //
 function my_custom_taxonomies() {
 	register_taxonomy(
 		'location',		// internal name = machine-readable taxonomy name
 		'product',		// object type = post, page, link, or custom post-type
 		array(
 			'hierarchical' => true,
 			'label' => 'Type of Product',	// the human-readable taxonomy name
 			'query_var' => true,	// enable taxonomy-specific querying
 			'rewrite' => array( 'slug' => '?location=' ),	// pretty permalinks for your taxonomy?
 		)
 	);

 
 }
 add_action('init', 'my_custom_taxonomies', 0);
  
 ?>
<?php

add_action( 'init', 'create_my_post_types' );

function create_my_post_types() {
	register_post_type( 'product',
		array(
			'labels' => array(
				'name' => __( 'Products' ),
				'singular_name' => __( 'Product' )
				
			),
			'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'cats' ),
			'public' => true,
			'has_archive' => true,
			
		)
		
	);
}
?>