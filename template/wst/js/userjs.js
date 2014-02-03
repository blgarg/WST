/*  Do Registration Start */
function getStateList(cId){
	if(cId!='1'){
	$('#statetd').html('<input type="text" name="stateText" id="stateText" maxlength="70" class="Sign_up-input">');
	}else{
		 $('#statetd').html('<select name="state" id="state" maxlength="70" class="selectbox" style="width:183px !important;"/></select>'); 
		  $.ajax({
          type: "POST",
          url: "./lib/usersModel.php",
          data: "cId="+cId+"&action=getStateList",
          success: function(msg){
	      $('#state').html(msg);
          }
         });
	}
}
function doregistration(){
	$("span#msgbox").html('');
	 if(trim($('#first_name').val())==''){
		 $("span#msgbox").html('Please enter your first name.').addClass('messageboxerror').fadeTo(900,1);
         $('#first_name').focus()
	     return false;
	 }
	  if(trim($('#email_add').val())==''){
		  $("span#msgbox").html('Please enter your email address.').addClass('messageboxerror').fadeTo(900,1);
		 $('#email_add').focus()
	     return false;
	 }if(!isValidemail($('#email_add').val())){
	  $("span#msgbox").html('Please enter valid email address.').addClass('messageboxerror').fadeTo(900,1);
	     $('#email_add').focus()
	     return false;
	} 
	if(trim($('#password').val())==''){
		 $("span#msgbox").html('Please enter your password.').addClass('messageboxerror').fadeTo(900,1);
		 $('#password').focus()
	     return false;
	 }if($('#password').val().length < 6){
        $("span#msgbox").html('Please enter minimum 6 characters in password.').addClass('messageboxerror').fadeTo(900,1);
		 $('#password').focus()
	     return false;
	 }if($('#birth_year').val()=='0'){
	     $("span#msgbox").html('Please select year of birth.').addClass('messageboxerror').fadeTo(900,1);
		  return false;
	  }if($('#birth_month').val()=='0'){
	     $("span#msgbox").html('Please select month of birth.').addClass('messageboxerror').fadeTo(900,1);
		  return false;
	  }if($('#birth_day').val()=='0'){
		  $("span#msgbox").html('Please select day of birth.').addClass('messageboxerror').fadeTo(900,1);
	        return false;
	  }   
	 if($('#country').val()=='0'){
		 $("span#msgbox").html('Please select  your country.').addClass('messageboxerror').fadeTo(900,1);
		   return false;
	 }if(document.getElementById('stateText')){
	   
	   if(trim($('#stateText').val())==''){
		 $("span#msgbox").html('Please enter your city name.').addClass('messageboxerror').fadeTo(900,1);
		 $('#stateText').focus()
	     return false;
	  }
	  var stateText = $('#stateText').val();
	   
	 var  state = 0;
	 }
var birthDate = $('#birth_year').val()+'-'+$('#birth_month').val()+'-'+$('#birth_day').val();
	 var gender = 'm';
	 
	 if($("#female").is(':checked')){
	  gender = 'f';
	 }
	var bio = '';
	 if(document.getElementById('bio')){
	  bio= $('#bio').val()
	 }
 var profilePic = $('#youtubepic').val();
	 $('a#Do_registration_load').html("<img src='./template/system/images/processing.gif'  id='Registration' height='30'/>");
	 $.ajax({
          type: "POST",
          url: "./lib/usersModel.php",
          data: "first_name="+$('#first_name').val()+"&last_name="+$('#last_name').val()+"&email_add="+$('#email_add').val()+"&username="+$('#username_add').val()+"&facebookusername="+$('#facebookUsername').val()+"&isyoutubeauth="+$('#isyoutubeauth').val()+"&birth_date="+birthDate+"&gender="+gender+"&profilePic="+profilePic+"&subscriber="+$('#subscriber').val()+"&password="+$('#password').val()+"&country="+$('#country').val()+"&state="+state+"&stateText="+stateText+"&bio="+bio+"&action=registeruser&type="+$('#type').val(),
          success: function(msg){
		$('a#Do_registration_load').html("<img src='./template/system/images/Register_btn.png' onclick='doregistration();'  id='Do_registration_load'/>");
		if(msg.replace(/^\s+|\s+$/g,'')=='email exist'){
		   $("span#msgbox").html('Email already exists.Please try another email address.').addClass('messageboxerror').fadeTo(900,1);
		   $('#email_add').val('');
		   $('#email_add').focus();
		}else if(msg.replace(/^\s+|\s+$/g,'')=='user exist'){
		   $("span#msgbox").html('Username already exists.Please try another username.').addClass('messageboxerror').fadeTo(900,1);
		   $('#username_add').val('');
		   $('#username_add').focus();
		}else{
		 $('#sign_up').hide();	
		 $('#chose_option').html(msg);
		 showWaitPopUp('chose_option',1); 
		 $('#first_name').val('')
	     $('#last_name').val('')
	     $('#email_add').val('')
	     $('#birth_date').val('')
	     $('#password').val('')
		  $('#stateText').val('')
		  $('#bio').val('')
	     $("#country").attr('selectedIndex', 0);
		$("#birth_year").attr('selectedIndex', 0);
		 $("#birth_month").attr('selectedIndex', 0);
		 $("#birth_day").attr('selectedIndex', 0);
		 $("#msgbox").hide();
		 $('#male').attr('checked', true);
		 $('#isyoutubeauth').val('0');
	   
		}
	  }
    });
	 return false;
}
function showRegisterationForm(selected){
	
	$("#username_add").attr("disabled",false);
	if(selected=='1'){
		$('#userBio').show();
	     $('#type').val('1');
	}else{
	 $('#userBio').hide();
	  $('#type').val('2');
	}
	$('#chose_registration_option').fadeOut();
}
function getDays(month,year){
	month=parseInt($('#birth_month').val());
	year=parseInt($('#birth_year').val());
	day=parseInt($('#birth_day').val());
   
   if(month!=0 && year!=0){
	    numberofdays=new Date(year, month, 0).getDate();
		var str='<option value="0">Select</option>';
		for(i=1;i<=numberofdays;i++){
		  str += '<option value="'+i+'">'+i+'</option>';
		}
		$('#birth_day').html(str);
		$("select#birth_day").attr('selectedIndex',day);
    }
}
function clearsignUpFields(){
        document.getElementById("divSignIn").style.visibility = "hidden";		
		 $('#msgbox').hide();
		 $('#error').html('');
		 $('#first_name').val('')
	     $('#last_name').val('')
	     $('#email_add').val('')
		 $('#username_add').val('')
	     $('#birth_date').val('')
	     $('#password').val('')
		  $('#stateText').val('')
		   $('#bio').val('')
	     $("#country").attr('selectedIndex', 0);
		/* $("#state").attr('selectedIndex', 0);*/
		 $("#birth_year").attr('selectedIndex', 0);
		 $("#birth_month").attr('selectedIndex', 0);
		 $("#birth_day").attr('selectedIndex', 0);
		 $("#msgbox").hide();
		 $('#male').attr('checked', true);
	     $('#isyoutubeauth').val('0');
	   $.ajax({
					   type: "POST",
					   url: "./lib/fbregisterbutton.php",
					   data: "action=getratefbbutton",
					   success: function(data){
					    $('#face_book_register_button').html(data);   
					   }
			});
}
/*  Do Registration End */
function doLogin(){
	    var remember = '0';
		if($('#remeber').attr('checked')){
		 remember = '1';
		}
		$("span#msgboxlogin").html('');
	     if(trim($('#uname').val())==''){
			 $("#msgboxlogin").html('Please enter email address.').addClass('messageboxerrorlogin').fadeTo(900,1);
			 $('#username').focus();
			 return false;
	     }else if(trim($('#loginpassword').val())==''){
		 $("#msgboxlogin").html('Please enter your password.').addClass('messageboxerrorlogin').fadeTo(900,1);
		 $('#loginpassword').focus();
	     return false;
	    }else{
			$("#msgboxlogin").removeClass().addClass('messageboxerrorlogin').text('Validating....').fadeIn(1000);
			$.ajax({
					   type: "POST",
					   url: "./lib/usersModel.php",
					   data: "username="+$('#uname').val()+"&loginpassword="+$('#loginpassword').val()+"&remember="+remember+"&action=loginuser",
					   success: function(data){
					   
					   if(parseInt(data)==1){
									userType=1;
									islogin = true;
									$("#msgboxlogin").fadeTo(200,0.1,function(){ 
										getArtistHomePage();
										ShowHideSignInDiv();
										$("#LogoUtTheFuction").show();
										$("#loginLogOut").hide();
										 return false; 
									});
							     }
						else if(parseInt(data)==2){
									userType=2;
									islogin = true;
									$("#msgboxlogin").fadeTo(200,0.1,function(){ 
									getfanHomePage();
										ShowHideSignInDiv();
										$("#LogoUtTheFuction").show();
										$("#loginLogOut").hide();
										return false; 
									});
						}else{
						   			
									$("#msgboxlogin").html('Provided details are not valid.').addClass('messageboxerrorlogin').fadeTo(900,1);$('#username').focus();
						   		}
							}
					});
		}
return false; 		
 }
	function clearsignInFields(){
	      $('#loginError').html('');
		  $('#username').val('');
	      $('#loginpassword').val('');
	     
     }
function registerFaceBookUser(){
		$("#username_add").val('');
		$('#isyoutubeauth').val('0');
		if(getCookie('fbs_172091782856668')){
         $('#chose_registration_option').hide();
		    showWaitPopUp('wait_for_registeration',0);
		      $.ajax({
                 type: "POST",
                 url: "./lib/usersModel.php",
                 data: "action=facebookRegister",
                 success: function(msg){
				var myJSONObject =eval('(' +msg+ ')');
				$('#userBio').show();
				if(myJSONObject.bio){
				$('#bio').val(myJSONObject.bio)
				}
				if($('#type').val() == 2){
				$('#bio').val('');
				$('#userBio').hide();
				}
				$('#wait_for_registeration').hide();	  
		        if(myJSONObject.first_name){
		        $('#first_name').val(myJSONObject.first_name)
		        }
				if(myJSONObject.last_name){
		        $('#last_name').val(myJSONObject.last_name)
		        }
				if(myJSONObject.username){
		         $('#facebookUsername').val(myJSONObject.username)
				
		        }
				if($('#facebookUsername').val()=='0'){
				  $('#facebookUsername').val(myJSONObject.id)
				}
				if(myJSONObject.email){
		         $('#email_add').val(myJSONObject.email)
		         }
				   $('#male').attr('checked', true);
				   if(myJSONObject.gender && myJSONObject.gender=='female'){
		           $('#female').attr('checked', true);
                   }
				  if(myJSONObject.birthday) {
					  $birth=myJSONObject.birthday.split('/');
					  var a = document.getElementById('birth_year');
						for(i=0;i<a.length;i++)
						{
						if(a.options[i].value == $birth[2])
						{
						  $("#birth_year").attr('selectedIndex',i);
						}
                    }
					 $birth[1] = ltrim($birth[1]);
					  $birth[0] = ltrim($birth[0]);
					
		              $("#birth_month").attr('selectedIndex',parseInt($birth[0]));
		              $("#birth_day").attr('selectedIndex',parseInt($birth[1]));
					}
					
				if(myJSONObject.hometown){	
					
					if(myJSONObject.hometown.name){
					  $('#stateText').val(myJSONObject.hometown.name);
				   }
				}
		     //   $('#state').html('<option value="0">Select State</option>');
			     showWaitPopUp('sign_up',1)	
              }
          });
		 }else{
		 return false;
		 }
	}
	function getCookie(c_name)
{
var i,x,y,ARRcookies=document.cookie.split(";");
for (i=0;i<ARRcookies.length;i++)
{
  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
  x=x.replace(/^\s+|\s+$/g,"");
  if (x==c_name)
    {
    return unescape(y);
    }
  }
}
function sendPassword(){
   
   if(trim($('#user_email').val())==''){
      // alert('Please enter your email address');
	   $("#forgotpasserror").html('Please enter your email address').addClass('messageboxerrorlogin').fadeTo(900,1);
	   $('#user_email').focus();
	    return false;
	 } else if(!isValidemail($('#user_email').val())){
	   $("#forgotpasserror").html('Please enter valid email address.').addClass('messageboxerror').fadeTo(900,1);
	     $('#user_email').focus()
	     return false;
	}else{
	    $.ajax({
          type: "POST",
          url: "./lib/usersModel.php",
          data: "user_email="+trim($('#user_email').val())+"&action=resetpassword",
          success: function(msg){
	       $('#reset_password').hide();
		   $('#chose_option').html(msg);
		   showWaitPopUp('chose_option',1); 
          }
         });
   }

 }
function clearPasswordField(){
 
  $('#user_email').val('');

}
/*  Do Login Start */

function LogoutUser()
{
	if(!document.getElementById("remeber").checked){
	$('#uname').val('');
	$('#loginpassword').val('');
	}
	$.ajax({
		   type: "POST",
		   url: "./lib/usersModel.php",
		   data: "action=logoutUser&randval="+ Math.random(),
		   success: function(data){ 
		   if(parseInt(data)==1){
			   islogin = false;
						$("#msgboxlogin").fadeTo(200,0.1,function(){ 
							//document.location='?mod=mod_artist&view=default&m=1';
							//getfanHomePage();
							
							loadHome();
							$("#loginLogOut").show();
							$("#LogoUtTheFuction").hide();
						});
					 }
		        }
			});
	}
	function edit_FanUser()
{	
    var arrayField;
	arrayField = $("#Fan_arrayFields").val();
	arrayField = arrayField.split(",");
	var gender = $('input:radio[name=gender]:checked').val();
	var i=0;
	var dataString = '';
	while (i < arrayField.length)
	 {
	  dataString  += arrayField[i]+'='+trim($("#"+arrayField[i]).val())+"&";
	  i+=1;
	  }
	 /*validation*/
	 if(trim($('#first_name').val())==''){
		 $("#error").html('Please enter your first name.').addClass('messageboxerror').fadeTo(900,1);
         $('#first_name').focus()
	     return false;
	 }
	  
	if($('#birth_year').val()=='0'){
	     $("#error").html('Please select year of birth.').addClass('messageboxerror').fadeTo(900,1);
		  return false;
	  }if($('#birth_month').val()=='0'){
	     $("#error").html('Please select month of birth.').addClass('messageboxerror').fadeTo(900,1);
		  return false;
	  }if($('#birth_day').val()=='0'){
		  $("#error").html('Please select day of birth.').addClass('messageboxerror').fadeTo(900,1);
	        return false;
	  }   
	 if($('#country').val()=='0'){
		 $("#error").html('Please select  your country.').addClass('messageboxerror').fadeTo(900,1);
		   return false;
	 }if(document.getElementById('stateText')){
	   
	   if(trim($('#stateText').val())==''){
		 $("#error").html('Please enter your city name.').addClass('messageboxerror').fadeTo(900,1);
		 $('#stateText').focus()
	     return false;
	  }
	  }
	/*END validation*/
	dataString = andtrim(dataString);
	dataString = dataString+'&gender='+gender;
    $("#editFanbutton").val("Saving....");
	$("#editFanbutton").css({'color' : '#000', 'disable' : 'disabled'});
	
   $.ajax({
          type: "POST",
          url: "./lib/usersModel.php",
          data: dataString+"&action=editFanProfile",
		  dataType: 'json',
          cache: true,
          success: function(res){	
		 if(res.isAction == 1)
			{
				//loadFanHTML('edit_user');
				$("#error").fadeIn("slow");
				$("#error").html('Saved Successfully.').css({'font-weight' : 'bolder', 'color' : '#F37D21'});
				$("#error").fadeTo(1000,0.1,function(){ 
				$('span#setName').html("<img src='./template/system/images/loader.gif'  id='loderImg'  height =\"30\"/>").fadeTo(900,1,function()
				{$("span#setName").html(res.name);
				});									 
				loadFanHTML('edit_user');
				//getfanHomePage();
				});
			
			}
          }
         });
	
   return false;
}	
function change_pass_FanUser()
{	var arrayField;
	arrayField = $("#Fan_arrayFields").val();
	arrayField = arrayField.split(",");
	var i=0;
	var dataString = '';
	while (i < arrayField.length)
	 {
	  dataString  += arrayField[i]+'='+trim($("#"+arrayField[i]).val())+"&";
	  i+=1;
	  }
	dataString = andtrim(dataString);
	$("#changePasswordBtn").css({'color' : '#000', 'disable' : 'disable'});
	if(trim($("#oldpass").val()) ==''){ 
    $("#error").html('Please enter old password.').css({'font-weight' : 'bolder', 'color' : '#F37D21'}).fadeIn("slow");
	$("#oldpass").focus();}
	else if(trim($("#newPass").val()) ==''){
	$("#error").html('Please enter new password.').css({'font-weight' : 'bolder', 'color' : '#F37D21'}).fadeIn("slow");
	$("#newPass").focus();
	}else if(trim($("#newPass").val()).length < 6){
	$("#error").html('Please enter minimum 6 chracters in password.').css({'font-weight' : 'bolder', 'color' : '#F37D21'}).fadeIn("slow");
	$("#newPass").focus();
	}
	else if(trim($("#verifyPass").val()) ==''){
	$("#error").html('Please enter verify password.').css({'font-weight' : 'bolder', 'color' : '#F37D21'}).fadeIn("slow");
	$("#verifyPass").focus();
	}
	else if(trim($("#verifyPass").val()) != trim($("#newPass").val())){
	$("#error").html('Passwords do not match.').css({'font-weight' : 'bolder', 'color' : '#F37D21'}).fadeIn("slow");
	$("#verifyPass").focus();
	}
	else{
	$("#changePasswordBtn").val("verifying....");
	$.ajax({
			  type: "POST",
			  url: "./lib/usersModel.php",
			  data: dataString+"&action=changePassword",
			  success: function(msg)
			  { 	msg = parseInt(msg);
			  		if(msg == 1)
					{
						$("#error").html('Password has been changed Successfully.').css({'font-weight' : 'bolder', 'color' : '#F37D21'}).fadeIn("slow");
						$("#error").fadeTo(2000,0.1,function(){ 
							loadFanHTML('changepass');
						});
					}
					if(msg == 0){
					$("#error").html('Provided password is not correct.').css({'font-weight' : 'bolder', 'color' : '#F37D21'}).fadeIn("slow");
					$("#error").fadeTo(2000,0.1,function(){
							loadFanHTML('changepass');
					});	
					}
			  }
         });
   }
   return false;
}	
/*<-----------------------------------------------------------------ADD VIDEO TO PLAYLIST--------------------------------------------------------------------------->*/
function add_video_to_playlist(user_id,youtube_video_id,playlist_id)
{	
    var user_id = user_id;
	var youtube_video_id = youtube_video_id;
	var playlist_id = '';
	var video_playlist_id = '';
	video_playlist_id = $("#video_playlist_id").val();
	playlist_id = parseInt(video_playlist_id);
	var dataString = '';
	try
	   { if(playlist_id !=''){
		  dataString = 'user_id='+user_id+'&youtube_video_id='+youtube_video_id+'&playlist_id='+playlist_id;
		$.ajax({
          type: "POST",
          url: "./lib/usersModel.php",
          data: dataString+"&action=add_fan_video_to_playlist",
		  dataType: 'json',
          cache: true,
          success: function(res)
		  {
				if(res.isAction == 0)
				{
					$("div#mainDiv").html('This video already exists.');
					
				}else{
					 $("div#mainDiv").html('The Video has been added to your playlist.');
				}
          }
        }); // end of ajax
	   
	   }else{
		  displayAlert('alertbox','Sorry,Please select play list'); 
		   }
	   } // end of try
	catch(err)
	   {
	   	txt="There was an error on this page.\n\n"
	   	txt+="Error description: " + err.description + "\n\n"
	   	txt+="Click OK to continue."
	   	alert(txt);
	   }

}	
function add_video_to_playlist_add_all_videos(uId,user_id)
{	
  
	var playlist_id = '';
	var video_playlist_id = '';
	video_playlist_id = $("#video_playlist_id").val();
	playlist_id = parseInt(video_playlist_id);
	var dataString = '';
	try
	   { if(playlist_id !=''){
		  dataString = 'uId='+uId+'&user_id='+user_id+'&playlist_id='+playlist_id;
		$.ajax({
          type: "POST",
          url: "./lib/usersModel.php",
          data: dataString+"&action=add_fan_video_to_playlist_all_songs",
		  dataType: '',
          cache: true,
          success: function(res)
		  {
			$("div#mainDiv").html('The Video has been added to your playlist.');
	       }
    }); // end of ajax
	   
	   }else{
		  displayAlert('alertbox','Sorry,Please select play list'); 
		   }
	   } // end of try
	catch(err)
	   {
	   	txt="There was an error on this page.\n\n"
	   	txt+="Error description: " + err.description + "\n\n"
	   	txt+="Click OK to continue."
	   	alert(txt);
	   }

}	
/*<-----------------------------------------------------------------CREATE USER PLAYLIST--------------------------------------------------------------------------->*/
function create_play_list(user_id)
{	
    var user_id = user_id;
	var playlistName ='';
	playlistName = $("#play_list_name").val();
    var dataString = '';
	
		   if(playlistName == '')
		   {  alert('Please enter PlayList Name.');
			  $("#play_list_name").focus();
			}else
			{
		  			dataString = 'user_id='+user_id+'&playlistName='+playlistName;
					$.ajax({
					type: "POST",
					url: "./lib/usersModel.php",
					data: dataString+"&action=CREATE_USER_PLAYLIST",
					dataType: 'json',
					cache: true,
					success: function(res)
					{
						if(res.isAction == 0)
						{
							$("div#mainDiv").html('Playlist with this name already exists.');
							
						}else{
							 $("div#mainDiv").html('The Playlist has been created.');
						}
					}
				}); // end of ajax
			} // Empty playList End
}	
