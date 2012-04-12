$(function(){

    $("#form").submit(function(e){
 	
      	e.preventDefault();

        dataString = $("#form").serialize();
        
        $.ajax({
        type: "POST",
        url: "wp-content/themes/jewlry_theme/post.php",  // This receives the form data
        data: dataString,  // This is the data from our form that we serialized above
        dataType: "json",  // Let the function know that we're going to be sending it the JSON-formatted string
        success:  // What to do when the data posts successfully
        	function(data) {

	            if(data.email_check == "invalid"){
	                
	                $('#error').html('Invalid Email.');

	            } else {
	            	
	            	if(data.reuser == "true") {
	            	
		            	$('#form, #error, #presignup-content').hide();
		                $('#returning').fadeIn();
		                
		                var returningCode = $('span.dirname').text() + '/' + data.returncode;
		                
		                $('#returning span.user').text(data.email);
		                $('#returning span.clicks').text(data.clicks);
		                $('#returning span.conversions').text(data.conversions);
		                
		                $('#returning input#returningcode').attr('value',returningCode);

	            	} else {
	            	
		            	$('#form, #error, #presignup-content').hide();
		                $('#success, #success-content').fadeIn();
		                
		                var referCode = $('span.dirname').text() + '/' + data.code;
		                
		                $('#success input#successcode').attr('value',referCode);
	          				            		
	            	}
	                    
	            }	
	        }

        });          

    });
});


$(document).ready(function(){

	// VERTICAL CENTERING
		
	var containerHeight = $('#container').height();
	$('#container').css('height',containerHeight);

});