
/*// JavaScript Document
$(document).ready(function()
{    	loadFeaturedPost();
	});	

function loadFeaturedPost()
{
		$.ajax({
	   type: "POST",
	   url: "./lib/blog.php",
	   data: "act=blog",
	   success: function(data){
		  $("#featuredPost").html(data)  //start fading the messagebox
		 /// setTimeout('loadFeaturedPost()',9000);
		  return false;
	   }
	 });
	 
 }
 */
  $(document).ready(function(){
  // contactus validation
  $("#contactus").validate({
	rules: {
				yname:{
							required: true
						},
				subject:{
							required: true
					},
				email:{
							required: true,
							email: true
				}
			},
	messages: {
				yname:{
						required:"Please enter your name"
					},
				subject:{
							required:"Please enter your subject"
				},
				email:{
						    required:"Please enter your email",
							email: "Please enter valid email"
				}	
			  }
  });
  //login form validation
    $("#login").validate({
		 rules: {
					email: {
								required: true,
								email: true
							  },
					password: {
								required: true
							  },
					captcha_code :{
								required: true
								}
                },
		messages: {
					email :{
								required: "Please enter email ID",
								email: "Enter a valid email ID"
							  },
					password :{
								required: "Please enter password"	
							  },
					captcha_code :{
								required: "Please enter the secret code"
							}
		}
	});
	// forgot form validation
	    $("#forogt").validate({
		 rules: {
					email: {
								required: true,
								email: true
						   }
                },
		messages: {
					email :{
								required: "Enter your email ID",
								email: "Enter a valid email ID"
						   }
		}
	});
// confirm password validation
$("#resetpass").validate({
		 rules: {
					new_password: {
								required: true
								},
					confirm_new_password: {
							required: true
					},
					confirm_new_password: {
							equalTo: "#new_password"
					}
                },
		messages: {
					new_password :{
								required: "Enter your new password"
								},
					confirm_new_password :{
								required: "Enter your confirm password"
								},
					confirm_new_password :{
								equalTo: "Confirm password does not match"
								}
		}
	});
  });