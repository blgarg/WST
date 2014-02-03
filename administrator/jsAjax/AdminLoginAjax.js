// JavaScript Document
$(document).ready(function()
{
	
	
	
	$("#login_form").submit(function()
	{
		
		//remove all the class add the messagebox classes and start fading
		if($('#username').val() == ''){ $("#msgbox").html('Please enter username.').addClass('messageboxerror').fadeTo(900,1);$('#username').focus();}
		else if($('#password').val() == ''){ $("#msgbox").html('Please enter password.').addClass('messageboxerror').fadeTo(900,1);$('#password').focus();}
				
		
		else{		
		$("#msgbox").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		//check the username exists or not from ajax
		//check the username exists or not from ajax
		remember = 0;
		
		if(document.getElementById('login-check').checked){
		remember = 1;
		}
		 $.post("login_logout.php",{ controller:'DoLogin',user_name:$('#username').val(),password:$('#password').val(),remember:remember,rand:Math.random() } ,function(data)
					{
						
						if(data=='yes') //if correct login detail
						{  
							$("#messa1").hide();
							$("#messa").hide();
							$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
							{ 
							//add message and change the class of the box and start fading
								$(this).html('Logging in.....').addClass('messageboxok').fadeTo(900,1,function()
								{ 
								//redirect to secure page
								document.location='index.php';
								});
							
							});
						}
					else 
					{
						$("#messa1").hide();
						$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
						{ 
						//add message and change the class of the box and start fading
							$(this).html('Your login details may be incorrect.').addClass('messageboxerror').fadeTo(900,1);
						});		
					}
			
				
        });
 		//not to post the  form physically
		}
		return false; 
	});
	
	
	
	
	$("#forget_password_form").submit(function()
	{  
		//remove all the class add the messagebox classes and start fading
		var emailReg  = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
       	if($('#UserEmail').val() == ''){ $("#messa").html('Please enter email.').addClass('messageboxerror1').fadeTo(900,1);$('#UserEmail').focus();}
		else if(!emailReg.test($('#UserEmail').val())){ $("#messa").html('Invalid email.').addClass('messageboxerror1').fadeTo(900,1);$('#UserEmail').focus();}
		else{		
		$("#messa").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		//check the username exists or not from ajax
		 $.post("login_logout.php",{ controller:'ResetPass',UserEmail:$('#UserEmail').val(),rand:Math.random() } ,function(data)
					{
						
					
						if(data=='yes') //if correct login detail
						{  
							
							$("#messa").fadeTo(500,0.1,function()  //start fading the messagebox
							{ 
							//add message and change the class of the box and start fading
								$(this).html('Sending in.....').addClass('messageboxok').fadeTo(500,1,function()
								{ 
									$(this).html('').addClass('messageboxok').fadeTo(500,1,function(){
										//redirect to secure page
										$("#loginbox").show();
										$("#messa1").show();
										$("#messa1").html('New password has been sent to your mail');
										$("#forgotbox").hide();
										
										
										$("#msgbox").hide();
										$('#UserEmail').val('');
										setInterval(function(){document.location='login.php'},5000);
							 
									});
									
								});
							
							});
						}
					else 
					{
						$("#messa").fadeTo(200,0.1,function() //start fading the messagebox
						{ 
						//add message and change the class of the box and start fading
							$(this).html('Your email may be incorrect.').addClass('messageboxerror1').fadeTo(900,1);
						});		
					}
			
				
        });
 		//not to post the  form physically
		}
		return false; 
	});
	//now call the ajax also focus move from 
	/*$("#password").blur(function()
	{
		$("#login_form").trigger('submit');
	});*/
});