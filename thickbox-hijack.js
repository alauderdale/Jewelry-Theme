jQuery(document).ready(function()  
{  
    var ogfield = null; 

    
  
    jQuery( '#cdog-thickbox' ).click(function()  
    {  
        ogfield = jQuery( 'input#og-image' ).attr( 'name' );  
        tb_show( '', 'media-upload.php?type=image&TB_iframe=true' );  
        return false;  
    });  
    
    window.send_to_editor_old = window.send_to_editor;  
  
    window.send_to_editor = function( html )  
    {  
        var ogimg;  
  
        if( ogfield != null )  
        {  
            ogimg = jQuery( 'img', html ).attr( 'src' );  
            jQuery( 'input#og-image' ).val( ogimg );   
            tb_remove();  
            ogfield = null;  
        }  
        else  
        {  
            window.send_to_editor_old( html );  
        }     
  
    };  
    
    
    
    
}); 