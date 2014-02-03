// JavaScript Document

function pageAction(controller)
{
	 
	var checkFound = false;
	var chkboxlen = document.mainform.cat_id.length;
	
	for(var i=0;i<chkboxlen;i++){
		if (document.mainform.cat_id[i].checked){
			checkFound = true;
		}
	}
	
	if (checkFound != true) {
		document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = "Please select at least one checkbox.";

	}else {
   
		 document.getElementById("controller").value = controller;
		 if(confirm('Do you really want to '+controller+' the selected categorie(s)?'))
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
function checkAddCat()
{
	with (window.document.adddCatFrm) { 
	    if (isEmpty(cat_name, 'Please enter name')) {
			return;
		}else if (isEmpty(cat_desc, 'Please enter description')) {
			return;
		}else {
			submit();
		}
	}
}


function checkSettings()
{
	var submitForm = false;
	if(document.getElementById('content-table-inner-suceess')){
	$('#content-table-inner-suceess').hide('slow');
	}
	if(document.getElementById('content-table-inner-susecc'))
	document.getElementById('content-table-inner-susecc').style.display='none';
	with (window.document.adddSettingtFrm) { 
	
	var email_str = document.adddSettingtFrm.email_address.value;
	
	var filter=email_str.match(/^[^0-9][a-z0-9_]+([.][a-z0-9_]+)*[@][a-z0-9]+([.][a-z0-9]+)*[.][a-z]{2,4}$/i);
	
	   if(isEmpty(website_name, 'Please enter website name')){
	    return;
	   }else if (isEmpty(logo_text, 'Please enter logo in hindi')) {
			return;
		}	
		else if (isEmpty(logo_text2, 'Please enter logo in english')) {
			return;
		}
		else if (isEmpty(email_subject, 'Please enter email subject')) {
			return;
		}else if (isEmpty(email_address, 'Please enter email address')) {
			return;
		}else if (filter==null)
			{
			document.getElementById('content-table-inner').style.display = ''; 
	    	document.getElementById('err_mess').innerHTML = "Your Email address can contain only letters, numbers, periods (.), hyphens (-), and underscores (_). The ID can't contain special characters or accented letters.";	
			
			document.adddSettingtFrm.email_address.focus();
			return false;
			}
		else if (echeck(email_str)==false){
	
		email_str="";
		document.adddSettingtFrm.email_address.focus();
		return false;
	}
		else if (isEmpty(contact_number, 'Please enter contact number')) {
			return;
		}else if (isEmpty(footer_text, 'Please enter footer text')) {
			return;
		}else if (email(email_address,'Invalid email address')) {
			return;
		}else if (validateContact(contact_number,'Invalid contact number')) {
			return;
		}else if (isEmpty(billheading, 'Please enter bill heading in hindi')) {
			return;
		}else if (isEmpty(billheadingenglish, 'Please enter bill heading in english')) {
			return;
		}else if (isEmpty(addresshindi, 'Please enter address in hindi')) {
			return;
		}else if (isEmpty(addressenglish, 'Please enter address in english')) {
			return;
		}else {
				
			   /*if($("#showchangeLink") && !$('#showchangeLink').is(":visible") ){
                  if(isEmptyImage(logo_image, 'Please select logo image')){
		           return false;
		          }else if (isValidImage(logo_image, 'Please upload valid image type')){
						return;
				  }
			}*/
		 submit();
		 }
	  }
 }

function showUploader(){
	
	$('#showchangeLink').fadeOut('slow');
	$('#imageuploader').fadeIn('slow');
 
}

function hideUploader(){
   
   $('#imageuploader').fadeOut('slow');
	$('#showchangeLink').fadeIn('slow');
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
