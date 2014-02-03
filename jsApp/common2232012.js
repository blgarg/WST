/*
Strip whitespace from the beginning and end of a string
Input : a string
*/


function trim(str)
{
	return str.replace(/^\s+|\s+$/g,'');
}

function andtrim(s)
{
	return s.substring(0, s.length-1);
}


/*
Make sure that textBox only contain number
*/
function checkNumber(textBox,message)
{
	_isValid = false;
	if(!isNaN(parseInt(textBox.value))) {
		textBox.value = 0;
		document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
		textBox.focus();
	}else{_isValid = true;}
	
			return _isValid  = true;
		

}

/*
	Check if a form element is empty.
	If it is display an alert box and focus
	on the element
*/
function isEmpty(formElement, message) {
	
	formElement.value = trim(formElement.value);
	
	_isEmpty = false;
	if (formElement.value == '') {
		_isEmpty = true;
		//alert(message);
		document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
		formElement.focus();
	}
	
	return _isEmpty;
}


function isEmptyImage(formElement, message) {
	
	
	_isEmpty = false;
	if (formElement.value == '') {
		_isEmpty = true;
		//alert(message);
		document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
		formElement.focus();
	}
	
	return _isEmpty;
}


function isEmptySelect(formElement, message) {
	
	_isEmpty = false;
	if (formElement.value == '0') {
		_isEmpty = true;
		//alert(message);
		document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
		formElement.focus();
	}
	
	return _isEmpty;
}


// TEXT LENGTH
function isLen(formElement,len,message){
	formElement.value = trim(formElement.value);
	if(formElement.value.length >= len){ 
	   document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
		
	   formElement.focus();
	   return true;
	  }else{ 	return false;}
}

// valid fone number 
function validfon(formElement,message){
  // var phoneRe = /^\(?(\d{1})\)?[- ]?(\d{3})?[- ]?(\d{3})[- ]?(\d{4})$/;
 var phoneRe = /^[0-9]{1}[-][0-9]{3}[-][0-9]{3}[-][0-9]{4}$/;
   if(!phoneRe.test(formElement.value)){ 
      document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();
	   return true;
    }else{return false;}
  
}

//NUMERIC VALUSE ONLY 
function  numeric(formElement,message){
	var numerixReg  =  /(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/;
    if(!numerixReg.test(formElement.value)){ 
       document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
		formElement.value = '0';
	    formElement.focus();
	   return true;
    }else{return false;}
   
	}


// DECIMAL VALUES
function  isdecimal(formElement,message){
	var decimalReg  = /^[0-9]{1,3}[.][0-9]{2}$/;
    if(!decimalReg.test(formElement.value)){ 
       document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();
	   return true;
    }else{return false;}
   
	}
	
//Integer VALUSE ONLY 
function  integer(formElement,message){
	var integreReg  = /(^-?\d\d*$)/;
    if(!integreReg.test(formElement.value)){ 
       document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();
	   return true;
    }else{return false;}
   
	}	


//Zipcode VALUSE ONLY 
function  zip(formElement,message){
	var zipReg  =  /^\d{3,6}$/;
    if(!zipReg.test(formElement.value)){ 
       document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();
	   return true;
    }else{return false;}
   
	}	


// removing spaces 
function trimAll( strValue ) {
 var objRegExp = /^(\s*)$/;

    //check for all spaces
    if(objRegExp.test(strValue)) {
       strValue = strValue.replace(objRegExp, '');
       if( strValue.length == 0)
          return strValue;
    }

   //check for leading & trailing spaces
   objRegExp = /^(\s*)([\W\w]*)(\b\s*$)/;
   if(objRegExp.test(strValue)) {
       //remove leading and trailing whitespace characters
       strValue = strValue.replace(objRegExp, '$2');
    }
  return strValue;
}

// valid email 
function  email(formElement,message){
	var emailReg  = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if(!emailReg.test(formElement.value)){ 
      document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();
	   return true;
    }else{return false;}
   
	}	
	
// valid Url	
function isYoutubeUrl(formElement,message) {

   var v = new RegExp();
    v.compile("^[A-Za-z]+://[A-Za-z0-9-_]+\\.[A-Za-z0-9-_%&\?\/.=]+$");
   
   if(trim(formElement.value)!=''){
	
	 if (!v.test(formElement.value)) { 
         document.getElementById('content-table-inner').style.display = ''; 
         document.getElementById('err_mess').innerHTML = message;
	     formElement.focus();return true;
		 }
  }
  
}
// Valid Url

function isValidUrl(formElement,message) {
    
   if(trim(formElement.value)!=''){
	 var v = new RegExp();
    v.compile("[A-Za-z0-9-_]+\\.[A-Za-z0-9-_%&\?\/.=]+$");
    if (!v.test(formElement.value)) { 
       document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();return true;
    }
 }
	return false;
}





function isUploadValidUrl(url) {
    
   if(trim(url)!=''){
	 var v = new RegExp();
    v.compile("[A-Za-z0-9-_]+\\.[A-Za-z0-9-_%&\?\/.=]+$");
    if (!v.test(url)) { 
       return false;
    }
 }
	return true;
}
	
// valid username 
function  username(formElement,message){
	var ck_username = /^[A-Za-z0-9_]{3,20}$/;
    if(!ck_username.test(formElement.value)){ 
       document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();
	   return true;
    }else{return false;}
   
	}		


// valid title 
function  validtitle(formElement,message){
	var ck_title = /^[a-z A-Z 0-9\'\-]+$/;
    if(!ck_title.test(formElement.value)){ 
      document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();
	   return true;
    }else{return false;}
   
	}

// valid meta keywords
function  validmeta(formElement,message){
	var ck_title = /^[a-z A-Z \,\-]+$/;
    if(!ck_title.test(formElement.value)){ 
       document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();
	   return true;
    }else{return false;}
   
	}
	
// valid meta keywords
function  validmetades(formElement,message){
	var ck_title = /^[a-z A-Z \,\.\-\&]+$/;
    if(!ck_title.test(formElement.value)){ 
       document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();
	   return true;
    }else{return false;}
   
	}

// valid password 
function  pass(formElement,message){
	var ck_password = /^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
    if(!ck_password.test(formElement.value)){ 
       document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();
	   return true;
    }else{return false;}
   
	}
	
// valid Fax 
function  fax(formElement,message){
	var fax = /^[0-9]{1,3}-[0-9]{3}-[0-9]{3,4}-[0-9]{3,4}$/;
    if(!fax.test(formElement.value)){ 
       document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();
	   return true;
    }else{return false;}
   
	}	

//card CCVVVVVVVVVVVV
function cardCcv(formElement,message){
	var ccv = /^[0-9]{3,4}$/;
    if(!ccv.test(formElement.value)){ 
       document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();
	   return true;
    }else{return false;}
   
	}	
// valid names 
function  chars(formElement,message){
	var name = /^[a-z A-Z\'\-]+$/;
    if(!name.test(formElement.value)){ 
       document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();
	   return true;
    }else{return false;}
   
	}	
	

/*
	Set one value in combo box as the selected value
*/
function setSelect(listElement, listValue)
{
	for (i=0; i < listElement.options.length; i++) {
		if (listElement.options[i].value == listValue)	{
			listElement.selectedIndex = i;
		}
	}	
}

// IMAGE VALIDATION 
function getFileExtension(inputId)
{
 var fileinput = document.getElementById(inputId);
 var filename = fileinput.value;
 if( filename.length == 0 ) return "";
 var dot = filename.lastIndexOf(".");
 if( dot == -1 ) return "";
 var extension = filename.substr(dot,filename.length);
 return extension.toLowerCase();
 
}
 
function checkFileType(inputId,allowedExt)
{
 var ext = getFileExtension(inputId);
 if(ext == allowedExt)
 return true;
 else
 return false;
}


// valid fone number 
function validateContact(formElement,message){
  if(!isPhone(formElement.value)){ 
        document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();
	   return true;
    }else{return false;}
  
}


function isPhone(s)
  {
	return isCharsInBag (s, "0123456789-+(). ");//simple test
	
}


function isCharsInBag (s, bag){
   
   var i;
    // Search through string's characters one by one.
    // If character is in bag, append to returnString.

    for (i = 0; i < s.length; i++)
    {
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) return false;
    }
    return true;
 }

function isValidImage(imagename,message)
{
imagefile_value = imagename;
var checkimg = imagefile_value.value.toLowerCase();
if (!checkimg.match(/(\.PNG|\.png|\.JPG|\.jpg|\.gif|\.GIF|\.jpeg|\.JPEG)$/))
{
        document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
		formElement.focus();
	    return true;
}
else
{
return false;
}
}

function isValidVideo(imagename,message)
{
imagefile_value = imagename;
var checkimg = imagefile_value.value.toLowerCase();
if (!checkimg.match(/(\.mp4|\.MP4|\.flv|\.FLV|\.mpeg|\.MPEG)$/))
{
 document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();
		 return true;
}
else
{
return false;
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
	
	
	var selectedmonth = parseInt(DateC[1]-1);
	var selectedday =  DateC[2];
	var selectedday = ltrim(selectedday);
	var stmillsec=Date.UTC(parseInt(DateC[0]),selectedmonth,selectedday);
	
	
	var currentmillsec=Date.UTC(toyear, tomonth,today);
	
	if(parseInt(stmillsec) < parseInt(currentmillsec))
	{
	   document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();
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
     myDatestarte.setFullYear(DateC[0],DateC[1]-1,DateC[2]);
	 
	 var myDateEnd =new Date();
     myDateEnd.setFullYear(DateD[0],DateD[1]-1,DateD[2]);
	 
	if(myDatestarte >= myDateEnd)
	{
	 document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElementEnd.focus();
		 return true;
		}
	 
	}
	
function  isValidemail(email){
	var emailReg  = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if(!emailReg.test(email)){
	 return false;
	}
 return true;
 }
 
 function isUrlValid(url){
    
	 var v = new RegExp();
    v.compile("^[A-Za-z]+://[A-Za-z0-9-_]+\\.[A-Za-z0-9-_%&\?\/.=]+$");
	 if (!v.test(url)) { 
         return false;
	}
	
	return true;
   
 }
 
 
 function isValidCsv(imagename,message)
{
imagefile_value = imagename;
var checkimg = imagefile_value.value.toLowerCase();

if (!checkimg.match(/(\.csv)$/))
{
        document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
		formElement.focus();
	    return true;
}
else
{
return false;
}
}
	