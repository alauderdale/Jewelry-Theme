<?php  
add_action( 'add_meta_boxes', 'cd_add_opengraph_meta' );  
function cd_add_opengraph_meta()  
{  
    add_meta_box( 'opengraph-meta', 'Opengraph', 'cd_opengraph_meta_cb', 'product', 'normal', 'high' );  
}  
  
function cd_opengraph_meta_cb( $post )  
{  
    // Grab our data to fill out the meta boxes (if it's there)  
    $image1 = get_post_meta( $post->ID, '_cd_opengraph_image1', true ); 
    
    $image2 = get_post_meta( $post->ID, '_cd_opengraph_image2', true ); 
    
      $image3 = get_post_meta( $post->ID, '_cd_opengraph_image3', true ); 
    
      $proce = get_post_meta( $post->ID, '_cd_price', true );
 
    // Add a nonce field 
    wp_nonce_field( 'save_opengraph_meta', 'opengraph_nonce' ); 
    ?> 
    <p> 
        <label for="og-image">Product thumb 1</label><br /> 
        <input type="text" id="og-image" style="width:300px" name="_cd_opengraph_image1" value="<?php echo esc_url( $image1 ); ?>" /> 
        <input type="button" id="cdog-thickbox" value="Upload Image" /><br/> 
    </p> 
    <p> 
        <label for="og-image2">Product thumb 2</label><br /> 
        <input type="text" id="og-image2" style="width:300px" name="_cd_opengraph_image2" value="<?php echo esc_url( $image2 ); ?>" /> 
        <input type="button" id="cdog-thickbox2" value="Upload Image" /><br/> 
    </p> 
    <p> 
        <label for="og-image3">Product thumb 3</label><br /> 
        <input type="text" id="og-image3" style="width:300px" name="_cd_opengraph_image3" value="<?php echo esc_url( $image3 ); ?>" /> 
        <input type="button" id="cdog-thickbox3" value="Upload Image" /><br/> 
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
}  
  
add_action( 'admin_print_scripts-post.php', 'cd_opengraph_enqueue' );  
add_action( 'admin_print_scripts-post-new.php', 'cd_opengraph_enqueue' );  
function cd_opengraph_enqueue()  
{  
    wp_enqueue_script( 'cdog-thickbox', get_bloginfo( 'template_url' ) . '/thickbox-hijack.js', array(), NULL );  
}  



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
			'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail' ),
			'public' => true,
			
		)
		
	);
}