// JavaScript Document
function pageAction(controller)
{
	$("#content-table-inner-susecc").hide();  
	var checkFound = false;
	var chkboxlen = document.getElementsByName('user_id[]').length;
	for(var i=0;i<chkboxlen;i++){
		if (document.getElementsByName('user_id[]')[i].checked){
			checkFound = true;
		}
	}
	
	if (checkFound != true) {
		document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = "Please select at least one checkbox.";

	}else {
   
		 document.getElementById("controller").value = controller;
		 if(confirm('Do you really want to '+controller+' the selected user(s)?'))
		 { 
			document.mainform.submit();
		 }
		 else{
			 return false;
		 }
	}
}

<!-- Begin
function checkUncheckAll(field,status)
{
	 
	if(field) {
		if(status.checked){
			if( field.length >0 ){
				for (i = 0; i < field.length; i++){
					field[i].checked = true ;
				}
			}
		}else{
			if( field.length >0 ){
				for (i = 0; i < field.length; i++)
				field[i].checked = false ;
			}
		}
	}
}

//  End -->


// CHECK ADD PAGES 
function checkAddUser()
{
	$("#content-table-inner-susecc").hide();  
	with (window.document.adddUserFrm) { 
	    if (isEmpty(first_name, 'Please enter first name')) {
			return;
		}else if (isEmpty(email_add, 'Please enter email address')) {
			return;
		}else if (email(email_add,'Please enter valid email address')){
			return;
		}else if (isEmpty(password, 'Please enter password')) {
				return;
		}else if (pass(password, 'Please enter minimum 6 chracters in password')) {
				return;
		}else if (isEmptySelect(country, 'Please select country')) {
			
			return;
		}else if (isEmptySelect(country, 'Please select country')) {
			return;
		}else if (isValidUrl(facebook_URL, 'Please enter valid facebook url including http://')) {
			return;
		}else if (isValidUrl(twitter_URL, 'Please enter valid twitter url including http:')) {
			return;
		}else {
		   if(document.getElementById("state")){
				  if(isEmptySelect(state, 'Please select state')){
				  return;
				  }
				} if(document.getElementById("stateText")){
				  if(isEmpty(stateText, 'Please enter state name')){
				  return;
				  }
				}
		   submit();
		}
	}
}

function checkEditUser()
{
	$("#content-table-inner-susecc").hide();  
	with (window.document.adddUserFrm) { 
	    if (isEmpty(first_name, 'Please enter first name')) {
			return;
		}
	
		else if (isEmpty(email_add, 'Please enter email address')) {
			return;
		}else if (email(email_add,'Please enter valid email address')){
			return;
		}else if (isEmptySelect(country, 'Please select country')) {
			return;
		}else if (isValidUrl(facebook_URL, 'Please enter valid facebook url including http://')) {
			return;
		}else if (isValidUrl(twitter_URL, 'Please enter valid twitter url including http://')) {
			return;
		}else {
			    if(document.getElementById("state")){
				  if(isEmptySelect(state, 'Please select state')){
				  return;
				  }
				} if(document.getElementById("stateText")){
				  if(isEmpty(stateText, 'Please enter state name')){
				  return;
				  }
				}
			submit();
		}
	}
}


function checkEditAdmin()
{
	$("#content-table-inner-susecc").hide();  
	with (window.document.adddUserFrm) { 
	
	//var email_str = document.adddUserFrm.user_email.value;
	
	//var filter=email_str.match(/^[^0-9][a-z0-9_]+([.][a-z0-9_]+)*[@][a-z0-9]+([.][a-z0-9]+)*[.][a-z]{2,4}$/i);
	
	    if (isEmpty(user_display_name, 'Please enter display name')) {
			return;
		}
	
		/*else if (isEmpty(user_email, 'Please enter email address')) {
			return;
		}else if (filter==null)
			{
			document.getElementById('content-table-inner').style.display = ''; 
	    	document.getElementById('err_mess').innerHTML = "Your Email address can contain only letters, numbers, periods (.), hyphens (-), and underscores (_). The ID can't contain special characters or accented letters.";	
			
			document.adddUserFrm.user_email.focus();
			return false;
			}*/
		/*else if (echeck(email_str)==false){
	
		email_str="";
		document.adddUserFrm.user_email.focus();
		return false;
	}*/else if (password.value !=''){
			  	
				if (isEmpty(npassword, 'Please enter new password')) {	return;}
				if(pass(npassword, 'Please enter minimum 6 and maximum 20 chracters in password')){
					 return;
					}
				else if (isEmpty(cpassword, 'Please enter confirm password')) {	return;}
				else if(cpassword.value != npassword.value)
					{
					   document.getElementById('content-table-inner').style.display = ''; 
	   					 document.getElementById('err_mess').innerHTML = "New password and confirm password do not match";	
						  return false;
						}else{submit();}
						
		}else {
			submit();
		}
	}
}




function getStateList(cId){
	if(cId!='1'){
	$('#statetd').html('<input type="text" name="stateText" id="stateText" maxlength="70" class="textbox">');
	}else{
		 $('#statetd').html('<select name="state" id="state" maxlength="70" class="selectbox"/></select>'); 
		  $.ajax({
          type: "POST",
          url: "../lib/stateList.php",
          data: "cId="+cId+"&action=getStateList",
          success: function(msg){
	      $('#state').html(msg);
          }
         });
	}

}


function echeck(str) {
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   alert("Invalid E-mail ID")
		   return false
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		  document.getElementById('content-table-inner').style.display = ''; 
	      document.getElementById('err_mess').innerHTML = "Your Email address can contain only letters, numbers, periods (.), hyphens (-), and underscores (_). The ID can't contain special characters or accented letters.";	
		   return false
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    document.getElementById('content-table-inner').style.display = ''; 
	      document.getElementById('err_mess').innerHTML = "Your Email address can contain only letters, numbers, periods (.), hyphens (-), and underscores (_). The ID can't contain special characters or accented letters.";	
		    return false
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		     document.getElementById('content-table-inner').style.display = ''; 
	      document.getElementById('err_mess').innerHTML = "Your Email address can contain only letters, numbers, periods (.), hyphens (-), and underscores (_). The ID can't contain special characters or accented letters.";	
		    return false
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		      document.getElementById('content-table-inner').style.display = ''; 
	      document.getElementById('err_mess').innerHTML = "Your Email address can contain only letters, numbers, periods (.), hyphens (-), and underscores (_). The ID can't contain special characters or accented letters.";	
		    return false
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		     document.getElementById('content-table-inner').style.display = ''; 
	      document.getElementById('err_mess').innerHTML = "Your Email address can contain only letters, numbers, periods (.), hyphens (-), and underscores (_). The ID can't contain special characters or accented letters.";	
		    return false
		 }
		
		 if (str.indexOf(" ")!=-1){
		     document.getElementById('content-table-inner').style.display = ''; 
	      document.getElementById('err_mess').innerHTML = "Your Email address can contain only letters, numbers, periods (.), hyphens (-), and underscores (_). The ID can't contain special characters or accented letters.";	
		    return false
		 }

 		 return true					
	}




