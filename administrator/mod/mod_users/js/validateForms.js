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
	    document.getElementById('err_mess').innerHTML = "Please select at least one record.";

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
function checkEditAdmin()
{
	with (window.document.adddUserFrm) { 
	
		if(isEmpty(password,'Please enter the old password.')){
			return false;
		}else if(isEmpty(npassword,'Please enter the new password.')){
			return false;
		}else if(pass(npassword,'Please enter min. 6-20 characters.')){
			return false;
		}else if(isEmpty(cpassword,'Please enter the confirm password.')){
			return false;
		}else if(document.getElementById('npassword').value!=document.getElementById('cpassword').value){
				document.getElementById('content-table-inner').style.display = ''; 
				document.getElementById('err_mess').innerHTML = "Confirm password does not match.";
				return false;
		}else{
			submit();
		}
	}
}

function checkEditProfile()
{
	with (window.document.adddUserFrm) { 
	
		if(isEmpty(user_name,'Please enter the user name.')){
			return false;
		}else if(onlytext(user_name,'Only digits are not allowed in user name.')){
			return false;		
		}else if(validateHtml(user_name,'Special characters are not allowed in user name')){
			return false;
		}else if(isEmpty(user_email,'Please enter the email ID.')){
			return false;
		}else if(email(user_email,'Please enter the valid email ID.')){
			return false;
		}else{
			submit();
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
/*function checkAddCategory()
{
	with (window.document.adddPageFrm) { 
	    if (isEmpty(category_title, 'Please enter category title')) {
			return false;
		}
		else if(isLen(category_title,'151','More than 150 characters are not allowed.')){
			return false;
		}else {
			submit();
		}
	}
} 
*/
function checkAddUser(){

	with (window.document.adddUserFrm) { 
		if (isEmpty(first_name, 'Please enter first name')) {
			return false;
		}else if(onlytext(first_name,'Please enter the text only.')){
			return false;
		}else if(validateHtml(first_name,'Special characters are not allowed in first name')){
			return false;
		}else if(isEmpty(last_name, 'Please enter last name')) {
			return false;
		}else if(onlytext(last_name,'Please enter the text only.')){
			return false;
		}else if(validateHtml(last_name,'Special characters are not allowed in last name')){
			return false;
		}else if(isEmpty(email_add, 'Please enter email')) {
			return false;
		}else if(email(email_add,'Enter the valid email ID')){
			return false;
		}else if(isEmpty(password,'Enter the password')){
			return false;
		}else if(isEmptySelect(country,'Select the country name')){
			return false;
		}else if(isEmpty(state,'Enter the state')){
			return false;
		}else if(onlytext(state,'Please enter only alphanumeric characters in state.')){
			return false;
		}else if(validateHtml(state,'Special characters are not allowed in state')){
			return false;
		}else if(isEmpty(phone_number,'Enter the phone number')){
			return false;
		}else if(validateContact(phone_number,'Please enter the valid phone number.')){
			return false;
		}else if(isMinLen(phone_number,6,'Minimum 7 digits required for Phone Number')){
			return false;
		}else if(isEmptySelect(membership,'Select the membership type')){
			return false;
		}else if(isEmptySelect(payment_type,'Select the payment type')){
			return false;
		}else {
			submit();
		}
		
	}
}

function checkEditUser(){
with (window.document.adddUserFrm) { 
	
		if (isEmpty(first_name, 'Please enter first name')) {
			return false;
		}else if(onlytext(first_name,'Please enter the text only.')){
			return false;
		}else if(validateHtml(first_name,'Special characters are not allowed in first name')){
			return false;
		}else if(isEmpty(last_name, 'Please enter last name')) {
			return false;
		}else if(onlytext(last_name,'Please enter the text only.')){
			return false;
		}else if(validateHtml(last_name,'Special characters are not allowed in last name')){
			return false;
		}else if(isEmpty(email_add, 'Please enter email')) {
			return false;
		}else if(email(email_add,'Enter the valid email ID')){
			return false;
		}else if(isEmpty(password,'Enter the password')){
			return false;
		}else if(isEmpty(phone_number,'Enter the phone number')){
			return false;
		}else if(validateContact(phone_number,'Please enter the valid phone number.')){
			return false;
		}else if(isMinLen(phone_number,6,'Minimum 7 digits required for Phone Number')){
			return false;
		}else if(isEmptySelect(country,'Select the country name')){
			return false;
		}else if(isEmpty(state,'Enter the state')){
			return false;
		}else if(onlytext(state,'Please enter only alphanumeric characters in state.')){
			return false;
		}else if(validateHtml(state,'Special characters are not allowed in state')){
			return false;
		}else if(isEmptySelect(membership,'Select the membership type')){
			return false;
		}else if(isEmptySelect(payment_type,'Select the payment type')){
			return false;
		}else {
			submit();
		}
		
	}

}


function compareToDayDate(formElement,message)
{ 
	
	var DateC ;
	DateC = formElement.value;
	//2011-06-07
	DateC=DateC.split('-');
   
	 
	 x=new Date();

	var  toyear=x.getFullYear();
	 var today= x.getDate();
	 var tomonth=parseInt(x.getMonth());
	
	
	var selectedmonth = parseInt(DateC[0]-1);
	//var selectedmonth = ltrim(selectedmonth); 
	var selectedday =  DateC[1];
	 selectedday = ltrim(selectedday);
	var stmillsec=Date.UTC(parseInt(DateC[2]),selectedmonth,selectedday);
	
	
	var currentmillsec=Date.UTC(toyear, tomonth,today);
	if(parseInt(stmillsec) >= parseInt(currentmillsec))
	{
	 
	    document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
		document.getElementById('DOB_datepicker').focus();
		
	    return true;
	}
}



	function compareDate(formElementStart,formElementEnd,message)
	{
		var DateC ;
		var DateD ;
		DateC = formElementStart.value;
		DateD = formElementEnd.value;
		//2011-06-07
		DateC=DateC.split('-');
		DateD=DateD.split('-');
		var myDatestarte =new Date();
		 myDatestarte.setFullYear(DateC[2],DateC[0]-1,DateC[1]);
		 
		 var myDateEnd =new Date();
		 myDateEnd.setFullYear(DateD[2],DateD[0]-1,DateD[1]);
		 
		if(myDatestarte > myDateEnd)
		{
		 document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
		document.getElementById('DOB_datepicker').focus();
		
	    return true;
			}
		 
	}

function compareAppearDate(formElementStart,formElementEnd,message)
	{
		var DateC;
		var DateD;
		
		DateC = formElementStart.value;
		DateD = formElementEnd;
		
		//2011-06-07
		x=new Date();
		var today= x.getDate();
				
		DateC=DateC.split('-');
		DateD=DateD.split('-');
		
		var myDatestarte =new Date();
		
		 myDatestarte.setFullYear(DateC[2],DateC[0]);
		 
		 var myDateEnd =new Date();
		 myDateEnd.setFullYear(DateD[1],DateD[0]);
		 
		if(myDatestarte > myDateEnd)
		{
		 
		
		document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
		document.getElementById('appear_year').focus();	
		
	    return true;
			}
		 
	}
	
function compareDeceasedDate(formElementStart,formElementEnd,message)
	{
		var DateC;
		var DateD;
		
		DateC = formElementStart.value;
		DateD = formElementEnd;
		
		//2011-06-07
		x=new Date();
		var today= x.getDate();
				
		DateC=DateC.split('-');
		DateD=DateD.split('-');
		
		var myDatestarte =new Date();
		
		 myDatestarte.setFullYear(DateC[2],DateC[0]);
		 
		 var myDateEnd =new Date();
		 myDateEnd.setFullYear(DateD[1],DateD[0]);
		 
		
		 
		if(myDatestarte < myDateEnd)
		{
		  document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
		document.getElementById('Deceased_datepicker').focus();
		
	    return true;
			}
		 
	}	
	
	


function ltrim(s)
{
	var l=0;
	while(l < s.length && s[l] == '0')
	{	l++; }
	return s.substring(l, s.length);
}



function  checkModelAppeard(appyear){
	if(parseInt(appyear.length)<4){
	  document.getElementById('content-table-inner').style.display = ''; 
	  //document.getElementById('err_mess').innerHTML = 'Please enter valid year.';
	 document.getElementById('appear_year').value = '';
	 $('#appear_year').focus();
	 //document.getElementById('appear_year').focus();
	 return false;
	}else{
	  document.getElementById('content-table-inner').style.display = 'none'; 
	 document.getElementById('err_mess').innerHTML = '';
	}
	message = 'Model has been already appeared in this month with '+appyear+'';
	month = $('#appear_month').val();
	if(appyear != ''){
	$.ajax({ type: "POST",
			   url: "mod/mod_manageModel/checkappearedModel.php",
			   dataType: 'json',
          	   cache: true,
			   data: "appearedyear="+appyear+"&appearedmonth="+month+"&randval="+Math.random(),
				   success: function(dataSet)
				   { 
				      if(dataSet.isAction == '1'){ 
					  document.getElementById('content-table-inner').style.display = ''; 
						document.getElementById('err_mess').innerHTML = message;
						document.getElementById("appear_year").focus();
						document.getElementById("appear_year").value ='';
						
						return false;
					   }
				  
					  if(dataSet.isAction == '2'){  return true; }
				   }	
			});		
			
	}else{
		return true;
		
		}
  
	}



function  isnumeric(formElement,message){
	var numerixReg  =  /(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/;
    if(!numerixReg.test(formElement.value)){ 
       document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();
	   return true;
    }else{return false;}
   
	}


function ValidImage(imagename,message)
{
imagefile_value = imagename;
var checkimg = imagefile_value.value.toLowerCase();
if(checkimg ==''){
 return false;
}
 
if (!checkimg.match(/(\.PNG|\.png|\.JPG|\.jpg|\.gif|\.GIF|\.jpeg|\.JPEG)$/))
{
       
		document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	   return true;
}
else
{
return false;
}
}

	$(function() {
		$( "#DOB_datepicker" ).datepicker();
		$( "#Deceased_datepicker" ).datepicker();
	});

